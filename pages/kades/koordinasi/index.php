<?php include('../_partials/top.php') ?>

<h1 class="page-header">Koordinasi</h1>
<?php include('_partials/menu.php') ?>

<?php
include '../../../config/koneksi.php';

// Ambil id pengguna yang sedang aktif
$id_user = $_SESSION['user']['id_user'];

// Ubah kueri SQL untuk hanya memilih data yang sesuai dengan id pengguna yang aktif
$sql = "SELECT * FROM koordinasi WHERE id_user = $id_user";
$result = $db->query($sql);
?>
<table class="table table-striped table-condensed table-hover" id="datatable">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama File</th>
      <th>Keterangan</th>
      <th>Tanggal</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1; // Inisialisasi nomor urut
    if ($result->num_rows > 0) {
        // Menampilkan data per baris
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>"; // Menampilkan nomor urut dan menambahkannya setiap kali loop
            echo "<td><i class='glyphicon glyphicon-file'></i> " . $row["nama_file"] . "</td>";
            echo "<td>" . htmlspecialchars($row["keterangan"]) . "</td>";
            echo "<td>" . $row["tanggal"] . "</td>";
            echo "<td>";
            echo "<div class='btn-group'>";
            echo "<button type='button' class='btn btn-default btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='true'>";
            echo "<span class='caret'></span>";
            echo "</button>";
            echo "<ul class='dropdown-menu pull-right' role='menu'>";
            echo "<li><a href='download.php?id=" . $row['id_ko'] . "' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-download'></span> Unduh</a></li>"; // Tambahkan tombol unduh dengan mengarahkan ke file download.php
            // Tambahkan tombol hapus dengan mengarahkan ke file hapus.php
            echo "<li><a href='hapus.php?id=" . $row['id_ko'] . "' class='btn btn-danger btn-xs' onclick='return confirm(\"Apakah Anda yakin ingin menghapus file ini?\")'><span class='glyphicon glyphicon-trash'></span> Hapus</a></li>";
            // Tambahkan tombol ubah dengan mengarahkan ke file ubah.php
            echo "<li><a href='ubah.php?id=" . $row['id_ko'] . "' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-edit'></span> Ubah</a></li>";
            echo "</ul>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5' class='text-center'>Tidak ada data</td></tr>";
    }
    ?>
  </tbody>
</table>

<?php include('../_partials/bottom.php') ?>
