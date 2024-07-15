<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../../../config/koneksi.php');

// Periksa apakah pengguna memiliki sesi aktif
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

// Ambil nama file dari parameter URL
$file = htmlspecialchars($_GET['file']);
$file_path = '../../dekripsi/uploads/' . $file; // Sesuaikan path ini dengan path sebenarnya dari file yang terenkripsi

// Periksa apakah file ada
if (file_exists($file_path)) {
    // Tentukan header untuk proses download
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));
    flush(); // Flush sistem output buffer
    readfile($file_path);
    exit;
} else {
    echo "<script>alert('File tidak ditemukan.'); window.location.href='index.php';</script>";
}
?>
