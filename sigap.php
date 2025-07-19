<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi database
$db = new mysqli(
    'endpoint-rds-anda.rds.amazonaws.com', // Ganti dengan endpoint RDS
    'admin',                              // Username RDS
    'password-anda',                      // Password RDS
    'sigap_belajar'                       // Nama database
);

// Cek koneksi
if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}

echo "Koneksi berhasil!<br>";

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';
    $no_hp = $_POST['no_hp'] ?? '';
    
    if (!empty($nama)) {
        $stmt = $db->prepare("INSERT INTO users (nama, email, no_hp) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $email, $no_hp);
        
        if ($stmt->execute()) {
            echo "Data tersimpan!<br>";
        } else {
            echo "Error: " . $stmt->error . "<br>";
        }
    }
}

// Tampilkan data
$result = $db->query("SELECT * FROM users");
if ($result && $result->num_rows > 0) {
    echo "<h3>Data User:</h3>";
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['id'] . " - Nama: " . $row['nama'] . "<br>";
    }
} else {
    echo "Tidak ada data atau error: " . $db->error;
}

$db->close();
?>
