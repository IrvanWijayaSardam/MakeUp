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
                                <img src="../assets/img/settings.png" alt="" style="margin-left: 70px;">
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
                            Proses Transaksi
                        </a>
                        <a class="nav-link" href="transaksi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>
                            Laporan Transaksi
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
            ```php
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Laporan Transaksi</h1>
                    <div class="card mb-4">
                        <h3 class="mt-4 text-center">Data Transaksi</h3>
                        <form method="POST" id="checkoutForm">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nama Pelaggan</th>
                                        <th>Nama Admin</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $viewhandphone = mysqli_query($conn, "SELECT * FROM vw_transaksi");
                                    while ($data = mysqli_fetch_array($viewhandphone)) {
                                        $id = $data['id'];
                                        $nama_admin = $data['nama_admin'];
                                        $nama_pelanggan = $data['nama_pelanggan'];
                                        $tanggal_transaksi = $data['tgl_transaksi'];
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $id; ?>
                                            </td>
                                            <td>
                                                <?= $data['nama_pelanggan']; ?>
                                            </td>
                                            <td>
                                                <?= $data['nama_admin']; ?>
                                            </td>
                                            <td>
                                                <?= $data['tgl_transaksi']; ?>
                                            </td>
                                            <td>
                                                <button style="margin: 2px;" type="button" class="btn btn-warning"
                                                    data-toggle="modal"
                                                    data-target="#modalupdate<?= $id; ?>">Detail</button>
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
                        <div class="text-muted">Copyright &copy;
                            <a href="https://acbagusid.anandanesia.com/about.html"
                                style="text-decoration:none;">Kelompok6 2021</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    </div>
    </div>

    <?php
    $viewhandphone = mysqli_query($conn, "SELECT * FROM vw_transaksi");
    while ($data = mysqli_fetch_array($viewhandphone)) {
        $id = $data['id'];
        $nama_admin = $data['nama_admin'];
        $nama_pelanggan = $data['nama_pelanggan'];
        $tanggal_transaksi = $data['tgl_transaksi'];
        ?>
        <div class="modal fade" id="modalupdate<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <p>ID Transaksi:</p>
                            <input type="text" name="id" value="<?= $id; ?>" class="form-control" disabled>
                            <br>
                            <p>Nama Pelanggan:</p>
                            <input type="text" name="nama" value="<?= $nama_pelanggan; ?>" class="form-control" disabled>
                            <br>
                            <p>Nama Admin:</p>
                            <input type="text" name="nama_admin" value="<?= $nama_admin; ?>" class="form-control" disabled>
                            <br>
                            <p>Tanggal Transaksi:</p>
                            <input type="text" name="tgl_transaksi" value="<?= $tanggal_transaksi; ?>" class="form-control"
                                disabled>
                            <br>
                            <table class="table table-bordered mt-4">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Qty</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $detail_transaksi = mysqli_query($conn, "SELECT * FROM vw_transaksi_detail WHERE id_transaksi = '$id'");
                                    while ($detail = mysqli_fetch_array($detail_transaksi)) {
                                        $detail_id = $detail['id_transaksi'];
                                        $nama = $detail['nama'];
                                        $qty = $detail['qty'];
                                        $total_price = $detail['total_price'];
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $detail_id; ?>
                                            </td>
                                            <td>
                                                <?= $nama; ?>
                                            </td>
                                            <td>
                                                <?= $qty; ?>
                                            </td>
                                            <td>
                                                <?= $total_price; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

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
    </script>
</body>

</html>