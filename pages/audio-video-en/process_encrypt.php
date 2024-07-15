<?php
session_start();

define('UPLOAD_DIR', 'uploads/');

if (!file_exists(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file']) && isset($_POST['key'])) {
    $file = $_FILES['file'];
    $key = $_POST['key'];
    $filename = basename($file['name']);
    $filepath = UPLOAD_DIR . $filename;

    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        $encryptedFilepath = encryptFile($filepath, $key);
        saveToDatabase($filename, $file['size'], $encryptedFilepath);
        downloadFile($encryptedFilepath);
        redirectToIndex();
    } else {
        echo "Failed to upload file.";
    }
}

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
    $id_user = $_SESSION['user']['id_user'];
    // Buat query untuk menyimpan informasi file ke dalam database
    $query = "INSERT INTO enkripsi_av (id_user, nama_file, ukuran_file, tanggal, filepath) VALUES ('$id_user','$filename', '$filesize', '$tanggal', '$encryptedFilepath')";
    
    // Eksekusi query
    mysqli_query($db, $query);
    
    header('Location: index.php');
}

function downloadFile($filepath) {
    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit;
    } else {
        echo "File not found.";
    }
}

function redirectToIndex() {
    echo '<script type="text/javascript">window.location = "index.php";</script>';
    exit();
}
?>
