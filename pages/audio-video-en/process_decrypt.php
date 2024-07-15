<?php
include '../../config/koneksi.php';

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

function decryptFile($filepath, $key) {
    $data = file_get_contents($filepath);
    $decryptedData = vigenereCipher($data, $key, 'decrypt');
    $base64Data = base64_decode($decryptedData);
    $decryptedFilepath = str_replace('.enc', '', $filepath);

    file_put_contents($decryptedFilepath, $base64Data);

    return $decryptedFilepath;
}

function saveToDatabase($filename, $filesize, $decryptedFilepath) {
    include '../../config/koneksi.php'; // Sesuaikan dengan konfigurasi koneksi database Anda

    // Escape data yang akan disimpan ke dalam database
    $filename = mysqli_real_escape_string($db, $filename);
    $filesize = mysqli_real_escape_string($db, $filesize);
    $decryptedFilepath = mysqli_real_escape_string($db, $decryptedFilepath);

    // Mendapatkan tanggal saat ini
    $tanggal = date('Y-m-d');

    // Buat query untuk menyimpan informasi file ke dalam database
    $query = "INSERT INTO dekripsi_av (nama_file, ukuran_file, tanggal, filepath) VALUES ('$filename', '$filesize', '$tanggal','$decryptedFilepath')";
    
    // Eksekusi query
    mysqli_query($db, $query);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['file_id']) && isset($_POST['key'])) {
    $file_id = intval($_POST['file_id']);
    $key = $_POST['key'];

    // Get file details from database
    $query = "SELECT * FROM enkripsi_av WHERE id_en = $file_id";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filepath = $row['filepath'];
        $data = file_get_contents($filepath);
        $decryptedData = vigenereCipher($data, $key, 'decrypt');
        $base64Data = base64_decode($decryptedData);
        $decryptedFilepath = str_replace('.enc', '', $filepath);

        // Save decrypted data to new file
        file_put_contents($decryptedFilepath, $base64Data);

        // Insert decrypted file info into database
        $filename = basename($decryptedFilepath);
        $filesize = filesize($decryptedFilepath);
        saveToDatabase($filename, $filesize, $decryptedFilepath);

        // Redirect to index page
        header('Location: index.php');
        exit;
    } else {
        echo "No record found with id $file_id.";
    }
} else {
    echo "Invalid request.";
}
?>
