<?php include('../_partials/top.php') ?>

<h1 class="page-header">Ijin</h1>

<?php
include '../../config/koneksi.php';

$id_ijin = $_GET['id'] ?? ''; // Mengambil id_ijin dari URL

if (!empty($id_ijin)) {
    // Query untuk mengambil data berdasarkan id_ijin
    $sql = "SELECT ijin.*, user.nama_user, user.status_user, user.tempat 
            FROM ijin 
            JOIN user ON ijin.id_user = user.id_user 
            WHERE ijin.id_ijin = ?";
    
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $id_ijin);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger'>Data izin tidak ditemukan.</div>";
        exit();
    }
} else {
    echo "<div class='alert alert-danger'>ID izin tidak ditemukan.</div>";
    exit();
}
?>

<!-- Form untuk mengubah status izin -->
<form method="POST" action="simpan.php">
    <input type="hidden" name="id_ijin" value="<?php echo $row['id_ijin']; ?>">

    <div class="form-group">
        <label for="nama_user">Nama User:</label>
        <input type="text" class="form-control" id="nama_user" value="<?php echo htmlspecialchars($row['nama_user']); ?>" disabled>
    </div>

    <div class="form-group">
        <label for="status_user">Jabatan:</label>
        <input type="text" class="form-control" id="status_user" value="<?php echo htmlspecialchars($row['status_user']); ?>" disabled>
    </div>

    <div class="form-group">
        <label for="tempat">Tempat:</label>
        <input type="text" class="form-control" id="tempat" value="<?php echo htmlspecialchars($row['tempat']); ?>" disabled>
    </div>

    <div class="form-group">
        <label for="tanggal">Tanggal Izin:</label>
        <input type="text" class="form-control" id="tanggal" value="<?php echo htmlspecialchars($row['tanggal']); ?>" disabled>
    </div>

    <div class="form-group">
        <label for="status">Status Izin:</label>
        <select name="status" class="form-control" id="status">
            <option value="Setuju" <?php echo $row['status'] == 'Setuju' ? 'selected' : ''; ?>>Setuju</option>
            <option value="Tolak" <?php echo $row['status'] == 'Tolak' ? 'selected' : ''; ?>>Tolak</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?php include('../_partials/bottom.php') ?>
