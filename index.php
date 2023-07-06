<?php
require './repository/dbquery.php';
require 'session.php'

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"
        crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Dashboard Admin</a>
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
                        <a class="nav-link" href="index.php">
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
                        <a class="nav-link" href="./page/transaksi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>
                            Proses Transaksi
                        </a>
                        <a class="nav-link" href="./page/laporantrx.php">
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
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Data Make Up</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hpmodal">
                                Tambah Stock
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nama</th>
                                            <th>Merek</th>
                                            <th>Deskripsi</th>
                                            <th>Stok</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Gambar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $viewhandphone = mysqli_query($conn, "SELECT * FROM `tb_barang`");
                                        while ($data = mysqli_fetch_array($viewhandphone)) {
                                            $id = $data['id'];
                                            $nama = $data['nama'];
                                            $merek = $data['merek'];
                                            $deskripsi = $data['deskripsi'];
                                            $stok = $data['stok'];
                                            $harga_beli = $data['harga_beli'];
                                            $harga_jual = $data['harga_jual'];
                                            $gambar = $data['gambar'];
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $id; ?>
                                                </td>
                                                <td>
                                                    <?= $nama; ?>
                                                </td>
                                                <td>
                                                    <?= $merek; ?>
                                                </td>
                                                <td>
                                                    <?= $deskripsi; ?>
                                                </td>
                                                <td>
                                                    <?= $stok ?>
                                                </td>
                                                <td>
                                                    <?= "Rp " . $harga_beli; ?>
                                                </td>
                                                <td>
                                                    <?= "Rp " . $harga_jual; ?>
                                                </td>
                                                <td><img src="cdn/<?= $gambar; ?>" alt="Product Image" width="200"
                                                        height="110"></td>
                                                <td>
                                                    <button style="margin: 2px;" type="button" class="btn btn-warning"
                                                        data-toggle="modal"
                                                        data-target="#modalupdate<?= $id; ?>">Update</button>
                                                    <button style="margin: 2px;" type="button" class="btn btn-danger"
                                                        data-toggle="modal"
                                                        data-target="#modaldelete<?= $id; ?>">Delete</button>
                                                </td>
                                            </tr>
                                            <!-- update modal -->
                                            <div class="modal fade" id="modalupdate<?= $id; ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update Barang
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <input type="text" name="nama" value="<?= $nama; ?>"
                                                                    class="form-control" required>
                                                                <br />
                                                                <input type="text" name="merek" value="<?= $merek; ?>"
                                                                    class="form-control" required>
                                                                <br />
                                                                <input type="text" name="deskripsi"
                                                                    value="<?= $deskripsi; ?>" class="form-control"
                                                                    required>
                                                                <br />
                                                                <input type="number" name="stok" value="<?= $stok; ?>"
                                                                    class="form-control" required>
                                                                <br />
                                                                <input type="number" name="harga_beli"
                                                                    value="<?= $harga_beli; ?>" class="form-control"
                                                                    required>
                                                                <br />
                                                                <input type="number" name="harga_jual"
                                                                    value="<?= $harga_jual; ?>" class="form-control"
                                                                    required>
                                                                <br />
                                                                <input type="hidden" name="id" value="<?= $id; ?>">
                                                                <br />
                                                                <img src="cdn/<?= $gambar; ?>" alt="Product Image"
                                                                    width="200" height="110">
                                                                <input type="hidden" name="pathgambar"
                                                                    value="<?= $gambar; ?>">
                                                                <input type="file" name="gambar" id="gambarInput"
                                                                    accept=".png, .jpg, .jpeg">
                                                                <br>
                                                                <div id="selectedFileName"></div>
                                                                <br>
                                                                <button type="submit" name="updatebarang"
                                                                    class="btn btn-primary">Update</button>
                                                                <br>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- update modal -->

                                            <!-- delete modal -->
                                            <div class="modal fade" id="modaldelete<?= $id; ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Barang</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST">
                                                            <div class="modal-body">
                                                                <fieldset disabled>
                                                                    <input type="text" name="nama" value="<?= $nama; ?>"
                                                                        class="form-control" required>
                                                                    <br />
                                                                    <input type="text" name="merek" value="<?= $merek; ?>"
                                                                        class="form-control" required>
                                                                    <br />
                                                                </fieldset>
                                                                <br />
                                                                Apakah anda yakin ingin menghapus barang ini ?
                                                                <br />
                                                                <br />
                                                                <input type="hidden" name="idbarang" value="<?= $id; ?>">
                                                                <button type="submit" name="deletebarang"
                                                                    class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- delete modal -->

                                            <?php
                                        }
                                        ;

                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; <a href="https://acbagusid.anandanesia.com/about.html"
                                style="text-decoration:none;">Belajar PHP </a></div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

<div class="modal fade" id="hpmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="text" name="nama_barang" placeholder="Nama Barang" class="form-control" required>
                    <br>
                    <input type="text" name="merek_barang" placeholder="Merek" class="form-control" required>
                    <br>
                    <input type="text" name="deskripsi_barang" placeholder="Deskripsi" class="form-control" rows="3"
                        required>
                    <br>
                    <input type="number" name="stok_barang" placeholder="Stok" class="form-control" required>
                    <br>
                    <input type="number" name="harga_beli" placeholder="Harga Beli" class="form-control" required>
                    <br>
                    <input type="number" name="harga_jual" placeholder="Harga Jual" class="form-control" required>
                    <br>
                    <input type="file" name="gambar" id="gambarInput" accept=".png, .jpg, .jpeg" required>
                    <br>
                    <div id="selectedFileName"></div>
                    <br>
                    <button type="submit" name="insertbarang" class="btn btn-primary">Tambah</button>
                    <br>
                </div>
            </form>

            <script>
                const gambarInput = document.getElementById('gambarInput');
                const selectedFileName = document.getElementById('selectedFileName');

                gambarInput.addEventListener('change', () => {
                    const fileName = gambarInput.files[0].name;
                    selectedFileName.textContent = fileName;
                });
            </script>

        </div>
    </div>
</div>

</html>