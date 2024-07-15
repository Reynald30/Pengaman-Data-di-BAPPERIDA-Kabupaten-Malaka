<?php
include '../../config/koneksi.php'; // Sesuaikan dengan konfigurasi koneksi database Anda

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fungsi untuk menghapus file dari server dan database
    function deleteFile($id) {
        include '../../config/koneksi.php'; // Sesuaikan dengan konfigurasi koneksi database Anda

        // Mendapatkan filepath dari database berdasarkan id
        $query = "SELECT filepath FROM enkripsi_av WHERE id_en = $id";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $filepath = $row['filepath'];

        // Menghapus file dari server
        if (file_exists($filepath)) {
            unlink($filepath);
        }

        // Menghapus record dari database
        $query_delete = "DELETE FROM enkripsi_av WHERE id_en = $id";
        mysqli_query($db, $query_delete);
    }

    // Panggil fungsi deleteFile
    deleteFile($id);

    // Redirect kembali ke halaman index
    header('Location: index.php');
} else {
    // Jika tidak ada parameter id, redirect kembali ke halaman index
    header('Location: index.php');
}
?>
