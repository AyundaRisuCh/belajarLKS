<?php
// login.php
$host = 'database-1.cb24ouuuwt7w.ap-southeast-2.rds.amazonaws.com';
$db = 'sigap_db';
$user = 'root';
$pass = 'admin123#';

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
