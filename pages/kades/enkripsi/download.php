<?php
include '../../../config/koneksi.php';

if (isset($_GET['id'])) {
    $id_en = intval($_GET['id']);

    // Ambil data file dari database berdasarkan ID
    $query = "SELECT * FROM enkripsi WHERE id_en = $id_en";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $filename = $row['nama_file'] . '.enc';
        $filepath = '../../enkripsi/uploads/' . $filename;

        // Periksa apakah file terenkripsi ada di server
        if (file_exists($filepath)) {
            // Mengatur header untuk mengunduh file terenkripsi
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            readfile($filepath);
            exit;
        } else {
            echo "File tidak ditemukan.";
        }
    } else {
        echo "Data tidak ditemukan di database.";
    }
} else {
    echo "ID tidak valid.";
}
?>
