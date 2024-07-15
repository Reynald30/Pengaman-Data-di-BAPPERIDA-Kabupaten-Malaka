<?php
include '../../config/koneksi.php';

if (isset($_GET['id'])) {
    $file_id = intval($_GET['id']);

    // Query untuk mendapatkan informasi file terenkripsi dari database
    $query = "SELECT * FROM enkripsi_av WHERE id_en = $file_id";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filepath = $row['filepath'];

        // Panggil fungsi untuk mengunduh file
        downloadFile($filepath);
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid request.";
}

function downloadFile($filepath) {
    if (file_exists($filepath)) {
        // Header untuk memulai proses unduh file
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));

        // Baca dan kirim file ke output
        readfile($filepath);
        exit;
    } else {
        echo "File not found.";
    }
}
?>
