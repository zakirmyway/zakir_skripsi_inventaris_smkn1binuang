<?php
require 'function.php';
require 'cek.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Data Pegawai</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <style>
        .zoomable {
            width: 60px;
        }

        .zoomable:hover {
            transform: scale(1.5);
            transition: 0.3s ease;
        }

        a {
            text-decoration: none;
            color: white;
        }
    </style>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php" style="width: max-content; font-size: 15px; padding-right: 1.5rem;"><img src="images/foto1.png" width="35" style="margin-right: 10px;">BMD-SMKN 1 BINUANG</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>

                    <img src="images/admin.png" width="30">
                </a>
                <!-- Dropdown - User Information -->
                <div class=" dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                            Stok Barang di Gudang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-download"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-upload"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" href="peminjaman.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-exchange-alt"></i></div>
                            Peminjaman Barang
                        </a>
                        <a class="nav-link" href="kondisi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
                            Kondisi Barang
                        </a>
                        <a class="nav-link" href="pegawai.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Data Pegawai
                        </a>
                        <a class="nav-link" href="rab.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                            Rencana Anggaran Belanja
                        </a>
                        <a class="nav-link" href="usulan_barang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-envelope-open-text"></i></div>
                            Usulan Barang
                        </a>
                        <a class="nav-link" href="berita_acara.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-trash-alt"></i></div>
                            Pemusnahan Barang
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
                    <h1 class="mt-4">Data Pegawai</h1>


                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Data Pegawai
                            </button>
                            <a href="laporan_pegawai.php" target="_blank" class="btn btn-info">Cetak</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Pegawai</th>
                                            <th>NIP/NIPPPK</th>
                                            <th>Jabatan</th>
                                            <th>Pendidikan</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ambilsemuadatastok = mysqli_query($conn, "select * from pegawai");
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($ambilsemuadatastok)) {

                                            $idg = $data['idpegawai'];
                                            $namapegawai = $data['namapegawai'];
                                            $nip = $data['nip'];
                                            $jabatan = $data['jabatan'];
                                            $pendidikan = $data['pendidikan'];
                                            $ttl = $data['ttl'];
                                            $tgl_lahir = $data['tgl_lahir'];
                                            $alamat = $data['alamat'];

                                            //cek  ada gambar/tdk
                                            $gambar = $data['image']; //ambil gambar
                                            if ($gambar == null) {
                                                //jika tidak ada gambar
                                                $img = 'no photo';
                                            } else {
                                                //jika ada gambar
                                                $img = '<img src="images/' . $gambar . '" class="zoomable">';
                                            }

                                        ?>

                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $img; ?></td>
                                                <td><?= $namapegawai; ?></td>
                                                <td><?= $nip; ?></td>
                                                <td><?= $jabatan; ?></td>
                                                <td><?= $pendidikan; ?></td>
                                                <td><?= $ttl; ?></td>
                                                <td><?= $tgl_lahir; ?></td>
                                                <td><?= $alamat; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $idg; ?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idg; ?>">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?= $idg; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Edit Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Edit Modal body -->
                                                        <form method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <input type="text" name="namapegawai" value="<?= $namapegawai; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="nip" value="<?= $nip; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="jabatan" value="<?= $jabatan; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="pendidikan" value="<?= $pendidikan; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="ttl" value="<?= $ttl; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="date" name="tgl_lahir" value="<?= $tgl_lahir; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="alamat" value="<?= $alamat; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="file" name="file" class="form-control">
                                                                <br>
                                                                <input type="hidden" name="idg" value="<?= $idg; ?>">
                                                                <button type="submit" class="btn btn-primary" name="updatepegawai">Update</button>
                                                            </div>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="delete<?= $idg; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Delete Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Data</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Delete Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah anda yakin ingin menghapus <?= $namapegawai; ?>?
                                                                <input type="hidden" name="idg" value="<?= $idg; ?>">
                                                                <br>
                                                                <br>
                                                                <button type="submit" class="btn btn-danger" name="hapuspegawai">Hapus</button>
                                                            </div>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        };

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
                        <div class="text-muted">Zakir 2026 Mudahan Dimudahkan</div>

                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/jquery-ui.js"></script>
</body>
<script>
    $(function() {
        $("#tgl_lahir").datepicker({
            showAnim: "slide",
            changeMonth: true,
            changeYear: true,
            autoclose: true
        });
    });
</script>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="text" name="namapegawai" placeholder="Nama Pegawai" class="form-control" required>
                    <br>
                    <input type="text" name="nip" class="form-control" placeholder="NIP/NIPPPK" required>
                    <br>
                    <input type="text" name="jabatan" class="form-control" placeholder="Jabatan" required>
                    <br>
                    <input type="text" name="pendidikan" placeholder="Pendidikan" class="form-control" required>
                    <br>
                    <input type="text" name="ttl" placeholder="Tempat Tanggal Lahir" class="form-control" required>
                    <br>
                    <input type="date" name="tgl_lahir" placeholder="Tanggal Lahir" class="form-control" required>
                    <br>
                    <input type="text" name="alamat" placeholder="Alamat" class="form-control" required>
                    <br>
                    <input type="file" name="file" class="form-control">
                    <br>
                    <button type="submit" class="btn btn-primary" name="addnewpegawai">Submit</button>
                </div>
            </form>


        </div>
    </div>
</div>

</html>