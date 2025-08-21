<?php
include 'koneksi.php'; // Pastikan koneksi database sudah ada

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Menghapus data dari database
    $sql = "DELETE FROM jenis_kamar WHERE id_jenis_kamar = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Jika penghapusan berhasil, arahkan ke lihat-data.php dengan status success
        header("Location: lihat-data.php?status=success");
    } else {
        // Jika terjadi kesalahan, arahkan ke lihat-data.php dengan status error
        header("Location: lihat-data.php?status=error");
    }

    $stmt->close();
    $koneksi->close();
} else {
    // Jika id tidak diberikan, arahkan ke lihat-data.php dengan status error
    header("Location: lihat-data.php?status=error");
}
?>
