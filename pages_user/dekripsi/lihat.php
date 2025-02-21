<?php 
include('../_partials/top.php');

// Include file koneksi database
include '../../config/koneksi.php';

// Cek apakah parameter id telah diberikan dalam URL
if(isset($_GET['id'])) {
    // Ambil nilai id dari parameter URL
    $file_id = intval($_GET['id']);
    
    // Query untuk mengambil detail file terdekripsi dari database
    $query = "SELECT * FROM dekripsi WHERE id_de = $file_id";
    $result = $db->query($query);

    // Periksa apakah query berhasil dijalankan
    if ($result->num_rows > 0) {
        // Ambil data file dari hasil query
        $row = $result->fetch_assoc();
        $nama_file = $row['nama_file'];
        $ukuran_file = $row['ukuran_file'];
        $filepath = $row['filepath'];
        $tanggal = $row['tanggal'];
    } else {
        // Jika tidak ada data dengan id yang diberikan
        echo "Tidak ada data dengan ID $file_id.";
        exit;
    }
} else {
    // Jika parameter id tidak diberikan dalam URL
    echo "ID tidak diberikan.";
    exit;
}
?>

<h1 class="page-header">Detail File Terdekripsi</h1>

<div class="row">
    <div class="col-md-6">
        <table class="table table-striped">
            <tr>
                <td>Nama File:</td>
                <td><?php echo $nama_file; ?></td>
            </tr>
            <tr>
                <td>Ukuran File:</td>
                <td><?php echo $ukuran_file; ?> bytes</td>
            </tr>
            <tr>
                <td>Filepath:</td>
                <td><?php echo $filepath; ?></td>
            </tr>
            <tr>
                <td>Tanggal:</td>
                <td><?php echo $tanggal; ?></td>
            </tr>
            <tr>
                <td>Unduh File:</td>
                <td><a href="download.php?id=<?php echo $file_id; ?>" class="btn btn-primary">Unduh</a></td>
            </tr>
        </table>
    </div>
</div>

<?php include('../_partials/bottom.php') ?>
