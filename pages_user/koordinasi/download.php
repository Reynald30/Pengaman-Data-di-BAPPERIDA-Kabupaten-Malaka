<?php
// Mulai sesi
session_start();

// Periksa apakah pengguna memiliki sesi aktif
if (!isset($_SESSION['user'])) {
    header("Location: ../../login/");
    exit;
}

// Periksa apakah ada parameter id yang diterima
if (isset($_GET['id'])) {
    include('../../config/koneksi.php');

    // Ambil id dokumen dari parameter
    $id_ko = $_GET['id'];

    // Buat query untuk mengambil informasi nama file
    $query = "SELECT nama_file FROM koordinasi WHERE id_ko = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id_ko);
    $stmt->execute();
    $stmt->bind_result($nama_file);
    $stmt->fetch();
    $stmt->close();

    // Tentukan path file untuk diunduh
    $path = 'uploads/' . $nama_file;

    // Unduh file
    if (file_exists($path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($path) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit;
    } else {
        echo "File tidak ditemukan.";
    }
} else {
    // Jika tidak ada parameter id, kembalikan ke halaman sebelumnya
    header("Location: index.php");
    exit;
}
?>
