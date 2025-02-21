
<?php include('../_partials/top.php') ?>

<h1 class="page-header">Data Dokumen Terdekripsi</h1>
<?php include('_partials/menu.php') ?>

<?php
include '../../config/koneksi.php';

$sql = "SELECT * FROM dekripsi";
$result = $db->query($sql);
?>
<table class="table table-striped table-condensed table-hover" id="datatable">
  <thead>
    <tr>
      <th>No</th>
      <th>File</th>
      <th>Ukuran File</th>
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
            echo "<td>" . round($row["ukuran_file"] / 1024, 2) . " KB</td>"; // Mengonversi ukuran file ke kilobyte (KB) dan membulatkannya ke 2 desimal
            echo "<td>" . $row["tanggal"] . "</td>";
            echo "<td>";
            echo "<div class='btn-group'>";
            echo "<button type='button' class='btn btn-default btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='true'>";
            echo "<span class='caret'></span>";
            echo "</button>";
            echo "<ul class='dropdown-menu pull-right' role='menu'>";
            echo "<li><a href='lihat.php?id=" . $row['id_de'] . "' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-eye-open'></span> Detai</a></li>  <li class='divider'></li>"; // Tambahkan tombol lihat dengan mengarahkan ke file lihat.php
            echo "<li><a href='hapus.php?id=" . htmlspecialchars($row['id_de']) . "' class='btn btn-danger btn-xs' onclick='return confirm(\"Apakah Anda yakin ingin menghapus file ini?\")'><span class='glyphicon glyphicon-trash'></span> Hapus</a></li><li class='divider'></li>"; // Tambahkan tombol hapus dengan mengarahkan ke file hapus.php
            echo "<li><a href='download.php?id=" . $row['id_de'] . "' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-download'></span> Unduh</a></li>"; // Tambahkan tombol unduh dengan mengarahkan ke file download.php
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
