<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../../config/koneksi.php');

// Periksa apakah pengguna memiliki sesi aktif
if (!isset($_SESSION['user'])) {
    header("Location: ../../login/");
    exit;
}

// Periksa apakah parameter id telah diterima
if (isset($_GET['id'])) {
    // Ambil id permohonan dari parameter
    $id_ijin = $_GET['id'];

    // Buat query untuk menghapus data permohonan berdasarkan id
    $query = "DELETE FROM ijin WHERE id_ijin = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id_ijin);
    $stmt->execute();
    $stmt->close();

    // Redirect kembali ke halaman history permohonan setelah data dihapus
    header("Location: index.php");
    exit;
} else {
    // Jika tidak ada parameter id, kembalikan ke halaman sebelumnya
    header("Location: index.php");
    exit;
}
?>
