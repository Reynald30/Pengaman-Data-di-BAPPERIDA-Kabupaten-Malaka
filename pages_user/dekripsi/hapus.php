<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../../config/koneksi.php');

// Periksa apakah pengguna memiliki sesi aktif
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

// Periksa apakah parameter id telah diberikan
if (!isset($_GET['id'])) {
    header("Location: index.php"); // Redirect kembali ke halaman utama jika id tidak diberikan
    exit;
}

// Ambil id izin dari parameter URL
$id_ijin = $_GET['id'];

// Query untuk menghapus izin dari database
$query = "DELETE FROM ijin WHERE id_ijin = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $id_ijin);
if ($stmt->execute()) {
    echo "<script>alert('Izin berhasil dihapus.'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Terjadi kesalahan. Silakan coba lagi.'); window.location.href='index.php';</script>";
}
$stmt->close();
$db->close();
?>
