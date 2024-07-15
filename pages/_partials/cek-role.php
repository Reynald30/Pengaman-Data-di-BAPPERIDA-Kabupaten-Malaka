<?php
session_start();

// Periksa apakah pengguna memiliki sesi aktif
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

// Periksa jabatan pengguna
if ($_SESSION['user']['status_user'] == 'admin') {
    header("Location: ../kades/dasbor/");
} else {
    header("Location: ../dasbor/");
}
?>
