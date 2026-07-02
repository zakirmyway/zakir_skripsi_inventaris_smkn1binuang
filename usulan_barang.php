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
    <title>Usulan Barang</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

    <style>
        .zoomable {
            width: 100px;
        }

        .zoomable:hover {
            transform: scale(1.5);
            transition: 0.3s ease;
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
                    <h1 class="mt-4">Usulan Barang</h1>


                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Data
                            </button>
                            <a href="laporan_usulanbarang.php" target="_blank" class="btn btn-info ">Cetak</a>
                            <div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Nama Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Merek</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $ambilsemuadatastok = mysqli_query($conn, "select * from pengajuan");



                                                $i = 1;
                                                while ($data = mysqli_fetch_array($ambilsemuadatastok)) {
                                                    $idp = $data['idpengajuan'];
                                                    $idb = $data['idbarang'];
                                                    $tanggal = $data['tanggal'];
                                                    $namabarang = $data['namabarang'];
                                                    $qty = $data['qty'];
                                                    $merek = $data['merek'];
                                                    $status = $data['status'];

                                                ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td><?= $tanggal; ?></td>
                                                        <td><?= $namabarang; ?></td>
                                                        <td><?= $qty; ?></td>
                                                        <td><?= $merek; ?></td>
                                                        <td><?= $status; ?></td>
                                                        <td>

                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idp; ?>">
                                                                Delete
                                                            </button>
                                                            <?php


                                                            if ($status == 'menunggu persetujuan') {
                                                                echo '<button type="button" class="btn btn-warning" "btn btn-success" data-toggle="modal" data-target="#edit' . $idp . '">
    Menunggu
    </button>';
                                                            } elseif ($status == 'setuju') {
                                                                //jika statusnya bukan dipinjam (sdh kembali)
                                                                echo '<button type="button" class="btn btn-success" data-toggle="modal">
    Setuju
    </button>';
                                                            } else {
                                                                echo '<button type="button" class="btn btn-danger" data-toggle="modal">
   tdk setuju
    </button>';
                                                            }




                                                            ?>


                                                        </td>
                                                    </tr>

                                                    <!-- Edit Modal -->
                                                    <div class="modal fade" id="edit<?= $idp; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                                <!-- Edit Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Menunggu persetujuan barang</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>

                                                                <!-- Edit Modal body -->
                                                                <form method="post">
                                                                    <div class="modal-body">


                                                                        <input type="hidden" name="idp" value="<?= $idp; ?>">
                                                                        <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                        <button type="submit" class="btn btn-primary" name="setujuu">setuju</button>
                                                                        <button type="submit" class="btn btn-danger" name="tidaksetuju">tidak setuju</button>
                                                                    </div>
                                                                </form>


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="delete<?= $idp; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                                <!-- Delete Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus Barang</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>

                                                                <!-- Delete Modal body -->
                                                                <form method="post">
                                                                    <div class="modal-body">
                                                                        Apakah anda yakin ingin menghapus <?= $namabarang; ?>?
                                                                        <input type="hidden" name="idp" value="<?= $idp; ?>">
                                                                        <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                        <br>
                                                                        <br>
                                                                        <button type="submit" class="btn btn-danger" name="hapuspengajuan">Hapus</button>
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
</body>
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Pengajuan </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">

                    <br>
                    <input type="text" name="namabarang" class="form-control" placeholder="Nama Barang" required oninput="this.value = this.value.toUpperCase()">
                    <br>
                    <input type="number" name="qty" class="form-control" placeholder="Quantity" required>
                    <br>
                    <input type="text" name="merek" class="form-control" placeholder="Merek" required oninput="this.value = this.value.toUpperCase()">
                    <br>
                    <input type="date" name="tanggal" class="form-control" placeholder="Tanggal" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="addpengajuan">Submit</button>
                </div>
            </form>


        </div>
    </div>
</div>

</html>