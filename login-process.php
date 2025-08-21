<?php
session_start();
include 'koneksi.php'; // File koneksi ke database

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk mengambil data pengguna berdasarkan username
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $koneksi->query($sql);

// Cek apakah username ditemukan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verifikasi password
    if ($password == $row['password']) { // Hindari plain password, sebaiknya gunakan password_hash dan password_verify
        // Jika login berhasil, set session
        $_SESSION['username'] = $row['username'];

        // Redirect ke halaman index.php
        header("Location: index.php");
        exit(); // Menghentikan eksekusi lebih lanjut
    } else {
        // Jika password salah
        echo "<script>alert('Password salah!'); window.location.href='login.php';</script>";
    }
} else {
    // Jika username tidak ditemukan
    echo "<script>alert('Username tidak ditemukan!'); window.location.href='login.php';</script>";
}
?>
