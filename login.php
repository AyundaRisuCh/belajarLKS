<?php
// login.php
$host = 'YOUR_RDS_ENDPOINT';
$db = 'YOUR_DB_NAME';
$user = 'YOUR_DB_USER';
$pass = 'YOUR_DB_PASSWORD';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    http_response_code(500);
    echo "db_error";
    exit();
}

$nama = $_POST['nama'];
$password = $_POST['password'];

$sql = "SELECT role FROM users WHERE nama=? AND password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $nama, $password);
$stmt->execute();
$stmt->bind_result($role);

if ($stmt->fetch()) {
    echo trim($role); // will be either 'admin' or 'user'
} else {
    echo "invalid";
}

$stmt->close();
$conn->close();
?>
