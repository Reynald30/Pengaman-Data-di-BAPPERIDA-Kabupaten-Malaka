<?php
// Mulai sesi
session_start();

// Periksa apakah pengguna memiliki sesi aktif
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

// Periksa apakah ada parameter id yang diterima
if (isset($_GET['id'])) {
    include('../../../config/koneksi.php');

    // Ambil id dokumen dari parameter
    $id_ko = $_GET['id'];

    // Buat query untuk menghapus dokumen berdasarkan id
    $query = "DELETE FROM koordinasi WHERE id_ko = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id_ko);
    $stmt->execute();
    $stmt->close();
    $db->close();

    // Redirect kembali ke halaman utama setelah dokumen dihapus
    header("Location: index.php");
    exit;
} else {
    // Jika tidak ada parameter id, kembalikan ke halaman sebelumnya
    header("Location: index.php");
    exit;
}
?>
