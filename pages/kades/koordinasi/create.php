<?php
// Mulai sesi
session_start();

// Pastikan pengguna memiliki sesi aktif
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}
?>

<?php include('../_partials/top.php') ?>

<h1 class="page-header">Unggah File Dokumen Terdekripsi</h1>
<?php include('_partials/menu.php') ?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Pilih File:</label>
                <input type="file" class="form-control-file" id="file" name="file" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <button type="submit" class="btn btn-primary">Unggah</button>
            <a href="index.php" class="btn btn-default">Batal</a>
        </form>
    </div>
</div>

<?php include('../_partials/bottom.php') ?>
