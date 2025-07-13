<?php
function register_user($db, $nama, $email, $no_hp, $password)
{
    if (empty($nama) || empty($email) || empty($no_hp) || empty($password)) {
        return "Semua field harus diisi: nama, email, no_hp, dan password";
    }

    $check = $db->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        return "Email sudah terdaftar";
    }

    $stmt = $db->prepare("INSERT INTO users (nama, email, no_hp, password, role) VALUES (?, ?, ?, ?, 'user')");
    $stmt->bind_param("ssss", $nama, $email, $no_hp, $password);

    if ($stmt->execute()) {
        return "Pendaftaran berhasil!";
    } else {
        return "Error: " . $stmt->error;
    }
}
