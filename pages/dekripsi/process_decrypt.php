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
        $decryptedFilepath = decryptFile($filepath, $key);
        saveToDatabase($filename, $file['size'], $decryptedFilepath);
        downloadFile($decryptedFilepath);
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
        if (ctype_alpha($char)) {
            $offset = ctype_upper($char) ? ord('A') : ord('a');
            $ordChar = ord($char);
            if ($mode == 'encrypt') {
                $char = chr(($ordChar - $offset + ord($key[$keyIndex % $keyLength]) - ord('A')) % 26 + $offset);
            } else {
                $char = chr(($ordChar - $offset - (ord($key[$keyIndex % $keyLength]) - ord('A')) + 26) % 26 + $offset);
            }
            $keyIndex++;
        }
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
    $id_user = $_SESSION['user']['id_user'];
    // Buat query untuk menyimpan informasi file ke dalam database
    $query = "INSERT INTO dekripsi (id_user, nama_file, ukuran_file, tanggal, filepath) VALUES ('$id_user', '$filename', '$filesize', '$tanggal','$decryptedFilepath')";
    
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
?>
