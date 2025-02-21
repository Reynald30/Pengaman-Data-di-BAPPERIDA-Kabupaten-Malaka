<?php
include '../../config/koneksi.php';
function is_active($page) {
  $uri = "$_SERVER[REQUEST_URI]";
  if (strpos($uri, $page)) {
    echo 'active';
  }
}
?>
<ul class="nav nav-sidebar">
  <center><img src="../../assets/img/user.png" alt="" style="max-width: 50%; height: auto; margin: 0 auto;"></center>
</ul>
<ul class="nav nav-sidebar">
  <li class="<?php echo is_active('dasbor'); ?>">
    <a href="../dasbor" class="<?php echo is_active('dasbor'); ?>"><i class="glyphicon glyphicon-home"></i> Dasbor</a>
  </li>
</ul>

<ul class="nav nav-sidebar">
  <li class="<?php echo is_active('enkripsi'); ?>">
    <a href="../enkripsi" class="<?php echo is_active('enkripsi'); ?>"><i class="glyphicon glyphicon-lock"></i> Enkripsi Dokumen</a>
  </li>
  <li class="<?php echo is_active('dekripsi'); ?>">
    <a href="../dekripsi" class="<?php echo is_active('dekripsi'); ?>"><i class="glyphicon glyphicon-lock"></i> Dekripsi Dokumen</a>
  </li>
</ul>

<ul class="nav nav-sidebar">
  <li class="<?php echo is_active('audio-video-en'); ?>">
    <a href="../audio-video-en" class="<?php echo is_active('audio-video-en'); ?>"><i class="glyphicon glyphicon-lock"></i> Enkripsi Audio dan Video</a>
  </li>
  <li class="<?php echo is_active('video-audio-de'); ?>">
    <a href="../video-audio-de" class="<?php echo is_active('video-audio-de'); ?>"><i class="glyphicon glyphicon-lock"></i> Dekripsi Audio dan Video</a>
  </li>
</ul>
<ul class="nav nav-sidebar">
  <li class="<?php is_active('ijin'); ?>">
    <a href="../ijin" class="<?php is_active('ijin'); ?>">
      <i class="glyphicon glyphicon-check"></i> Menunggu Ijin 
      <?php
      // Query untuk menghitung jumlah data yang menunggu ijin
      $sql = "SELECT COUNT(*) AS jumlah FROM ijin WHERE status IS NULL OR status = ''";
      $result = $db->query($sql);
      $row = $result->fetch_assoc();
      $jumlah = $row['jumlah'];
      ?>
      <?php if ($jumlah > 0): ?>
        <span class="badge"><?php echo $jumlah; ?></span>
      <?php endif; ?>
    </a>
  </li>
  <li class="<?php is_active('permohonan'); ?>">
    <a href="../permohonan" class="<?php is_active('permohonan'); ?>"><i class="glyphicon glyphicon-envelope"></i> History Permohonan</a>
  </li>
  <li class="<?php echo is_active('koordinasi'); ?>">
    <a href="../koordinasi" class="<?php echo is_active('koordinasi'); ?>"><i class="glyphicon glyphicon-signal"></i> Koordinasi</a>
  </li>
</ul>

<?php if ($_SESSION['user']['status_user'] != 'User'): ?>
<ul class="nav nav-sidebar">
  <li class="<?php echo is_active('user'); ?>">
    <a href="../user" class="<?php echo is_active('user'); ?>"><i class="glyphicon glyphicon-user"></i> User</a>
  </li>
</ul>
<?php endif; ?>
