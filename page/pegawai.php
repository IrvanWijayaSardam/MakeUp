<?php
require '../repository/dbquery.php';
require '../session.php';

// Get the admin ID from the session
$admin_id = $_SESSION['admin_id'];

// Retrieve the admin's profile picture using the admin ID
$query = "SELECT nama_depan,profile FROM tb_admin WHERE id = $admin_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $admin = mysqli_fetch_assoc($result);
    $profile_picture = $admin['profile'];
    $admin_name = $admin['nama_depan'];
} else {
    // Default profile picture if no result found
    $profile_picture = "default.jpg";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Make Up Dashboard | Admin</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"
        crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="../index.php">Make Up Dashboard</a>
        <div class="ml-auto"> <!-- Add a div with the "ml-auto" class for right alignment -->
            <a class="nav-link" href="../logout.php">
                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                Logout
            </a>
        </div>
    </nav>

    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div>
                            <h3 class="sb-sidenav-menu-heading" style="margin-left: 35px;">Welcome
                                <?= $admin_name; ?>
                            </h3>
                            <img src="../cdn/profile/<?= $profile_picture; ?>" alt="" style="margin-left: 50px;"
                                width=100px>
                        </div>
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="../index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                            Data Make Up
                        </a>
                        <a class="nav-link" href="../page/pegawai.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                            Pegawai
                        </a>
                        <a class="nav-link" href="pembeli.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-bag"></i></div>
                            Pembeli
                        </a>
                        <a class="nav-link" href="../page/transaksi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>
                            Proses Transaksi
                        </a>
                        <a class="nav-link" href="../page/laporantrx.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>
                            Laporan Transaksi
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Data Pegawai</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pgwmodal">
                                Tambah Pegawai
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nama Depan</th>
                                            <th>Nama Belakang</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Telp</th>
                                            <th>Profile Picture</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $viewadmin = mysqli_query($conn, "SELECT * FROM `tb_admin`");
                                        while ($data = mysqli_fetch_array($viewadmin)) {
                                            $id_admin = $data['id'];
                                            $nama_depan = $data['nama_depan'];
                                            $nama_belakang = $data['nama_belakang'];
                                            $email = $data['email'];
                                            $password = $data['password'];
                                            $telp = $data['notelp'];
                                            $profile = $data['profile'];
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $id_admin; ?>
                                                </td>
                                                <td>
                                                    <?= $nama_depan; ?>
                                                </td>
                                                <td>
                                                    <?= $nama_belakang; ?>
                                                </td>
                                                <td>
                                                    <?= $email; ?>
                                                </td>
                                                <td>
                                                    <?= $password; ?>
                                                </td>
                                                <td>
                                                    <?= $telp; ?>
                                                </td>
                                                <td><img src="../cdn/profile/<?= $profile; ?>" alt="Product Image"
                                                        width="200" height="110"></td>
                                                <td>
                                                    <button style="margin: 2px;" type="button" class="btn btn-warning"
                                                        data-toggle="modal"
                                                        data-target="#pgwmodalupdate<?= $id_admin; ?>">update</button>
                                                    <button style="margin: 2px;" type="button" class="btn btn-danger"
                                                        data-toggle="modal"
                                                        data-target="#pgwmodaldelete<?= $id_admin; ?>">delete</button>
                                                </td>
                                            </tr>

                                            <!-- modal update pegawai -->
                                            <div class="modal fade" id="pgwmodalupdate<?= $id_admin; ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update Data Admin
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <input type="text" name="namadepan"
                                                                    value="<?= $nama_depan; ?>" class="form-control">
                                                                <br />
                                                                <input type="text" name="namabelakang"
                                                                    value="<?= $nama_belakang; ?>" class="form-control">
                                                                <br />
                                                                <input type="text" name="email" value="<?= $email; ?>"
                                                                    class="form-control">
                                                                <br />
                                                                <input type="text" name="password" value="<?= $password; ?>"
                                                                    class="form-control">
                                                                <br />
                                                                <input type="text" name="notelp" value="<?= $telp; ?>"
                                                                    class="form-control">
                                                                <br />
                                                                <input type="hidden" name="idadmin"
                                                                    value="<?= $id_admin; ?>">
                                                                <br />
                                                                <img src="../cdn/profile/<?= $profile; ?>" alt="Product Image"
                                                                    width="200" height="110">
                                                                <input type="hidden" name="pathgambar"
                                                                    value="<?= $profile; ?>">
                                                                <input type="file" name="gambar" id="gambarInput"
                                                                    accept=".png, .jpg, .jpeg">
                                                                <br>
                                                                <div id="selectedFileName"></div>
                                                                <br>
                                                                <button type="submit" name="updateadmin"
                                                                    class="btn btn-warning">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- modal update pegawai -->

                                            <!-- delete modal pegawai -->
                                            <div class="modal fade" id="pgwmodaldelete<?= $id_admin; ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus KB</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST">
                                                            <div class="modal-body">
                                                                <fieldset disabled>
                                                                    <input type="text" name="nama" value="<?= $nama_depan; ?>"
                                                                        class="form-control">
                                                                    <br />
                                                                    <input type="text" name="nohp" value="<?= $nama_belakang; ?>"
                                                                        class="form-control">
                                                                    <br />
                                                                </fieldset>
                                                                <br />
                                                                Apakah anda ingin menghapus data admin ini?
                                                                <br />
                                                                <br />
                                                                <input type="hidden" name="idadmin" value="<?= $id_admin; ?>">
                                                                <button type="submit" name="deleteadmin"
                                                                    class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- delete modal pegawai-->

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
                                style="text-decoration:none;">Kelompok6 2021</a></div>
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

<!-- Modal -->
<div class="modal fade" id="pgwmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="text" name="namadepan" placeholder="Nama Depan" class="form-control">
                    <br />
                    <input type="text" name="namabelakang" placeholder="Nama Belakang" class="form-control">
                    <br />
                    <input type="text" name="email" placeholder="Email" class="form-control">
                    <br />
                    <input type="text" name="password" placeholder="Password" class="form-control">
                    <br />
                    <input type="text" name="notelp" placeholder="Nomor Telp" class="form-control">
                    <br />
                    <input type="file" name="gambar" id="gambarInput" accept=".png, .jpg, .jpeg" required>
                    <br>
                    <div id="selectedFileName"></div>
                    <br>
                    <button type="submit" name="insertadmin" class="btn btn-primary">Tambah</button>
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