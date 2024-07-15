<?php
include '../../config/koneksi.php';
session_start();

// Periksa apakah parameter id tersedia
if (isset($_GET['id'])) {
    $id_ijin = intval($_GET['id']);
    
    // Query untuk memperbarui status menjadi 'Tolak'
    $sql = "UPDATE ijin SET status = 'Tolak' WHERE id_ijin = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $id_ijin);
    
    if ($stmt->execute()) {
        // Redirect kembali ke halaman utama dengan pesan sukses
        $_SESSION['message'] = "Status berhasil diperbarui menjadi Tolak.";
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
