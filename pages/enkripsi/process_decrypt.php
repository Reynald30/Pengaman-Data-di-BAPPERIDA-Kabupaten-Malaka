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
    $query = "SELECT * FROM enkripsi WHERE id_en = $file_id";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filepath = $row['filepath'];
        $data = file_get_contents($filepath);

        if ($data === false) {
            echo "Error reading encrypted file.";
            exit;
        }

        $decryptedData = vigenereCipher($data, $key, 'decrypt');
        $base64Data = base64_decode($decryptedData);

        if ($base64Data === false) {
            echo "Error decoding base64 data.";
            exit;
        }

        $decryptedFilepath = str_replace('.enc', '', $filepath);

        // Save decrypted data to new file
        if (file_put_contents($decryptedFilepath, $base64Data) === false) {
            echo "Error saving decrypted file.";
            exit;
        }

        // Insert decrypted file info into database
        $filename = basename($decryptedFilepath);
        $filesize = filesize($decryptedFilepath);
        $tanggal = date('Y-m-d');
        $insertQuery = "INSERT INTO dekripsi (nama_file, ukuran_file, tanggal, filepath) VALUES ('$filename', '$filesize', '$tanggal', '$decryptedFilepath')";

        if ($db->query($insertQuery) === true) {
            header('Location: index.php');
            exit;
        } else {
            echo "Error inserting decrypted file info into database.";
        }
    } else {
        echo "No record found with id $file_id.";
    }
} else {
    echo "Invalid request.";
}
?>
