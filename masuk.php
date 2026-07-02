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
    <title>Barang Masuk</title>
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
                    <h1 class="mt-4">Barang Masuk</h1>


                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Barang
                            </button>
                            <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#cetak"><i class="fas fa-print"></i>Cetak</a>
                            <div id="cetak" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- dialog body -->
                                        <div class="modal-body">
                                            <form action="laporan_masuk.php" method="post" target="_blank">
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
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Gambar</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['filter_tgl'])) {

                                            $mulai = $_POST['tgl_mulai'];
                                            $selesai = $_POST['tgl_selesai'];

                                            if ($mulai != null || $selesai != null) {
                                                $ambilsemuadatastok = mysqli_query($conn, "select * from masuk
                                                INNER JOIN stock on masuk.idbarang = stock.idbarang AND tanggal BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY) order by idmasuk DESC");
                                            } else {
                                                $ambilsemuadatastok = mysqli_query($conn, "select * from masuk
                                                INNER JOIN stock on masuk.idbarang = stock.idbarang order by idmasuk DESC ");
                                            }
                                        } else {
                                            $ambilsemuadatastok = mysqli_query($conn, "select * from masuk
                                            INNER JOIN stock on masuk.idbarang = stock.idbarang order by idmasuk DESC ");
                                        }
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($ambilsemuadatastok)) {
                                            $tanggal = $data['tanggal'];
                                            $idb = $data['idbarang'];
                                            $idm = $data['idmasuk'];
                                            $namabarang = $data['namabarang'];
                                            $qty = $data['qty'];
                                            $keterangan = $data['keterangan'];
                                            $kodebarang = isset($data['kode_barang']) ? $data['kode_barang'] : '-';

                                            //cek  ada gambar/tdk
                                            $gambar = $data['image']; //ambil gambar
                                            if ($gambar == null) {
                                                $img = 'no photo';
                                            } else {
                                                $img = '<img src="images/' . $gambar . '" class="zoomable">';
                                            }
                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $tanggal; ?></td>
                                                <td><?= $img; ?></td>
                                                <td><span class="badge badge-primary" style="font-size:13px;letter-spacing:1px;"><?= $kodebarang; ?></span></td>
                                                <td><?= $namabarang; ?></td>
                                                <td><?= $qty; ?></td>
                                                <td><?= $keterangan; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $idm; ?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idm; ?>">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?= $idm; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Edit Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Edit Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <input type="text" name="keterangan" value="<?= $keterangan; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="number" name="qty" value="<?= $qty; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                <input type="hidden" name="idm" value="<?= $idm; ?>">
                                                                <button type="submit" class="btn btn-primary" name="updatebarangmasuk">Update</button>
                                                            </div>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="delete<?= $idm; ?>">
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
                                                                <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                <input type="hidden" name="qty" value="<?= $qty; ?>">
                                                                <input type="hidden" name="idm" value="<?= $idm; ?>">
                                                                <br>
                                                                <br>
                                                                <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Hapus</button>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>

<!-- Modal Tambah Barang -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang Masuk</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <!-- Kode Barang otomatis -->
                    <div class="form-group">
                        <label><strong>Kode Barang (Otomatis)</strong></label>
                        <input type="text" id="preview_kode_barang" class="form-control"
                            placeholder="Memuat kode..."
                            readonly
                            style="background:#eef3ff; color:#0056b3; font-weight:bold; letter-spacing:2px; cursor:not-allowed; border:2px solid #0056b3;">
                        <small class="text-muted">&#128196; Format: TAHUN+BULAN+URUTAN (contoh: <?= date('Ym') ?>0001)</small>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <select name="barangnya" class="form-control">
                            <?php
                            $q = mysqli_query($conn, "select * from stock");
                            while ($r = mysqli_fetch_array($q)) {
                            ?>
                                <option value="<?= $r['idbarang']; ?>"><?= $r['namabarang']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="qty" class="form-control" placeholder="Quantity" required>
                    </div>
                    <div class="form-group">
                        <label>Penerima</label>
                        <input type="text" name="penerima" class="form-control" placeholder="Penerima" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="barangmasuk">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#myModal').on('show.bs.modal', function () {
        var now = new Date();
        var tahun = now.getFullYear();
        var bulan = String(now.getMonth() + 1).padStart(2, '0');
        var prefix = tahun + '' + bulan;

        fetch('get_kode_barang.php')
            .then(function(response) { return response.text(); })
            .then(function(kode) {
                kode = kode.trim();
                $('#preview_kode_barang').val(kode.length > 0 ? kode : prefix + '0001');
            })
            .catch(function() {
                $('#preview_kode_barang').val(prefix + '0001');
            });
    });
});
</script>

</body>
</html>