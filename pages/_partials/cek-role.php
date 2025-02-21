<?php
session_start();

// Periksa apakah pengguna memiliki sesi aktif
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

// Periksa apakah pengguna adalah admin atau pimpinan
if ($_SESSION['user']['status_user'] != 'Admin' && $_SESSION['user']['status_user'] != 'Pimpinan') {
    echo "<script>alert('Anda tidak memiliki akses ke halaman ini!');</script>";
    echo "<script>window.location.href = '../dasbor';</script>";
    exit();
}else {
    header("Location: ../dasbor/");
}
?>
