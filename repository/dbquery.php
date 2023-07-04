<?php
session_start();

$conn = mysqli_connect("localhost", "root", "root", "db_makeup");

if (isset($_POST['insertbarang'])) {
    // Retrieve other form inputs
    $nama = $_POST['nama_barang'];
    $merek = $_POST['merek_barang'];
    $deskripsi = $_POST['deskripsi_barang'];
    $stok = $_POST['stok_barang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];

    // Handle file upload
    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $gambar_path = 'C:/laragon/www/MakeUp/cdn';
 
    // Move the uploaded file to the desired directory
    move_uploaded_file($gambar_tmp, $gambar_path);

    // Insert the file path into your database
    $tambahbarang = mysqli_query($conn, "INSERT INTO tb_barang (nama, merek, deskripsi, stok, harga_beli, harga_jual, gambar) VALUES ('$nama', '$merek', '$deskripsi', '$stok', '$harga_beli', '$harga_jual', '$gambar')");

    if ($tambahbarang) {
        header('location:index.php');
    } else {
        echo "gagal";
        header('location:index.php');
    }
}
