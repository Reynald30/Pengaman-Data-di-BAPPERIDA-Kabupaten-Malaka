<?php include('../_partials/top.php') ?>

<h1 class="page-header">Dekripsi</h1>

<?php
include '../../config/koneksi.php';

$sql = "SELECT * FROM enkripsi";
$result = $db->query($sql);
?>

<h1>Pilih File untuk Didekripsi</h1>
<form action="process_decrypt.php" method="post">
    <select name="file_id" required>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_en'] . "'>" . $row['nama_file'] . "</option>";
            }
        } else {
            echo "<option value=''>Tidak ada file yang tersedia</option>";
        }
        ?>
    </select>
    <input type="text" name="key" placeholder="Masukan Kunci" required>
    <button type="submit" onclick='return confirm("Terdekripsi")'>Dekrip</button>
</form>

<?php include('../_partials/bottom.php') ?>
