<?php include('../_partials/top.php') ?>

<h1 class="page-header">Enkripsi</h1>

<?php
include '../../config/koneksi.php';

$sql = "SELECT * FROM dekripsi_av";
$result = $db->query($sql);
?>

<h1>Pilih File untuk Dienkripsi</h1>
<form action="process_encrypt.php" method="post">
    <select name="file_id" required>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_de'] . "'>" . $row['nama_file'] . "</option>";
            }
        } else {
            echo "<option value=''>Tidak ada file yang tersedia</option>";
        }
        ?>
    </select>
    <input type="text" name="key" placeholder="Masukan Kunci" required>
    <button type="submit" onclick='return confirm("Terenkripsi")'>Enkrip</button>
</form>

<?php include('../_partials/bottom.php') ?>
