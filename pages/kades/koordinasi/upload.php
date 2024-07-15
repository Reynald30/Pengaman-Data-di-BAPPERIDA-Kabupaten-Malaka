<?php
// Mulai sesi
session_start();

// Pastikan pengguna memiliki sesi aktif
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

// Mengambil informasi file yang diunggah
$nama_file = $_FILES['file']['name'];
$ukuran_file = $_FILES['file']['size'];
$tmp_file = $_FILES['file']['tmp_name'];
$keterangan = $_POST['keterangan'];
$tanggal = $_POST['tanggal'];

// Tentukan folder untuk menyimpan file
$folder_upload = 'uploads/';

// Tentukan nama file yang akan disimpan
$path_file = $folder_upload . $nama_file;

// Coba unggah file ke folder
if (move_uploaded_file($tmp_file, $path_file)) {
    // File berhasil diunggah, lakukan penyimpanan informasi ke database
    include('../../../config/koneksi.php');

    // Ambil id pengguna yang sedang aktif
    $id_user = $_SESSION['user']['id_user'];

    // Lakukan query untuk menyimpan informasi file ke dalam database
    $query = "INSERT INTO koordinasi (id_user, nama_file, keterangan, tanggal) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("isss", $id_user, $nama_file, $keterangan, $tanggal);
    $stmt->execute();
    $stmt->close();
    $db->close();

    // Redirect kembali ke halaman utama setelah file diunggah
    header("Location: index.php");
    exit;
} else {
    // Jika gagal mengunggah file, tampilkan pesan kesalahan
    echo "Maaf, file gagal diunggah.";
}
?>
