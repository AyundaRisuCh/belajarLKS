<?php
$db = new mysqli('endpoint-rds-anda.rds.amazonaws.com', 'admin', 'password', 'sigap_db');

if ($db->connect_error) {
    die("Koneksi database gagal: " . $db->connect_error);
}

$result = $db->query("
    SELECT jenis_bencana, lokasi, DATE_FORMAT(waktu_kejadian, '%d/%m/%Y %H:%i') as waktu 
    FROM data_bencana 
    ORDER BY waktu_kejadian DESC
    LIMIT 50
");

if (!$result) {
    die("Error: " . $db->error);
}

// Tampilkan header sebagai plain text
header('Content-Type: text/plain');

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row['jenis_bencana'] . " - " . $row['lokasi'] . " - " . $row['waktu'] . "\n";
    }
} else {
    echo "Tidak ada data bencana terbaru.";
}

$db->close();
?>
