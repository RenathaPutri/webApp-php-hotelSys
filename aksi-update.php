<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $jenis_kamar = $_POST['jenis_kamar'];
    $fasilitas = $_POST['fasilitas'];
    $tarif = $_POST['tarif'];

    // Query untuk update data
    $query = "UPDATE jenis_kamar SET 
              JENIS_KAMAR = '$jenis_kamar', 
              FASILITAS = '$fasilitas', 
              TARIF = '$tarif' 
              WHERE ID_JENIS_KAMAR = '$id'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Data berhasil diupdate!";
        header("Location: lihat-data.php");
        exit;
    } else {
        echo "Data gagal diupdate!";
    }
} else {
    echo "Form tidak valid!";
}
?>
