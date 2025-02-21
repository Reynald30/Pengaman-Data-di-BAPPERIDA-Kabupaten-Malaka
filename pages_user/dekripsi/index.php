<?php
include('../_partials/top.php');
?><?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../../config/koneksi.php');

// Periksa apakah pengguna memiliki sesi aktif
if (!isset($_SESSION['user'])) {
    header("Location: ../../login/");
    exit;
}

// Ambil informasi pengguna
$id_user = $_SESSION['user']['id_user'];

// Query untuk mengambil data dari tabel ijin yang sesuai dengan id_user yang sedang aktif dan status "Setuju"
$query = "SELECT * FROM ijin WHERE id_user = ? AND status = ?";
$stmt = $db->prepare($query);
$status = 'Setuju';
$stmt->bind_param("is", $id_user, $status);

// Eksekusi query
$stmt->execute();
$result = $stmt->get_result();


// Jika tidak ada hasil, tampilkan pesan debug
if ($result->num_rows == 0) {
    echo "Tidak ada data yang ditemukan untuk ID User: $id_user dengan status 'Setuju'.<br>";
}


?>

<h1 class="page-header">Dokumen Terdekripsi</h1>

<table class="table table-striped table-condensed table-hover" id="datatable">
  <thead>
    <tr>
      <th>No</th>
      <th>File</th>
      <th>Tanggal</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1; // Inisialisasi nomor urut
    if ($result->num_rows > 0) {
        // Menampilkan data per baris dan debug hasil setiap baris
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>"; // Menampilkan nomor urut dan menambahkannya setiap kali loop
            echo "<td><i class='glyphicon glyphicon-file'></i> " . htmlspecialchars($row["nama_file"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["tanggal"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
            echo "<td>";
            echo "<a href='download.php?file=" . urlencode($row["nama_file"]) . "' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-download'></span> Unduh</a>";
            echo "<a href='hapus.php?id=" . $row["id_ijin"] . "' class='btn btn-danger btn-xs' onclick='return confirm(\"Apakah Anda yakin ingin menghapus ijin ini?\")'><span class='glyphicon glyphicon-trash'></span> Hapus</a>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5' class='text-center'>Tidak ada data</td></tr>";
    }
    ?>
  </tbody>
</table>

<?php
include('../_partials/bottom.php');
$stmt->close();
$db->close();
?>
