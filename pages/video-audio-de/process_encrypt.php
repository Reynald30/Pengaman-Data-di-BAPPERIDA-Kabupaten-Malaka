<?php
include '../../config/koneksi.php';

define('UPLOAD_DIR', 'uploads/');

function vigenereCipher($data, $key, $mode) {
    $keyLength = strlen($key);
    $keyIndex = 0;
    $output = '';
    $key = strtoupper($key);

    for ($i = 0; $i < strlen($data); $i++) {
        $char = $data[$i];
        $ordChar = ord($char);

        if ($mode == 'encrypt') {
            $char = chr(($ordChar + ord($key[$keyIndex % $keyLength])) % 256);
        } else {
            $char = chr(($ordChar - ord($key[$keyIndex % $keyLength]) + 256) % 256);
        }

        $keyIndex++;
        $output .= $char;
    }

    return $output;
}

function encryptFile($filepath, $key) {
    $data = file_get_contents($filepath);
    $base64Data = base64_encode($data);
    $encryptedData = vigenereCipher($base64Data, $key, 'encrypt');
    $encryptedFilepath = $filepath . '.enc';

    file_put_contents($encryptedFilepath, $encryptedData);

    return $encryptedFilepath;
}

function saveToDatabase($filename, $filesize, $encryptedFilepath) {
    include '../../config/koneksi.php'; // Sesuaikan dengan konfigurasi koneksi database Anda

    // Escape data yang akan disimpan ke dalam database
    $filename = mysqli_real_escape_string($db, $filename);
    $filesize = mysqli_real_escape_string($db, $filesize);
    $encryptedFilepath = mysqli_real_escape_string($db, $encryptedFilepath);

    // Mendapatkan tanggal saat ini
    $tanggal = date('Y-m-d');

    // Buat query untuk menyimpan informasi file ke dalam database
    $query = "INSERT INTO enkripsi_av (nama_file, ukuran_file, tanggal, filepath) VALUES ('$filename', '$filesize', '$tanggal','$encryptedFilepath')";
    
    // Eksekusi query
    mysqli_query($db, $query);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['file_id']) && isset($_POST['key'])) {
    $file_id = intval($_POST['file_id']);
    $key = $_POST['key'];

    // Get file details from database
    $query = "SELECT * FROM dekripsi_av WHERE id_de = $file_id"; // Sesuaikan dengan tabel dan kolom yang ada
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filepath = UPLOAD_DIR . $row['nama_file'];
        $filename = $row['nama_file'];

        if (file_exists($filepath)) {
            $encryptedFilepath = encryptFile($filepath, $key);
            saveToDatabase($filename, filesize($filepath), $encryptedFilepath);
            header('Location: download.php?filepath=' . urlencode($encryptedFilepath));
            exit;
        } else {
            echo "File not found.";
        }
    } else {
        echo "No record found with id $file_id.";
    }
} else {
    echo "Invalid request.";
}
?>
