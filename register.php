<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi database
$db = new mysqli(
    'database-1.cb24ouuuwt7w.ap-southeast-2.rds.amazonaws.com', // Ganti dengan endpoint RDS
    'root',                              // Username RDS
    'admin123#',                      // Password RDS
    'sigap_db'                       // Nama database
);

// Cek koneksi
if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';
    $no_hp = $_POST['no_hp'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Validasi input
    if (empty($nama) || empty($email) || empty($no_hp) || empty($password)) {
        die("Semua field harus diisi: nama, email, no_hp, dan password");
    }
    
    // Cek apakah email sudah terdaftar
    $check = $db->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();
    
    if ($check->num_rows > 0) {
        die("Email sudah terdaftar");
    }
    
    // Simpan ke database dengan role default 'user'
    $stmt = $db->prepare("INSERT INTO users (nama, email, no_hp, password, role) VALUES (?, ?, ?, ?, 'user')");
    $stmt->bind_param("ssss", $nama, $email, $no_hp, $password);
    
    if ($stmt->execute()) {
        echo "Pendaftaran berhasil!<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }
    
    $stmt->close();
    $check->close();
}

// Form pendaftaran sederhana
echo '
<h3>Form Pendaftaran</h3>
<form method="POST" action="">
    Nama: <input type="text" name="nama" required><br>
    Email: <input type="email" name="email" required><br>
    No HP: <input type="text" name="no_hp" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Daftar">
</form>
';

// Tampilkan data user
$result = $db->query("SELECT id, nama, email, role FROM users ORDER BY id DESC");
if ($result && $result->num_rows > 0) {
    echo "<h3>Daftar User:</h3>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nama</th><th>Email</th><th>Role</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . $row['role'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "<p>Tidak ada data user</p>";
}

$db->close();
?>
