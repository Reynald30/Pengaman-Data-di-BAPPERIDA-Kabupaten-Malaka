
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="../dasbor">Aplikasi Pengaman Data</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <p class="navbar-text">Hai, <?php echo $_SESSION['user']['nama_user'] ?></p>
        <li><a href="../dasbor"><i class="glyphicon glyphicon-home"></i> Dasbor</a></li>
      <?php
  include('../../config/koneksi.php');
      $query = "SELECT * FROM user WHERE status_user = 'Admin'";
      $result = $db->query($query);
      $email_admin = $result->fetch_assoc();
      ?>
  <p class="navbar-text">Kontak Admin(<?php echo $email_admin['email'] ?>)</p>
        <li><a href="../../login/logout.php"><i class="glyphicon glyphicon-log-out"></i> Keluar</a></li>
      </ul>
    </div>
  </div>
</nav>
