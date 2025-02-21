<?php
include '../../config/koneksi.php';

if (isset($_POST['id_ijin']) && !empty($_POST['id_ijin'])) {
    // Mengambil data dari form
    $id_ijin = $_POST['id_ijin'];
    $status = $_POST['status'];

    // Query untuk update data izin
    $query = "UPDATE ijin SET status = ? WHERE id_ijin = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("si", $status, $id_ijin); // "si" artinya string (status) dan integer (id_ijin)

    if ($stmt->execute()) {
        // Redirect ke halaman yang diinginkan setelah berhasil
        header("Location: index.php?pesan=update_sukses");
    } else {
        echo "<div class='alert alert-danger'>Gagal mengupdate data izin.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Data izin tidak ditemukan.</div>";
}
?>
