<?php
include '../../config/koneksi.php';
session_start();

// Periksa apakah pengguna memiliki izin untuk menghapus data
if ($_SESSION['user']['status_user'] == 'Petugas') {
    echo "Anda tidak memiliki izin untuk menghapus data ini.";
    exit;
}

// Periksa apakah parameter id tersedia
if (isset($_GET['id'])) {
    $id_ijin = intval($_GET['id']);
    
    // Query untuk menghapus data
    $sql = "DELETE FROM ijin WHERE id_ijin = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $id_ijin);
    
    if ($stmt->execute()) {
        // Redirect kembali ke halaman utama dengan pesan sukses
        $_SESSION['message'] = "Data berhasil dihapus.";
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
    
    $stmt->close();
} else {
    echo "ID tidak valid.";
}

$db->close();
?>
