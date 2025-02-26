<?php include('../_partials/top.php') ?>

<h1 class="page-header">Data User</h1>
<?php include('_partials/menu.php') ?>

<form action="store.php" method="post">
<table class="table table-striped table-middle">
  <tr>
    <th width="20%">Nama User</th>
    <td width="1%">:</td>
    <td><input type="text" class="form-control" name="nama_user" required></td>
  </tr>
  <tr>
    <th>Username</th>
    <td>:</td>
    <td><input type="text" class="form-control" name="username_user" required></td>
  </tr>
  <tr>
    <th>Password</th>
    <td>:</td>
    <td><input type="password" class="form-control" name="password_user" required></td>
  </tr>
 
  <tr>
    <th>Status</th>
    <td>:</td>
    <td>
      <select class="form-control selectpicker" name="status_user" required>
        <option value="" selected disabled>- pilih -</option>
        <option value="Admin">Admin</option>
        <option value="Pimpinan">Pimpinan</option>        
        <option value="User">User</option>
      </select>
    </td>
  </tr>
  <tr>
    <th>Email</th>
    <td>:</td>
    <td><input type="text" class="form-control" name="email" required></td>
  </tr>
  <tr>
    <th>Tempat</th>
    <td>:</td>
    <td><input type="text" class="form-control" name="tempat" required></td>
  </tr>
</table>

<button type="submit" class="btn btn-primary btn-lg">
  <i class="glyphicon glyphicon-floppy-save"></i> Simpan
</button>
</form>

<?php include('../_partials/bottom.php') ?>
