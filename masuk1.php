<?php
require '../function.php';
require '../cek.php';
?>
<?php
include "header.php";
include "sidebar.php"
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Masuk ATK</h6>
                    <!-- Button to Open the Modal -->
                    <br>
                    <a data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-success"><i class="fas fa-plus"></i>
                        Tambah Barang Masuk
                    </a>
                    <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#cetak"><i class="fas fa-print"></i>Cetak</a>
                    <div id="cetak" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- dialog body -->
                                <div class="modal-body">
                                    <form action="../cetakmasuk.php" method="post" target="_blank">
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
                                                        <input type="date" class="form-control" name="tgl_b" required>
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
                    <div class="row mt-4">
                        <div class="col">
                            <form method="post" class="form-inline">
                                <input type="date" name="tgl_mulai" class="form-control">
                                <input type="date" name="tgl_selesai" class="form-control ml-3">
                                <button type="date" name="filter_tgl" class="btn btn-info ml-3">Filter</button>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Barang</th>
                                    <th>Asal Barang</th>
                                    <th>Penerima</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                $conn, "select * from peminjaman p, stock s where s.idbarang = p.idbarang order by idpeminjaman DESC

                                <?php

                                if (isset($_POST['filter_tgl'])) {
                                    $tglmulai = $_POST['tgl_mulai'];
                                    $tglselesai = $_POST['tgl_selesai'];

                                    if ($tglmulai != null || $tglselesai != null) {

                                        $ambilsemuadatastok = mysqli_query($conn, "select * from masuk
                                                    INNER JOIN stok on masuk.idbarang = stok.idbarang 
                                                    INNER JOIN  pegawai on masuk.id_pegawai = pegawai.id_pegawai
                                                    INNER JOIN supplier on masuk.id_supplier = supplier.id_supplier and tanggal BETWEEN '$tglmulai' and 
                                                    DATE_ADD('$tglselesai',INTERVAL 1 DAY)");
                                    } else {
                                        $ambilsemuadatastok = mysqli_query($conn, "select * from masuk 
                                                    INNER JOIN  stok on masuk.idbarang = stok.idbarang 
                                                    INNER JOIN  pegawai on masuk.id_pegawai = pegawai.id_pegawai
                                                    INNER JOIN supplier on masuk.id_supplier = supplier.id_supplier");
                                    }
                                } else {
                                    $ambilsemuadatastok = mysqli_query($conn, "select * from masuk 
                                                INNER JOIN stok on masuk.idbarang = stok.idbarang 
                                                INNER JOIN pegawai on masuk.id_pegawai = pegawai.id_pegawai
                                                INNER JOIN supplier on masuk.id_supplier = supplier.id_supplier");
                                }

                                while ($data = mysqli_fetch_array($ambilsemuadatastok)) {
                                    $idb = $data['idbarang'];
                                    $idm = $data['idmasuk'];
                                    $idpegawai = $data['id_pegawai'];
                                    $idsupplier = $data['id_supplier'];
                                    $tanggal = $data['tanggal'];
                                    $namabarang = $data['namabarang'];
                                    $kodebarang = $data['kode_barang'];
                                    $asalbarang = $data['nama_supp'];
                                    $penerima = $data['nama_pegawai'];
                                    $qty = $data['qty'];
                                    $totalharga = $data['total_harga'];


                                    //cek ada gambar atau tidak
                                    $gambar = $data['image']; //ambil gambar
                                    if ($gambar == null) {
                                        //jika tidak ada gambar
                                        $img = 'No Photo';
                                    } else {
                                        //jika ada gambar
                                        $img = '<img src="../admin/images/' . $gambar . '"class="zoomable">';
                                    }

                                ?>
                                    <tr>
                                        <td><?= $tanggal; ?></td>
                                        <td><?= $namabarang; ?></td>
                                        <td><?= $kodebarang; ?></td>
                                        <td><?= $asalbarang; ?></td>
                                        <td><?= $penerima; ?></td>
                                        <td><?= $qty; ?></td>
                                        <td>Rp.<?= $totalharga; ?></td>
                                        <td><?= $img; ?></td>
                                        <td>
                                            <a class="btn text-primary" data-toggle="modal" data-target="#edit<?= $idm; ?>"><i class="fas fa-edit"></i>
                                            </a>
                                            <a class="btn text-danger" data-toggle="modal" data-target="#delete<?= $idm; ?>"><i class="fas fa-trash"></i>
                                            </a>
                                            <a class='btn text-warning' style='margin-bottom : 5px' href='../cetakserahterima.php?idmasuk=<?= $idm; ?>[idmasuk]' target='_blank'><i class="fas fa-print"></i></a>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="edit<?= $idm; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Barang</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="post">
                                                    <div class="modal-body">
                                                        <select name="suppleirnya" class="form-control">
                                                            <?php
                                                            $ambilsemuadatanya = mysqli_query($conn, "select * from supplier");
                                                            while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                                                                $namasuppleirnya = $fetcharray['nama_supp'];
                                                                $idsuppleirnya = $fetcharray['id_supplier'];
                                                            ?>

                                                                <option value="<?= $idsuppleirnya; ?>"><?= $namasuppleirnya; ?></option>

                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <br>
                                                        <select name="pegawainya" class="form-control">
                                                            <?php
                                                            $ambilsemuadatanya = mysqli_query($conn, "select * from pegawai");
                                                            while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                                                                $namapegawainya = $fetcharray['nama_pegawai'];
                                                                $idpegawainya = $fetcharray['id_pegawai'];
                                                            ?>

                                                                <option value="<?= $idpegawainya; ?>"><?= $namapegawainya; ?></option>

                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <br>
                                                        <input type="number" name="qty" value="<?= $qty; ?>" class="form-control" required>
                                                        <br>
                                                        <input type="text" name="total_harga" value="<?= $totalharga; ?>" class="form-control" required>
                                                        <br>
                                                        <input type="hidden" name="idbarang" value="<?= $idb; ?>">
                                                        <input type="hidden" name="idmasuk" value="<?= $idm; ?>">
                                                        <button type="submit" class="btn btn-primary" name="updatebarangmasuk">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="delete<?= $idm; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus barang?</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="post">
                                                    <div class="modal-body">
                                                        Apakah Anda Yakin ingin menghapus <?= $namabarang; ?>?
                                                        <input type="hidden" name="idbarang" value="<?= $idb; ?>">
                                                        <input type="hidden" name="asal_barang" value="<?= $asalbarang; ?>">
                                                        <input type="hidden" name="nama_pegawai" value="<?= $penerima; ?>">
                                                        <input type="hidden" name="qty" value="<?= $qty; ?>">
                                                        <input type="hidden" name="total_harga" value="<?= $totalharga; ?>">
                                                        <input type="hidden" name="idmasuk" value="<?= $idm; ?>">
                                                        <br>
                                                        <br>
                                                        <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                <?php
                                };
                                ?>
                                <!-- The Modal Masuk -->
                                <div class="modal fade" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Barang Masuk</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <form method="post">
                                                <div class="modal-body">
                                                    <!-- Kode Barang otomatis -->
                                                    <div class="form-group">
                                                        <label><strong>Kode Barang (Otomatis)</strong></label>
                                                        <input type="text" id="preview_kode_barang" class="form-control" placeholder="Akan digenerate otomatis..." readonly style="background:#f0f4ff; color:#0056b3; font-weight:bold; letter-spacing:2px; cursor:not-allowed;">
                                                        <small class="text-muted">Format: TAHUN + BULAN + URUTAN (contoh: <?= date('Ym') ?>0001)</small>
                                                    </div>
                                                    <select name="barangnya" class="form-control">
                                                        <?php
                                                        $ambilsemuadatanya = mysqli_query($conn, "select * from stok");
                                                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                                                            $namabarangnya = $fetcharray['namabarang'];
                                                            $idbarangnya = $fetcharray['idbarang'];
                                                        ?>

                                                            <option value="<?= $idbarangnya; ?>"><?= $namabarangnya; ?></option>

                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <br>
                                                    <select name="suppleirnya" class="form-control">
                                                        <?php
                                                        $ambilsemuadatanya = mysqli_query($conn, "select * from supplier");
                                                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                                                            $namasuppleirnya = $fetcharray['nama_supp'];
                                                            $idsuppleirnya = $fetcharray['id_supplier'];
                                                        ?>

                                                            <option value="<?= $idsuppleirnya; ?>"><?= $namasuppleirnya; ?></option>

                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <br>
                                                    <select name="pegawainya" class="form-control">
                                                        <?php
                                                        $ambilsemuadatanya = mysqli_query($conn, "select * from pegawai");
                                                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                                                            $namapegawainya = $fetcharray['nama_pegawai'];
                                                            $idpegawainya = $fetcharray['id_pegawai'];
                                                        ?>

                                                            <option value="<?= $idpegawainya; ?>"><?= $namapegawainya; ?></option>

                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <br>
                                                    <input type="number" name="qty" class="form-control" placeholder="-- Quantity --" required>
                                                    <br>
                                                    <input type="number" name="total_harga" class="form-control" placeholder="0" required>
                                                    <br>
                                                    <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<script>
// Preview kode barang otomatis saat modal dibuka
$('#myModal').on('show.bs.modal', function () {
    // Generate preview kode barang lokal
    var now = new Date();
    var tahun = now.getFullYear();
    var bulan = String(now.getMonth() + 1).padStart(2, '0');
    var prefix = tahun + '' + bulan;
    
    // Ambil preview kode barang dari server via AJAX
    $.ajax({
        url: 'get_kode_barang.php',
        type: 'GET',
        success: function(kode) {
            $('#preview_kode_barang').val(kode);
        },
        error: function() {
            // Fallback: generate preview lokal (tanpa nomor urut)
            $('#preview_kode_barang').val(prefix + '????' + ' (akan digenerate otomatis)');
        }
    });
});
</script>
    <?php
    include "footer.php";
    ?>