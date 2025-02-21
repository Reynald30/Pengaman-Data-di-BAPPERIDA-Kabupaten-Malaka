


<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../../config/koneksi.php');

// Periksa apakah pengguna memiliki sesi aktif
if (!isset($_SESSION['user'])) {
    header("Location: ../../login/login.php");
    exit;
}
// Query untuk menghitung total data terenkripsi
$query_encrypted = "SELECT COUNT(*) AS total FROM enkripsi";
$result_encrypted = $db->query($query_encrypted);
$total_encrypted = ($result_encrypted->num_rows > 0) ? $result_encrypted->fetch_assoc()['total'] : 0;



// Ambil informasi pengguna
$id_user = $_SESSION['user']['id_user'];

// Query untuk menghitung jumlah ijin dengan status 'setuju' yang sesuai dengan id_user yang sedang aktif
$query = "SELECT COUNT(*) AS jumlah_setuju FROM ijin WHERE id_user = ? AND status = 'Setuju'";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$jumlah_setuju = $row['jumlah_setuju'];

$stmt->close();
$db->close();
?>
<?php include('../_partials/top.php') ?>

<h1 class="page-header">Dasbor User</h1>

<div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="panel panel-primary">
    <div class="panel-body" style="text-align: center;">
    <img src="../../assets/img/2.png" alt="" style="max-width: 50%; height: auto; margin: 0 auto;">

    <p>Total ada <?php echo $total_encrypted; ?> data dokumen terenkripsi.</p>
</div>


      <div class="panel-footer">
        <a href="../enkripsi" class="btn btn-primary" role="button">
        Detail »
        </a>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-4">
    <div class="panel panel-primary">
    <div class="panel-body" style="text-align: center;">
    <img src="../../assets/img/3.png" alt="" style="max-width: 50%; height: auto; margin: 0 auto;">

    <p>Total ada <?php echo $jumlah_setuju; ?> data dokumen terdekripsi.</p>
</div>

      <div class="panel-footer">
        <a href="../dekripsi" class="btn btn-primary" role="button">
           Detail »
        </a>
      </div>
    </div>
  </div>
 

</div>

<?php include('../_partials/bottom.php') ?>
