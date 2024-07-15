<?php
include '../../config/koneksi.php';
// Query untuk menghitung total data terenkripsi
$query_encrypted = "SELECT COUNT(*) AS total FROM enkripsi";
$result_encrypted = $db->query($query_encrypted);
$total_encrypted = ($result_encrypted->num_rows > 0) ? $result_encrypted->fetch_assoc()['total'] : 0;
// Query untuk menghitung total data terenkripsi
$query_encrypted_av = "SELECT COUNT(*) AS total FROM enkripsi_av";
$result_encrypted_av = $db->query($query_encrypted_av);
$total_encrypted_av = ($result_encrypted_av->num_rows > 0) ? $result_encrypted_av->fetch_assoc()['total'] : 0;

// Query untuk menghitung total data terdekripsi
$query_decrypted = "SELECT COUNT(*) AS total FROM dekripsi";
$result_decrypted = $db->query($query_decrypted);
$total_decrypted = ($result_decrypted->num_rows > 0) ? $result_decrypted->fetch_assoc()['total'] : 0;
// Query untuk menghitung total data terdekripsi
$query_decrypted_av = "SELECT COUNT(*) AS total FROM dekripsi_av";
$result_decrypted_av = $db->query($query_decrypted_av);
$total_decrypted_av = ($result_decrypted_av->num_rows > 0) ? $result_decrypted_av->fetch_assoc()['total'] : 0;

?>
<?php include('../_partials/top.php') ?>

<h1 class="page-header">Dasbor Admin</h1>

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

    <p>Total ada <?php echo $total_decrypted; ?> data dokumen terdekripsi.</p>
</div>

      <div class="panel-footer">
        <a href="../dekripsi" class="btn btn-primary" role="button">
           Detail »
        </a>
      </div>
    </div>
  </div>
  <div class="row"></div>
  <div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="panel panel-primary">
    <div class="panel-body" style="text-align: center;">
    <img src="../../assets/img/1.png" alt="" style="max-width: 50%; height: auto; margin: 0 auto;">
  
    <p>Total ada <?php echo $total_encrypted_av; ?> data audio dan video terenkripsi.</p>
</div>


      <div class="panel-footer">
        <a href="../audio-video-en" class="btn btn-primary" role="button">
           Detail »
        </a>
      </div>
    </div>
  </div>

  <div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="panel panel-primary">
    <div class="panel-body" style="text-align: center;">
    <img src="../../assets/img/4.png" alt="" style="max-width: 50%; height: auto; margin: 0 auto;">
  
    <p>Total ada <?php echo $total_decrypted_av; ?> data audio dan video terdekripsi.</p>
</div>


      <div class="panel-footer">
        <a href="../video-audio-de" class="btn btn-primary" role="button">
          Detail »
        </a>
      </div>
    </div>
  </div>


</div>

<?php include('../_partials/bottom.php') ?>
