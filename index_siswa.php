<?php
require 'function.php';
require 'cek.php';

?>

<?php include "components/header.php" ?>

<body class="sb-nav-fixed">
    <!-- NAVBAR -->
    <?php include "components/siswa/navbar.php" ?>
    <!-- NAVBAR -->

    <!-- SIDEBAR -->
    <?php include "components/siswa/sidebar.php" ?>
    <!-- SIDEBAR -->

    <!-- ================================================================ MAIN -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Peminjaman Barang</h1>


                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Barang
                            </button>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Gambar</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Kepada</th>
                                            <th>Status</th>
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
                                        while ($data = mysqli_fetch_array($ambilsemuadatastok)) {

                                            $idk = $data['idpeminjaman'];
                                            $idb = $data['idbarang'];
                                            $tanggalp = $data['tanggalpinjam'];
                                            $namabarang = $data['namabarang'];
                                            $qty = $data['qty'];
                                            $penerima = $data['peminjam'];
                                            $status = $data['status_pinjam'];

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
                                                <td><?= $img; ?></td>
                                                <td><?= $namabarang; ?></td>
                                                <td><?= $qty; ?></td>
                                                <td><?= $penerima; ?></td>
                                                <td><?= $status; ?></td>

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
            <?php include "components/footer.php" ?>
        </div>
    </div>
    <!-- ================================================================ MAIN -->
</body>


<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Peminjaman </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <select name="barangnya" class="form-control">
                        <?php
                        $ambilsemuadatanya = mysqli_query($conn, "select * from stock");
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
                    <input type="number" name="qty" class="form-control" placeholder="Quantity" required>
                    <br>
                    <input type="text" name="penerima" class="form-control" placeholder="Penerima" required>
                    <br>

                    <?php
                    $tgl_pengajuan = date('Y-m-d');
                    ?>

                    <input type="hidden" name="tanggalpinjam" class="form-control" placeholder="tanggalpinjam" value="<?php echo $tgl_pengajuan; ?>">
                    <input type="hidden" name="status_pinjam" value="Baru">
                    <br>
                    <button type="submit" class="btn btn-primary" name="pinjam">Submit</button>
                </div>
            </form>


        </div>
    </div>
</div>

</html>