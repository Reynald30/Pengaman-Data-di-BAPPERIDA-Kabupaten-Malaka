<?php
include '../../config/koneksi.php';

function vigenereCipher($data, $key, $mode) {
    $keyLength = strlen($key);
    $keyIndex = 0;
    $output = '';
    $key = strtoupper($key);

    for ($i = 0; $i < strlen($data); $i++) {
        $char = $data[$i];
        if (ctype_alpha($char)) {
            $offset = ctype_upper($char) ? ord('A') : ord('a');
            $ordChar = ord($char);
            if ($mode == 'encrypt') {
                $char = chr(($ordChar - $offset + ord($key[$keyIndex % $keyLength]) - ord('A')) % 26 + $offset);
            } else {
                $char = chr(($ordChar - $offset - (ord($key[$keyIndex % $keyLength]) - ord('A')) + 26) % 26 + $offset);
            }
            $keyIndex++;
        }
        $output .= $char;
    }

    return $output;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['file_id']) && isset($_POST['key'])) {
    $file_id = intval($_POST['file_id']);
    $key = $_POST['key'];

    // Get file details from database
    $query = "SELECT * FROM dekripsi WHERE id_de = $file_id";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filepath = $row['filepath'];
        $data = file_get_contents($filepath);
        $base64Data = base64_encode($data);
        $encryptedData = vigenereCipher($base64Data, $key, 'encrypt');

        // Save encrypted data to new file
        $encryptedFilepath = $filepath . '.enc';
        file_put_contents($encryptedFilepath, $encryptedData);

        // Insert encrypted file info into database
        $filename = $row['nama_file'] . '.enc';
        $filesize = filesize($encryptedFilepath);
        $tanggal = date('Y-m-d');
        $insertQuery = "INSERT INTO enkripsi (nama_file, ukuran_file, tanggal, filepath) VALUES ('$filename', '$filesize', '$tanggal', '$encryptedFilepath')";
        $db->query($insertQuery);
        header('Location: index.php');
       } else {
        echo "No record found with id $file_id.";
    }
} else {
    echo "Invalid request.";
}
?>
