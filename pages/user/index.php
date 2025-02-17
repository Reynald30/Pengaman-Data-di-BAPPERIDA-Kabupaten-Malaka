
<?php include('../_partials/top.php') ?>

<h1 class="page-header">Data User</h1>
<?php include('_partials/menu.php') ?>

<?php include('data-index.php') ?>

<table class="table table-striped table-condensed table-hover" id="datatable">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Username</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $no = 1; // Inisialisasi nomor urut
    foreach ($data_user as $user) : ?>
    <tr>
      <td><?php echo $no++; ?></td> <!-- Menampilkan nomor urut -->
      <td><?php echo $user['nama_user'] ?></td>
      <td><?php echo $user['username_user'] ?></td>
      <td><?php echo $user['status_user'] ?></td>
      <td>
        <!-- Single button -->
        <div class="btn-group pull-right">
          <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
          <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right" role="menu">
            <li>
              <a href="show.php?id_user=<?php echo htmlspecialchars($user['id_user']); ?>" class="text-info">
                <i class="glyphicon glyphicon-sunglasses"></i> Detail
              </a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="edit.php?id_user=<?php echo htmlspecialchars($user['id_user']); ?>" class="text-warning">
                <span class="glyphicon glyphicon-edit"></span> Ubah
              </a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="delete.php?id_user=<?php echo htmlspecialchars($user['id_user']); ?>" class="text-danger" onclick="return confirm('Yakin hapus data ini?')">
                <i class="glyphicon glyphicon-trash"></i> Hapus
              </a>
            </li>
          </ul>
        </div>
      </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>

<?php include('../_partials/bottom.php') ?>
