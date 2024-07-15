<?php include('../_partials/top.php') ?>

<h1 class="page-header">Enkripsi</h1>
<?php include('_partials/menu.php') ?>

<h1>Upload File</h1>
<form action="process_encrypt.php" method="post" enctype="multipart/form-data">
    <table class="table table-striped table-middle">
        <tr>
            <th width="20%">File</th>
            <td width="1%">:</td>
            <td><input type="file" name="file" required></td>
        </tr>
        <tr>
            <th>Kunci</th>
            <td>:</td>
            <td><input type="text" name="key" placeholder="Masukan Kunci" required></td>
        </tr>
    </table>
    <button type="submit" class="btn btn-primary btn-lg" onclick='return confirm("Terenkripsi")'>
        <i class="glyphicon glyphicon-lock"></i> Enkrip
    </button>
</form>
<?php include('../_partials/bottom.php') ?>
