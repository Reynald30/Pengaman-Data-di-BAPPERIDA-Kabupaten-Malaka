<?php
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
    <a href="../enkripsi" class="<?php echo is_active('enkripsi'); ?>"><i class="glyphicon glyphicon-lock"></i> Dokumen Terenkripsi</a>
  </li>
  <li class="<?php echo is_active('dekripsi'); ?>">
    <a href="../dekripsi" class="<?php echo is_active('dekripsi'); ?>"><i class="glyphicon glyphicon-lock"></i> Dokumen Terdekripsi</a>
  </li>
</ul>

<ul class="nav nav-sidebar">
  <li class="<?php echo is_active('permohonan'); ?>">
    <a href="../permohonan" class="<?php echo is_active('permohonan'); ?>"><i class="glyphicon glyphicon-envelope"></i> History Permohonan</a>
  </li>
  <li class="<?php echo is_active('koordinasi'); ?>">
    <a href="../koordinasi" class="<?php echo is_active('koordinasi'); ?>"><i class="glyphicon glyphicon-signal"></i> Koordinasi</a>
  </li>
</ul>


