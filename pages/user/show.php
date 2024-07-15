<?php include('../_partials/top.php') ?>

<h1 class="page-header">Data User</h1>

<?php include('data-show.php') ?>


<table class="table table-striped table-middle">
  <tr>
    <th width="20%">Nama User</th>
    <td width="1%">:</td>
    <td><?php echo $data_user[0]['nama_user'] ?></td>
  </tr>
  <tr>
    <th>Username</th>
    <td>:</td>
    <td><?php echo $data_user[0]['username_user'] ?></td>
  </tr>
  
  <tr>
    <th>Status</th>
    <td>:</td>
    <td><?php echo $data_user[0]['status_user'] ?></td>
  </tr>
  <tr>
    <th>Tempat</th>
    <td>:</td>
    <td><?php echo $data_user[0]['tempat'] ?></td>
  </tr>
</table>

</table>


<?php include('../_partials/bottom.php') ?>
