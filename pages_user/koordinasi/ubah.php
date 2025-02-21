<?php
// Mulai sesi
session_start();

// Periksa apakah pengguna memiliki sesi aktif
if (!isset($_SESSION['user'])) {
    header("Location: ../../login/");
    exit;
}
?>
<?php include('../_partials/top.php') ?>

<h1 class="page-header">Ubah Dokumen </h1>

<?php
// Periksa apakah ada parameter id yang diterima
if (isset($_GET['id'])) {
    include('../../config/koneksi.php');

    // Ambil id dokumen dari parameter
    $id_ko = $_GET['id'];

    // Buat query untuk mengambil informasi dokumen berdasarkan id
    $query = "SELECT * FROM koordinasi WHERE id_ko = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id_ko);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // Jika dokumen ditemukan, tampilkan formulir untuk mengubah informasi
    if ($row) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lakukan pemrosesan unggah file di sini
            // Pastikan untuk menambahkan validasi file yang diunggah (jenis file, ukuran, dll.)

            // Periksa apakah pengguna memilih untuk menggunakan file lama atau mengunggah file baru
            if (isset($_POST["use_old_file"]) && $_POST["use_old_file"] == "on") {
                $nama_file = $row["nama_file"];
                $temporary_file = null; // Tidak ada file yang diunggah
            } else {
                $nama_file = $_FILES["file"]["name"];
                $temporary_file = $_FILES["file"]["tmp_name"];

                // Pindahkan file yang diunggah ke folder yang diinginkan
                move_uploaded_file($temporary_file, "uploads/" . $nama_file);
            }

            $keterangan = $_POST["keterangan"];
            $tanggal = $_POST["tanggal"];

            // Buat query untuk memperbarui informasi dokumen
            $query = "UPDATE koordinasi SET nama_file = ?, keterangan = ?, tanggal = ? WHERE id_ko = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("sssi", $nama_file, $keterangan, $tanggal, $id_ko);
            $stmt->execute();
            $stmt->close();

            // Redirect kembali ke halaman utama setelah dokumen diubah
            header("Location: index.php");
            exit;
        } else {
            // Tampilkan formulir untuk mengubah informasi dokumen
            ?>
         
           <div>
        <form action="" method="post" enctype="multipart/form-data">
            <input type='hidden' name='id_ko' value='<?php echo $row['id_ko']; ?>'>
            <div class="form-group">
                <label for="file"> Gunakan file lama: </label>
                <input type='checkbox' name='use_old_file'><br>
            </div>
            <div class="form-group">
                <label for="file"> File Baru: </label>
                <input type="file" class="form-control-file" id="file" name="file" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <textarea class="form-control" id="keterangan" name="keterangan"  value='<?php echo $row['keterangan']; ?>' rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal"  value='<?php echo $row['tanggal']; ?>' required>
            </div>
            <button type="submit" class="btn btn-primary">Unggah</button>
            <a href="index.php" class="btn btn-default">Batal</a>
        </form>
           </div> <?php
        }
    } else {
        echo "Dokumen tidak ditemukan.";
    }
} else {
    // Jika tidak ada parameter id, kembalikan ke halaman sebelumnya
    header("Location: index.php");
    exit;
}
?>
