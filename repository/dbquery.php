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
    $gambar_path = 'C:/laragon/www/MakeUp/cdn/'.$gambar;
 
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

if (isset($_POST['updatebarang'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $merek = $_POST['merek'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $gambarname = $_POST['pathgambar'];
    $gambar = $_FILES['gambar']['name'];

    if($gambar != null){
        $gambar_tmp = $_FILES['gambar']['tmp_name'];
        $gambar_path = 'C:/laragon/www/MakeUp/cdn/'.$gambar;
     
        // Move the uploaded file to the desired directory
        move_uploaded_file($gambar_tmp, $gambar_path);
    
    
        $updatehp = mysqli_query($conn, "UPDATE tb_barang set nama='$nama', merek='$merek', deskripsi='$deskripsi' , stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual',gambar='$gambar' where id='$id' ");
        if ($updatehp) {
            header('location:index.php');
        } else {
            echo "gagal";
            //header('location:index.php');
        }
    } else {
        $updatehp = mysqli_query($conn, "UPDATE tb_barang set nama='$nama', merek='$merek', deskripsi='$deskripsi' , stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual',gambar='$gambarname' where id='$id'");
        if ($updatehp) {
            header('location:index.php');
        } else {
            echo('update gagal');
            //header('location:index.php');
        }
    }
    // Handle file upload
}

// insert transaksi
// Checkout process
if (isset($_POST['savetransaksi'])) {
    $pembeli = $_POST['pembeli'];
    $pegawai = $_POST['pgw'];
    $itemData = $_POST['itemData'];
    echo "<script>alert('$itemData');</script>";

    // Decode the JSON data to retrieve the selected items' information
    $itemData = json_decode($itemData, true);
    $barangList = $itemData['barang'];
    $qtyList = $itemData['qty'];

    // Check if at least one item is selected
    if (!empty($barangList) && !empty($qtyList)) {

        // Insert the transaction details into the database
        $insertTransaksi = mysqli_query($conn, "INSERT INTO tb_transaksi (id_pelanggan, id_admin, tgl_transaksi) VALUES ('$pembeli', '$pegawai', NOW())");

        if ($insertTransaksi) {
            $idTransaksi = mysqli_insert_id($conn);

            // Insert the selected items' details into the tb_detail_trx table
            for ($i = 0; $i < count($barangList); $i++) {
                $barangId = $barangList[$i];
                $qty = $qtyList[$i];

                $insertDetail = mysqli_query($conn, "INSERT INTO tb_detail_trx (id_transaksi, id_barang, qty) VALUES ('$idTransaksi', '$barangId', '$qty')");

                if ($insertDetail) {
                    // Update the stock for each item
                    $updateStock = mysqli_query($conn, "UPDATE tb_barang SET stok = stok - '$qty' WHERE id = '$barangId'");
                    if (!$updateStock) {
                        echo "<script>alert('Failed to update stock for item with ID: $barangId');</script>";
                    }
                } else {
                    echo "<script>alert('Failed to insert detail for item with ID: $barangId');</script>";
                }
            }
            echo "<script>alert('Transaksi berhasil disimpan.');</script>";
        } else {
            echo "<script>alert('Gagal menyimpan transaksi.');</script>";
        }

    } else {
        if (empty($barangList)) {
            echo "<script>alert('Barang belum dipilih.');</script>";
        } else if (empty($qtyList)) {
            echo "<script>alert('Jumlah qty belum diisi.');</script>";
        }
    }
}
?>