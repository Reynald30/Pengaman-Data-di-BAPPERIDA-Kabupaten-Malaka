<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../../../config/koneksi.php');

// Periksa apakah pengguna memiliki sesi aktif
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

// Ambil ID dokumen dari parameter URL
$id_en = htmlspecialchars($_GET['id']);

// Ambil informasi dokumen
$query = "SELECT nama_file FROM enkripsi WHERE id_en = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $id_en);
$stmt->execute();
$stmt->bind_result($nama_file);
$stmt->fetch();
$stmt->close();

// Tambahkan '.enc' pada nama file

// Periksa apakah formulir telah dikirimkan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Simpan permohonan izin ke database
    $id_user = $_SESSION['user']['id_user'];
    $tanggal = date('Y-m-d H:i:s');
    $query = "INSERT INTO ijin (id_user, nama_file, tanggal, status) VALUES (?, ?, ?, 'pending')";
    $stmt = $db->prepare($query);
    $stmt->bind_param("iss", $id_user, $nama_file, $tanggal);
    if ($stmt->execute()) {
        echo "<script>alert('Permohonan izin berhasil diajukan.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan. Silakan coba lagi.'); window.location.href='ijin.php?id=$id_en';</script>";
    }
    $stmt->close();
    exit;
}
?>

<?php include('../_partials/top.php'); ?>

<h1 class="page-header">Permohonan Izin Melihat</h1>

<form action="ijin.php?id=<?php echo $id_en; ?>" method="post">
    <div class="form-group">
        <label for="nama_file">Nama File</label>
        <input type="text" class="form-control" id="nama_file" name="nama_file" value="<?php echo htmlspecialchars($nama_file); ?>" readonly>
    </div>
    <button type="submit" class="btn btn-primary">Ajukan Permohonan</button>
</form>

<?php include('../_partials/bottom.php'); ?>

<?php $db->close(); ?>
