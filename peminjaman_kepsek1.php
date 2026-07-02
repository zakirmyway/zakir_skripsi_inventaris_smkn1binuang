<?php
require 'function.php';
require 'cek.php';

//get data
//ambil data total
$get1 = mysqli_query($conn, "select * from peminjaman ");
$count1 = mysqli_num_rows($get1);  //menghitung seluruh kolom

//ambil data peminjaman yang statusnya dipinjam
$get2 = mysqli_query($conn, "select * from peminjaman where status='dipinjam'");
$count2 = mysqli_num_rows($get2);  //menghitung seluruh kolom yang statusnya dipinjam

//ambil data peminjaman yang statusnya kembali
$get3 = mysqli_query($conn, "select * from peminjaman where status='kembali'");
$count3 = mysqli_num_rows($get3);  //menghitung seluruh kolom yang statusnya dipinjam



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Peminjaman Barang</title>
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
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Kepala Sekolah</span>

                    <img src="images/kepsek.png" width="30">
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
                        <a class="nav-link" href="index_kepsek.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                            Stok Barang di Gudang
                        </a>
                        <a class="nav-link" href="masuk_kepsek.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-download"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar_kepsek.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-upload"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" href="peminjaman_kepsek.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-exchange-alt"></i></div>
                            Peminjaman Barang
                        </a>
                        <a class="nav-link" href="kondisi_kepsek.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
                            Kondisi Barang
                        </a>
                        <a class="nav-link" href="pegawai_kepsek.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Data Pegawai
                        </a>
                        <a class="nav-link" href="rab_kepsek.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                            Rencana Anggaran Belanja
                        </a>
                        <a class="nav-link" href="usulan_barang_kepsek.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-envelope-open-text"></i></div>
                            Usulan Barang
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
                    <h1 class="mt-4">Peminjaman Barang</h1>


                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->

                            <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#cetak"><i class="fas fa-print"></i>Cetak</a>
                            <div id="cetak" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- dialog body -->
                                        <div class="modal-body">
                                            <form action="laporan_peminjaman.php" method="post" target="_blank">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">Dari Tanggal</div>
                                                        </td>
                                                        <td align="center" width="5%">
                                                            <div class="form-group">:</div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="date" class="form-control" name="tgl_a" required>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">Sampai Tanggal</div>
                                                        </td>
                                                        <td align="center" width="5%">
                                                            <div class="form-group">:</div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="date" class="form-control" name="tgl_s" required>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <input type="submit" name="cetakmasuk" class="btn btn-primary btn sm" value="Cetak">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row mt-4">
                                <div class="col">
                                    <div class="card bg-info text-white p-2">
                                        <h3>Total Data: <?= $count1; ?></h3>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card bg-danger text-white p-2">
                                        <h3>Total dipinjam: <?= $count2; ?></h3>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card bg-success text-white p-2">
                                        <h3>Total kembali: <?= $count3; ?></h3>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <br>
                            <div class="row">
                                <form method="post" class="form-inline">
                                    <input type="date" name="tgl_mulai" class="form-control">
                                    <input type="date" name="tgl_selesai" class="form-control">
                                    <button type="submit" name="filter_tgl" class="btn btn-info">Filter</button>

                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Pinjam</th>
                                            <th>Tanggal Kembali</th>
                                            <th>Gambar</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Kepada</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['filter_tgl'])) {

                                            $mulai = $_POST['tgl_mulai'];
                                            $selesai = $_POST['tgl_selesai'];

                                            if ($mulai != null || $selesai != null) {

                                                $ambilsemuadatastok = mysqli_query($conn, "select * from peminjaman
                                                INNER JOIN stock on peminjaman.idbarang = stock.idbarang and tanggalpinjam BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY) order by idpeminjaman DESC");
                                            } else {
                                                $ambilsemuadatastok = mysqli_query($conn, "select * from peminjaman
                                                INNER JOIN stock on peminjaman.idbarang = stock.idbarang order by idpeminjaman DESC ");
                                            }
                                        } else {
                                            $ambilsemuadatastok = mysqli_query($conn, "select * from peminjaman
                                            INNER JOIN stock on peminjaman.idbarang = stock.idbarang order by idpeminjaman DESC ");
                                        }


                                        //$ambilsemuadatastok = mysqli_query($conn, "select * from keluar k, stock s where s.idbarang = k.idbarang");
                                        while ($data = mysqli_fetch_array($ambilsemuadatastok)) {
                                            $idk = $data['idpeminjaman'];
                                            $idb = $data['idbarang'];
                                            $tanggalp = $data['tanggalpinjam'];
                                            $tanggalk = $data['tanggalkembali'];
                                            $namabarang = $data['namabarang'];
                                            $qty = $data['qty'];
                                            $penerima = $data['peminjam'];
                                            $status = $data['status'];

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
                                                <td><?= $tanggalp; ?></td>
                                                <td><?= $tanggalk; ?></td>
                                                <td><?= $img; ?></td>
                                                <td><?= $namabarang; ?></td>
                                                <td><?= $qty; ?></td>
                                                <td><?= $penerima; ?></td>
                                                <td><?= $status; ?></td>
                                                <td>


                                                    <?php

                                                    //cek status
                                                    if ($status == 'dipinjam') {
                                                        echo '<button type="button" class="btn btn-warning" "btn btn-success" data-toggle="modal" data-target="#edit' . $idk . '">
                                                        Selesai
                                                        </button>';
                                                    } else {
                                                        //jika statusnya bukan dipinjam (sdh kembali)
                                                        echo '<button type="button" class="btn btn-success" data-toggle="modal">
                                                        dikembalikan
                                                        </button>';
                                                    }

                                                    ?>


                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->

                                            <!-- Delete Modal -->


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


</html>