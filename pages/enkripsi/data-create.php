<?php
include('../../config/koneksi.php');

// ambil dari database
$query = "SELECT * FROM enkripsi";

$hasil = mysqli_query($db, $query);

$data_enkrip = array();

while ($row = mysqli_fetch_assoc($hasil)) {
  $data_enkrip[] = $row;
}
