<?php
session_start();
include('../../config/koneksi.php');

// Ambil data dan lakukan sanitasi
$username_user = htmlspecialchars($_POST['username_user']);
$password_user = md5(htmlspecialchars($_POST['password_user']));

// Periksa username dan password menggunakan prepared statement
$query = "SELECT * FROM user WHERE username_user = ? AND password_user = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("ss", $username_user, $password_user);
$stmt->execute();
$result = $stmt->get_result();
$data_user = $result->fetch_assoc();

// Cek hasil query
if ($data_user != null) {
    // Jika user dan password cocok
    $_SESSION['user'] = $data_user;

    // Memeriksa jabatan pengguna dan mengarahkan ke halaman yang sesuai
    if ($data_user['status_user'] == 'Kades') {
        header("Location: ../kades/dasbor/");
    } else {
        header("Location: ../dasbor/");
    }
    exit;
} else {
    // Jika user dan password tidak cocok
    echo "<script>window.alert('Username atau password salah'); window.location.href='index.php'</script>";
}

$stmt->close();
$db->close();
?>
