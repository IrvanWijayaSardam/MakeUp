<?php
require '../repository/dbquery.php';
require '../session.php'
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Record Transaksi</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"
        crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="../page/transaksi.php">Record Transaksi</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <?php
                        $password = mysqli_query($conn, "select * from tb_admin");
                        while ($list = mysqli_fetch_array($password)) {
                            $name = $list['password'];
                            ?>
                            <div>
                                <h3 class="sb-sidenav-menu-heading" style="margin-left: 35px;">Welcome
                                    <?= $name; ?>
                                </h3>
                                <img src="assets/img/settings.png" alt="" style="margin-left: 70px;">
                            </div>

                            <?php
                        }
                        ?>

                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="../index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                            Data Make Up
                        </a>
                        <a class="nav-link" href="pegawai.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                            Pegawai
                        </a>
                        <a class="nav-link" href="pembeli.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-bag"></i></div>
                            Pembeli
                        </a>
                        <a class="nav-link" href="transaksi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>
                            Transaksi
                        </a>
                        <a class="nav-link" href="logout.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Data Transaksi</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="card-header d-flex justify-content-end">
                                <button type="button" class="btn btn-primary ml-2" data-toggle="modal"
                                    data-target="#transaksimodal">Checkout</button>
                            </div>
                        </div>
                        <h3 class="mt-4 text-center">Data Barang</h3>
                        <form method="POST" id="checkoutForm">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nama</th>
                                        <th>Merek</th>
                                        <th>Deskripsi</th>
                                        <th>Stok</th>
                                        <th>Harga Jual</th>
                                        <th>Gambar</th>
                                        <th>Qty Beli</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $viewhandphone = mysqli_query($conn, "SELECT * FROM `tb_barang`");
                                    while ($data = mysqli_fetch_array($viewhandphone)) {
                                        $id = $data['id'];
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $id; ?>
                                            </td>
                                            <td>
                                                <?= $data['nama']; ?>
                                            </td>
                                            <td>
                                                <?= $data['merek']; ?>
                                            </td>
                                            <td>
                                                <?= $data['deskripsi']; ?>
                                            </td>
                                            <td>
                                                <?= $data['stok']; ?>
                                            </td>
                                            <td>
                                                <?= $data['harga_jual']; ?>
                                            </td>
                                            <td><img src="../cdn/<?= $data['gambar']; ?>" alt="Gambar Barang" width="100"
                                                    height="100"></td>
                                            <td>
                                                <input type="number" class="form-control" id="inputNumber<?= $id; ?>"
                                                    placeholder="Qty" min="0" name="qty[]" data-barang-id="<?= $id; ?>">
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </form>

                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; <a href="https://acbagusid.anandanesia.com/about.html"
                                style="text-decoration:none;">Kelompok6 2021</a></div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });

        $(document).on('submit', '#checkoutForm', function (e) {
            e.preventDefault();

            const pembeli = $('select[name="pembeli"]').val();
            const pegawai = $('select[name="pgw"]').val();

            const formElements = document.querySelectorAll("#dataTable input[name='qty[]']");
            const barangList = [];
            const qtyList = [];

            formElements.forEach((input) => {
                const barangId = input.dataset.barangId;
                const qty = input.value;
                if (qty > 0) {
                    barangList.push(barangId);
                    qtyList.push(qty);
                }
            });

            const itemData = {
                barang: barangList,
                qty: qtyList
            };

            const jsonData = JSON.stringify(itemData);

            $.ajax({
                url: 'transaksi.php',
                method: 'POST',
                data: {
                    savetransaksi: true,
                    pembeli: pembeli,
                    pgw: pegawai,
                    itemData: jsonData
                },
                success: function (response) {
                    // Handle the response from the server
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    console.error(error);
                }
            });
        });


    </script>
</body>
<!-- Modal -->
<div class="modal fade" id="transaksimodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pembeli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="checkoutForm">
                <div class="modal-body">
                    <select name="pembeli" class="form-control">
                        <option selected value="<?= $idpembeli; ?>">pilih pembeli</option>
                        <?php
                        $tampilanpembeli = mysqli_query($conn, "select * from tb_pelanggan");
                        while ($fetcharray = mysqli_fetch_array($tampilanpembeli)) {
                            $nama_list = $fetcharray['nama_depan'];
                            $idpembeli = $fetcharray['id'];
                            ?>
                            <option value="<?= $idpembeli; ?>"><?= $nama_list; ?></option>

                            <?php
                        }
                        ?>
                    </select>
                    <br />
                    <select name="pgw" class="form-control">
                        <option selected value="<?= $idpegawai; ?>">pilih pegawai</option>
                        <?php
                        $tampilanpegawai = mysqli_query($conn, "select * from tb_admin");
                        while ($fetcharray = mysqli_fetch_array($tampilanpegawai)) {
                            $namapegawai = $fetcharray['nama_depan'];
                            $idpgw = $fetcharray['id'];
                            ?>
                            <option value="<?= $idpgw; ?>"><?= $namapegawai; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br />
                    <button type="submit" name="savetransaksi" class="btn btn-primary">Buat Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>