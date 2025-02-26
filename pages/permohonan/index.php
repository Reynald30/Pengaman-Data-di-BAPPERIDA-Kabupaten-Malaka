
<?php include('../_partials/top.php') ?>

<h1 class="page-header">Ijin</h1>

<?php
include '../../config/koneksi.php';

$sql = "SELECT ijin.*, user.nama_user, user.status_user, user.tempat 
        FROM ijin 
        JOIN user ON ijin.id_user = user.id_user
        WHERE ijin.status IS NOT NULL AND ijin.status != ''"; // Menambahkan klausa WHERE untuk memfilter data dengan status yang sudah terisi
$result = $db->query($sql);
?>


<table class="table table-striped table-condensed table-hover" id="datatable">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Nama File</th>
      <th>Jabatan</th>
      <th>Tempat</th>
      <th>Tanggal</th>
      <th>Status</th>
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
            echo "<td>" . htmlspecialchars($row["nama_user"]) . "</td>";
            echo "<td><i class='glyphicon glyphicon-file'></i>" . htmlspecialchars($row["nama_file"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["status_user"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["tempat"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["tanggal"]) . "</td>";
            echo "<td>";
            if (empty($row["status"])) {
                echo "<a href='setuju.php?id=" . htmlspecialchars($row['id_ijin']) . "' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok'></span> Setuju</a> ";
                echo "<a href='tolak.php?id=" . htmlspecialchars($row['id_ijin']) . "' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span> Tolak</a>";
            } else {
                echo htmlspecialchars($row["status"]);
            }
            echo "</td>";
            echo "<td>";
            echo "<div class='btn-group'>";
            echo "<button type='button' class='btn btn-default btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='true'>";
            echo "<span class='caret'></span>";
            echo "</button>";
            echo "<ul class='dropdown-menu pull-right' role='menu'>";
            echo "<li><a href='ubah.php?id=" . htmlspecialchars($row['id_ijin']) . "' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-edit'></span> Ubah</a></li>";
            echo "<li class='divider'></li>";
            if ($_SESSION['user']['status_user'] != 'Petugas') { 
                echo "<li><a href='hapus.php?id=" . htmlspecialchars($row['id_ijin']) . "' class='btn btn-danger btn-xs' onclick='return confirm(\"Apakah Anda yakin ingin menghapus file ini?\")'><span class='glyphicon glyphicon-trash'></span> Hapus</a></li>";
            
            }
            echo "</ul>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8' class='text-center'>Tidak ada data</td></tr>";
    }
    ?>
  </tbody>
</table>

<?php include('../_partials/bottom.php') ?>
