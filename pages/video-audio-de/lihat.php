<?php
include '../../config/koneksi.php';

if (isset($_GET['id'])) {
    $file_id = intval($_GET['id']);
    
    // Get file details from database
    $query = "SELECT * FROM dekripsi_av WHERE id_de = $file_id";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filepath = $row['filepath'];
        $filename = $row['nama_file'];

        if (file_exists($filepath)) {
            $content = file_get_contents($filepath);
            $mime = mime_content_type($filepath);
        } else {
            echo "File not found.";
            exit;
        }
    } else {
        echo "No record found with id $file_id.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

include('../_partials/top.php');
?>

<h1 class="page-header">Lihat File: <?php echo $filename; ?></h1>

<div class="file-content">
    <?php
    // Display file content based on MIME type
    if (strpos($mime, 'text') !== false) {
        echo "<pre>" . htmlspecialchars($content) . "</pre>";
    } else if (strpos($mime, 'image') !== false) {
        echo "<img src='data:$mime;base64," . base64_encode($content) . "' alt='$filename'>";
    } else if (strpos($mime, 'audio') !== false) {
        echo "<audio controls>
                <source src='data:$mime;base64," . base64_encode($content) . "' type='$mime'>
                Your browser does not support the audio element.
              </audio>";
    } else if (strpos($mime, 'video') !== false) {
        echo "<video controls>
                <source src='data:$mime;base64," . base64_encode($content) . "' type='$mime'>
                Your browser does not support the video element.
              </video>";
    } else {
        echo "<p>Cannot display this file type.</p>";
    }
    ?>
</div>

<?php include('../_partials/bottom.php') ?>

<style>
    /* CSS untuk menghindari discroll ke samping */
    body {
        overflow-x: hidden;
    }
</style>

<script>
    // Scroll ke bawah halaman
    window.onload = function() {
        window.scrollTo(0, document.body.scrollHeight);
    };
</script>
