
<?php include('../_partials/top.php') ?>

<h1 class="page-header">Data User</h1>
<?php include('_partials/menu.php') ?>

<?php include('data-index.php') ?>

<table class="table table-striped table-condensed table-hover" id="datatable">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Tempat</th>
      <th>Email</th>
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
      <td><?php echo $user['tempat'] ?></td>
      <td><?php echo $user['email'] ?></td>
      <td><?php echo $user['status_user'] ?></td>
      <td>
        <!-- Single button -->
        <div class="btn-group pull-right">
          <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
          <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right" role="menu">
            <?php
             echo "<li><a href='show.php?id_user=" . $user['id_user'] . "' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-eye-open'></span> Detai</a></li>  <li class='divider'></li>"; // Tambahkan tombol lihat dengan mengarahkan ke file lihat.php
             echo "<li><a href='edit.php?id_user=" . $user['id_user'] . "' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-download'></span> Ubah</a></li><li class='divider'></li>"; // Tambahkan tombol ubah
            echo "<li><a href='delete.php?id_user=" . htmlspecialchars($user['id_user']) . "' class='btn btn-danger btn-xs' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'><span class='glyphicon glyphicon-trash'></span> Hapus</a></li>"; // Tambahkan tombol hapus dengan mengarahkan ke file hapus.php
             
            ?>
           </ul>
        </div>
      </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>

<?php include('../_partials/bottom.php') ?>
