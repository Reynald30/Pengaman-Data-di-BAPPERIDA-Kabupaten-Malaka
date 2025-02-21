<?php
session_start();
if (!isset($_SESSION['user'])) {
  // jika user belum login
  header('Location: ../login');
  exit();
}
// Periksa apakah pengguna adalah admin
if ($_SESSION['user']['status_user'] != 'Admin') {
  // Jika bukan admin, alihkan ke halaman lain atau tampilkan pesan error
  echo "<script>alert('Anda tidak memiliki akses ke halaman ini!');</script>";
  echo "<script>window.location.href = '../dasbor';</script>";
  exit();
}
include('../../config/koneksi.php');
