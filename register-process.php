<?php
session_start();
include 'koneksi.php'; // File koneksi ke database

// Ambil data dari form pendaftaran
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];

// Validasi input
if (empty($username) || empty($password)) {
    echo "<script>alert('Username dan password harus diisi!'); window.location.href='register.php';</script>";
    exit();
}

// Cek apakah username sudah ada di database
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Username sudah terdaftar
    echo "<script>alert('Username sudah terdaftar!'); window.location.href='register.php';</script>";
    exit();
}

// Enkripsi password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Simpan data ke database
$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param('ss', $username, $hashed_password);

if ($stmt->execute()) {
    // Pendaftaran berhasil, arahkan ke index.php
    header("Location: index.php");
    exit(); // Menghentikan eksekusi lebih lanjut
} else {
    // Pendaftaran gagal
    echo "<script>alert('Pendaftaran gagal! Silakan coba lagi.'); window.location.href='register.php';</script>";
}
?>
