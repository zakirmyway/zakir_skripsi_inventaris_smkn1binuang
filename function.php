<?php
session_start(); //untuk mengecek udh pernah login belum sih 

//membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "stockbarang");

//menambah barang baru
if (isset($_POST['addnewbarang'])) {
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $merek = $_POST['merek'];
    $thnpembelian = $_POST['thnpembelian'];
    $stock = $_POST['stock'];

    //soal gambar
    $allowed_extension = array('png', 'jpg');
    $nama = $_FILES['file']['name']; // ngambil nama file gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); //mengambil ekstensinya
    $ukuran = $_FILES['file']['size']; // mengambil size nya 
    $file_tmp = $_FILES['file']['tmp_name']; //mengambil lokasi filenya

    //penamaan file  ->> enkripsi biar gk kedouble 
    $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //menggabungkan nama file yg dienkripsi dgn ekstensinya


    //upload gambar 

    if (in_array($ekstensi, $allowed_extension) === true) {
        //validasi ukuran filenya
        if ($ukuran < 150000000) {
            move_uploaded_file($file_tmp, 'images/' . $image);
            $addtotable = mysqli_query($conn, "insert into stock (namabarang, deskripsi, merek, thnpembelian, stock, image) values('$namabarang','$deskripsi','$merek','$thnpembelian','$stock','$image')");
            if ($addtotable) {
                header('localtion:index.php');
            } else {
                echo 'gagal';
                header('localtion:index.php');
            }
        } else {
            //kalau filenya lebih dri 15mb
            echo '
        <script>
        alert("ukuran terlalu besar");
        window.location.href="index.php"
        </script>
        ';
        }
    } else {
        //kalau gambar tdk png/jpg
        echo '
        <script>
        alert("file harus png/jpg");
        window.location.href="index.php"
        </script>
        ';
    }
};

//menambah barang masuk
if (isset($_POST['barangmasuk'])) {
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $total_harga = isset($_POST['total_harga']) ? $_POST['total_harga'] : 0;
    $id_supplier = isset($_POST['suppleirnya']) ? $_POST['suppleirnya'] : null;
    $id_pegawai = isset($_POST['pegawainya']) ? $_POST['pegawainya'] : null;

    // Generate kode barang otomatis: YYYYMM + urutan 4 digit
    $tahun = date('Y');
    $bulan = date('m');
    $prefix = $tahun . $bulan;

    // Hitung jumlah data masuk di bulan ini untuk urutan
    $cek_urutan = mysqli_query($conn, "SELECT COUNT(*) as total FROM masuk WHERE kode_barang LIKE '$prefix%'");
    $data_urutan = mysqli_fetch_array($cek_urutan);
    $urutan = $data_urutan['total'] + 1;
    $kode_barang = $prefix . str_pad($urutan, 4, '0', STR_PAD_LEFT);

    $cekstoksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['stock'];
    $tambahkanstoksekarangdenganqty = $stoksekarang + $qty;

    $addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, kode_barang, keterangan, qty) values ('$barangnya','$kode_barang','$penerima','$qty')");
    $updatestokmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstoksekarangdenganqty' where idbarang='$barangnya'");
    if ($addtomasuk && $updatestokmasuk) {
        header('localtion:masuk.php');
    } else {
        echo 'gagal';
        header('localtion:masuk.php');
    }
}

//menambah barang keluar
if (isset($_POST['addbarangkeluar'])) {
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    // Generate kode barang otomatis untuk keluar
    $prefix_k = date('Ym');
    $cek_urut_k = mysqli_query($conn, "SELECT COUNT(*) as total FROM keluar WHERE kode_barang LIKE '$prefix_k%'");
    $dat_k = mysqli_fetch_array($cek_urut_k);
    $kode_barang_k = $prefix_k . str_pad($dat_k['total'] + 1, 4, '0', STR_PAD_LEFT);

    $cekstoksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);
    //menampilkan alert barang keluar sesui dengan stock nya 
    $stoksekarang = $ambildatanya['stock'];
    if ($stoksekarang >= $qty) {
        //kalau barangnya  cukup
        $tambahkanstoksekarangdenganqty = $stoksekarang - $qty;

        $addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, kode_barang, penerima, qty) values ('$barangnya','$kode_barang_k','$penerima','$qty')");
        $updatestokmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstoksekarangdenganqty' where idbarang='$barangnya'");
        if ($addtokeluar && $updatestokmasuk) {
            header('localtion:keluar.php');
        } else {
            echo 'gagal';
            header('localtion:keluar.php');
        }
    } else {
        //kalau barangnya gk cukup
        echo '
        <script>
        alert("stok saat ini tidak mencukupi");
        window.location.href="keluar.php"
        </script>
        ';
    }
}


//update info barang
if (isset($_POST['updatebarang'])) {
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $merek = $_POST['merek'];
    $thnpembelian = $_POST['thnpembelian'];
    //soal gambar
    $allowed_extension = array('png', 'jpg');
    $nama = $_FILES['file']['name']; // ngambil nama file gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); //mengambil ekstensinya
    $ukuran = $_FILES['file']['size']; // mengambil size nya 
    $file_tmp = $_FILES['file']['tmp_name']; //mengambil lokasi filenya

    //penamaan file  ->> enkripsi biar gk kedouble 
    $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //menggabungkan nama file yg dienkripsi dgn ekstensinya


    //validasi gambar
    if ($ukuran == 0) {
        //jika tidak inginupload
        $update = mysqli_query($conn, "update stock set namabarang='$namabarang', deskripsi='$deskripsi', merek='$merek', thnpembelian='$thnpembelian' where idbarang ='$idb'");
        if ($update) {
            header('localtion:index.php');
        } else {
            echo 'gagal';
            header('localtion:index.php');
        }
    } else {
        //jika ingin
        move_uploaded_file($file_tmp, 'images/' . $image);
        $update = mysqli_query($conn, "update stock set namabarang='$namabarang', deskripsi='$deskripsi', merek='$merek', thnpembelian='$thnpembelian', image='$image' where idbarang ='$idb'");
        if ($update) {
            header('localtion:index.php');
        } else {
            echo 'gagal';
            header('localtion:index.php');
        }
    }
}


//menghapus barang dari stok
if (isset($_POST['hapusbarang'])) {
    $idb = $_POST['idb']; // idbarang

    $gambar = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $get = mysqli_fetch_array($gambar);
    $img = 'images/' . $get['image'];
    unlink($img);

    $hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
    if ($hapus) {
        header('localtion:index.php');
    } else {
        echo 'gagal';
        header('localtion:index.php');
    }
};


//mengubah data barang masuk
if (isset($_POST['updatebarangmasuk'])) {
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $deskripsi = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $lihatstok = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stoknya = mysqli_fetch_array($lihatstok);
    $stokskrg = $stoknya['stock'];

    $qtyskrg = mysqli_query($conn, " select * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if ($qty > $qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $kurangin = $stokskrg - $selisih;
        $kurangistoknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");
        if ($kurangistoknya && $updatenya) {
            header('localtion:masuk.php');
        } else {
            echo 'gagal';
            header('localtion:masuk.php');
        }
    } else {
        $selisih = $qtyskrg - $qty;
        $kurangin = $stokskrg + $selisih;
        $kurangistoknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");
        if ($kurangistoknya && $updatenya) {
            header('localtion:masuk.php');
        } else {
            echo 'gagal';
            header('localtion:masuk.php');
        }
    }
}

//menghapus barang masuk
if (isset($_POST['hapusbarangmasuk'])) {
    $idb = $_POST['idb'];
    $qty = $_POST['qty'];
    $idm = $_POST['idm'];

    $getdatastok = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastok);
    $stok = $data['stock'];

    $selisih = $stok - $qty;

    $update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");

    if ($update && $hapusdata) {
        header('localtion:masuk.php');
    } else {
        header('localtion:masuk.php');
    }
}

//mengubah data barang keluar
if (isset($_POST['updatebarangkeluar'])) {
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty']; // qty baru inputan user
    //mengambil stock barang saat ini 
    $lihatstok = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stoknya = mysqli_fetch_array($lihatstok);
    $stokskrg = $stoknya['stock'];


    //qty barang keluar saat ini
    $qtyskrg = mysqli_query($conn, " select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if ($qty > $qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $kurangin = $stokskrg - $selisih;

        if ($selisih <= $stokskrg) {
            //stock cukup keluarin stock 
            $kurangistoknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
            $updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
            if ($kurangistoknya && $updatenya) {
                header('localtion:keluar.php');
            } else {
                echo 'gagal';
                header('localtion:keluar.php');
            }
        } else {
            // stock ga cukup 
            echo '
            <script>
            alert("stok tidak mencukupi");
            window.location.href="keluar.php"
            </script>
            ';
        }
    } else {
        $selisih = $qtyskrg - $qty;
        $kurangin = $stokskrg + $selisih;
        $kurangistoknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
        if ($kurangistoknya && $updatenya) {
            header('localtion:keluar.php');
        } else {
            echo 'gagal';
            header('localtion:keluar.php');
        }
    }
}

//menghapus barang keluar

if (isset($_POST['hapusbarangkeluar'])) {
    $idb = $_POST['idb'];
    $qty = $_POST['qty'];
    $idk = $_POST['idk'];

    $getdatastok = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastok);
    $stok = $data['stock'];

    $selisih = $stok - $qty;

    $update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");

    if ($update && $hapusdata) {
        header('localtion:keluar.php');
    } else {
        header('localtion:keluar.php');
    }
}

//menambah admin baru
if (isset($_POST['addadmin'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $queryinsert = mysqli_query($conn, "insert into login(email, password) values ('$email','$pass')");

    if ($queryinsert) {
        //if berhasil
        header('localtion:admin.php');
    } else {
        //if gagal
        header('localtion:admin.php');
    }
}

//meminjam barang 
if (isset($_POST['pinjam'])) {
    $idbarang = $_POST['barangnya']; //mengambil id barang
    $qty = $_POST['qty'];  //mengambil qty
    $penerima = $_POST['penerima']; //mengambil nama penerima
    $tanggalp = $_POST['tanggalpinjam'];  //mengambil tgl pinjam
    $tanggals = $_POST['tanggaldisetujui']; //mengambil tgl kembali
    $tanggalk = $_POST['tanggalkembali']; //mengambil tgl kembali
    $status_pinjam = $_POST['status_pinjam']; //mengambil status

    //ambil stok sekarang
    $stok_saat_ini = mysqli_query($conn, "select * from stock where idbarang='$idbarang'");
    $stok_nya = mysqli_fetch_array($stok_saat_ini);
    $stok = $stok_nya['stock']; //ini value nya 

    //kurangi stok nya
    $new_stock = $stok - $qty;

    // Generate kode barang otomatis untuk peminjaman
    $prefix_pinjam = date('Ym');
    $cek_urut_pinjam = mysqli_query($conn, "SELECT COUNT(*) as total FROM peminjaman WHERE kode_barang LIKE '$prefix_pinjam%'");
    $dat_pinjam = mysqli_fetch_array($cek_urut_pinjam);
    $kode_barang_pinjam = $prefix_pinjam . str_pad($dat_pinjam['total'] + 1, 4, '0', STR_PAD_LEFT);

    //mulai query insert
    $insertpinjam = mysqli_query($conn, "INSERT INTO peminjaman (idbarang,kode_barang,qty,peminjam,tanggalpinjam,tanggaldisetujui, tanggalkembali,status_pinjam) values('$idbarang','$kode_barang_pinjam','$qty','$penerima','$tanggalp','$tanggals','$tanggalk','$status_pinjam')");

    //mengurangi stock di tabel stock
    $kurangistok = mysqli_query($conn, "update stock set stock='$new_stock' where idbarang='$idbarang'");


    if ($insertpinjam && $kurangistok) {
        //jika berhasil
        echo '
        <script>
        alert("berhasil");
        window.location.href="index_siswa.php"
        </script>
        ';
    } else {
        //jika gagal
        echo '
        <script>
        alert("gagal");
        window.location.href="index_siswa.php"
        </script>
        ';
    }
}



// pengembalian 

if (isset($_POST['barangkembali'])) {
    $idk = $_POST['idk'];
    $idb = $_POST['idb'];
    $tanggalk = $_POST['tanggalkembali'];
    $tanggals = $_POST['tanggaldisetujui'];
    $qty = $_POST['qty'];
    $status_pinjam = $_POST['status_pinjam'];

    $update_barangkembali = mysqli_query($conn, "update peminjaman set tanggalkembali='$tanggalk', tanggaldisetujui='$tanggals', qty='$qty', status_pinjam='$status_pinjam'  where idpeminjaman ='$idk'");

    //ambil stok sekarang
    $stok_saat_ini = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stok_nya = mysqli_fetch_array($stok_saat_ini);
    $stok = $stok_nya['stock']; //ini value nya 

    //ambil qty dari idpinjam ini sekarang
    $stok_saat_ini1 = mysqli_query($conn, "select * from peminjaman where idpeminjaman='$idk'");
    $stok_nya1 = mysqli_fetch_array($stok_saat_ini1);
    $stok1 = $stok_nya1['qty']; //ini value nya 

    //kurangi stok nya
    $new_stock = $stok1 + $stok;

    //kembalikan stoknya
    $kembalikan_stock = mysqli_query($conn, "update stock set stock='$new_stock' where idbarang='$idb'");

    if ($update_barangkembali && $kembalikan_stock) {
        //jika berhasil
        echo '
        <script>
        alert("berhasil");
        window.location.href="peminjaman.php"
        </script>
        ';
    } else {
        //jika gagal
        echo '
        <script>
        alert("gagal");
        window.location.href="peminjaman.php"
        </script>
        ';
    }
}

//menghapus peminjaman
if (isset($_POST['hapuspeminjaman'])) {
    $idb = $_POST['idb'];
    $qty = $_POST['qty'];
    $idk = $_POST['idk'];

    $get_datas_tok = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($get_datas_tok);
    $stok = $data['stock'];

    $selisih_peminjaman = $stok - $qty;

    $update_hapus = mysqli_query($conn, "update stock set stock='$selisih_peminjaman' where idbarang='$idb'");
    $hapusdata_peminjaman = mysqli_query($conn, "delete from peminjaman where idpeminjaman='$idk'");

    if ($update_hapus && $hapusdata_peminjaman) {
        //jika berhasil
        echo '
       <script>
       alert("berhasil");
       window.location.href="peminjaman.php"
       </script>
       ';
    } else {
        //jika berhasil
        echo '
        <script>
        alert("gagal");
        window.location.href="peminjaman.php"
        </script>
        ';
    }
}



//data pegawai

//menambah pegawai
if (isset($_POST['addnewpegawai'])) {
    $namapegawai = $_POST['namapegawai'];
    $nip = $_POST['nip'];
    $jabatan = $_POST['jabatan'];
    $pendidikan = $_POST['pendidikan'];
    $ttl = $_POST['ttl'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];

    //soal gambar
    $allowed_extension = array('png', 'jpg');
    $nama = $_FILES['file']['name']; // ngambil nama file gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); //mengambil ekstensinya
    $ukuran = $_FILES['file']['size']; // mengambil size nya 
    $file_tmp = $_FILES['file']['tmp_name']; //mengambil lokasi filenya

    //penamaan file  ->> enkripsi biar gk kedouble 
    $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //menggabungkan nama file yg dienkripsi dgn ekstensinya


    //upload gambar 

    if (in_array($ekstensi, $allowed_extension) === true) {
        //validasi ukuran filenya
        if ($ukuran < 150000000) {
            move_uploaded_file($file_tmp, 'images/' . $image);
            $addtotable = mysqli_query($conn, "insert into pegawai (namapegawai, nip, jabatan, pendidikan, ttl, tgl_lahir, alamat, image) values('$namapegawai','$nip','$jabatan','$pendidikan','$ttl','$tgl_lahir','$alamat','$image')");
            if ($addtotable) {
                header('localtion:pegawai.php');
            } else {
                echo 'gagal';
                header('localtion:pegawai.php');
            }
        } else {
            //kalau filenya lebih dri 15mb
            echo '
        <script>
        alert("ukuran terlalu besar");
        window.location.href="pegawai.php"
        </script>
        ';
        }
    } else {
        //kalau gambar tdk png/jpg
        echo '
        <script>
        alert("file harus png/jpg");
        window.location.href="pegawai.php"
        </script>
        ';
    }
};

//update pegawai
if (isset($_POST['updatepegawai'])) {
    $idg = $_POST['idg'];
    $namapegawai = $_POST['namapegawai'];
    $nip = $_POST['nip'];
    $jabatan = $_POST['jabatan'];
    $pendidikan = $_POST['pendidikan'];
    $ttl = $_POST['ttl'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    //soal gambar
    $allowed_extension = array('png', 'jpg');
    $nama = $_FILES['file']['name']; // ngambil nama file gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); //mengambil ekstensinya
    $ukuran = $_FILES['file']['size']; // mengambil size nya 
    $file_tmp = $_FILES['file']['tmp_name']; //mengambil lokasi filenya

    //penamaan file  ->> enkripsi biar gk kedouble 
    $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //menggabungkan nama file yg dienkripsi dgn ekstensinya


    //validasi gambar
    if ($ukuran == 0) {
        //jika tidak inginupload
        $update = mysqli_query($conn, "update pegawai set namapegawai='$namapegawai', nip='$nip', jabatan='$jabatan', pendidikan='$pendidikan', 
        ttl='$ttl', tgl_lahir='$tgl_lahir', alamat='$alamat' where idpegawai ='$idg'");
        if ($update) {
            header('localtion:pegawai.php');
        } else {
            echo 'gagal';
            header('localtion:pegawai.php');
        }
    } else {
        //jika ingin
        move_uploaded_file($file_tmp, 'images/' . $image);
        $update = mysqli_query($conn, "update pegawai set namapegawai='$namapegawai', nip='$nip', jabatan='$jabatan', pendidikan='$pendidikan', 
        ttl='$ttl', tgl_lahir='$tgl_lahir', alamat='$alamat', image='$image' where idpegawai ='$idg'");
        if ($update) {
            header('localtion:pegawai.php');
        } else {
            echo 'gagal';
            header('localtion:pegawai.php');
        }
    }
}



//menghapus data pegawai
if (isset($_POST['hapuspegawai'])) {
    $idg = $_POST['idg']; // idpegawai

    $gambar = mysqli_query($conn, "select * from pegawai where idpegawai='$idg'");
    $get = mysqli_fetch_array($gambar);
    $img = 'images/' . $get['image'];
    unlink($img);

    $hapus = mysqli_query($conn, "delete from pegawai where idpegawai='$idg'");
    if ($hapus) {
        header('localtion:pegawai.php');
    } else {
        echo 'gagal';
        header('localtion:pegawai.php');
    }
};


//kondisi barang
if (isset($_POST['addkondisi'])) {
    $idbarang = $_POST['barangnya']; //mengambil id barang
    $qty = $_POST['qty'];  //mengambil qty
    $kondisi = $_POST['kondisi']; //mengambil kondisi

    // Generate kode barang otomatis untuk kondisi
    $prefix_kon = date('Ym');
    $cek_urut_kon = mysqli_query($conn, "SELECT COUNT(*) as total FROM kondisi WHERE kode_barang LIKE '$prefix_kon%'");
    $dat_kon = mysqli_fetch_array($cek_urut_kon);
    $kode_barang_kon = $prefix_kon . str_pad($dat_kon['total'] + 1, 4, '0', STR_PAD_LEFT);

    //ambil stok sekarang
    $stok_saat_ini = mysqli_query($conn, "select * from stock where idbarang='$idbarang'");
    $stok_nya = mysqli_fetch_array($stok_saat_ini);
    $stok = $stok_nya['stock']; //ini value nya 

    //kurangi stok nya
    $new_stock = $stok - $qty;

    //mulai query insert
    $insertkondisi = mysqli_query($conn, "INSERT INTO kondisi (idbarang,kode_barang,qty,kondisi) values('$idbarang','$kode_barang_kon','$qty','$kondisi')");

    //mengurangi stock di tabel stock
    $kurangistok = mysqli_query($conn, "update stock set stock='$new_stock' where idbarang='$idbarang'");


    if ($insertkondisi && $kurangistok) {
        //jika berhasil
        echo '
        <script>
        alert("berhasil");
        window.location.href="kondisi.php"
        </script>
        ';
    } else {
        //jika gagal
        echo '
        <script>
        alert("gagal");
        window.location.href="kondisi.php"
        </script>
        ';
    }
}


//menyelasikan kondisi
if (isset($_POST['updatekondisi'])) {
    $idkon = $_POST['idkon'];
    $idb = $_POST['idb'];
    $qty = $_POST['qty'];
    $kondisi = $_POST['kondisi'];

    $lihatstok1 = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stoknya1 = mysqli_fetch_array($lihatstok1);
    $stokskrg1 = $stoknya1['stock'];

    //qty barang keluar saat ini
    $qtyskrg1 = mysqli_query($conn, " select * from kondisi where idkondisi='$idkon'");
    $qtynya1 = mysqli_fetch_array($qtyskrg1);
    $qtyskrg1 = $qtynya1['qty'];

    if ($qty > $qtyskrg1) {
        $selisih1 = $qty - $qtyskrg1;
        $kurangin1 = $stokskrg1 - $selisih1;


        if ($selisih1 <= $stokskrg1) {
            //stock cukup keluarin stock 
            $kurangistoknya1 = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
            $updatenya1 = mysqli_query($conn, "update kondisi set  qty='$qty', kondisi='$kondisi' where idkondisi='$idkon'");
            if ($kurangistoknya1 && $updatenya1) {
                header('localtion:kondisi.php');
            } else {
                echo 'gagal';
                header('localtion:kondisi.php');
            }
        } else {
            // stock ga cukup 
            echo '
            <script>
            alert("stok tidak mencukupi");
            window.location.href="kondisi.php"
            </script>
            ';
        }
    } else {
        $selisih1 = $qtyskrg1 - $qty;
        $kurangin1 = $stokskrg1 + $selisih1;

        $kurangistoknya1 = mysqli_query($conn, "update stock set stock='$kurangin1' where idbarang='$idb'");
        $updatenya1 = mysqli_query($conn, "update kondisi set qty='$qty', kondisi='$kondisi' where idkondisi='$idkon'");
    }
    if ($kurangistoknya1 && $updatenya1) {
        header('localtion:kondisi.php');
    } else {
        echo 'gagal';
        header('localtion:kondisi.php');
    }
}

//menghapus barang kondisi

if (isset($_POST['hapuskondisi'])) {
    $idb = $_POST['idb'];
    $qty = $_POST['qty'];
    $idkon = $_POST['idkon'];

    $getdatastok1 = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data1 = mysqli_fetch_array($getdatastok1);
    $stok1 = $data1['stock'];

    $selisih1 = $stok1 - $qty;

    $update1 = mysqli_query($conn, "update stock set stock='$selisih1' where idbarang='$idb'");
    $hapusdata1 = mysqli_query($conn, "delete from kondisi where idkondisi='$idkon'");

    if ($update1 && $hapusdata1) {
        header('localtion:kondisi.php');
    } else {
        header('localtion:kondisi.php');
    }
}

//menambah barang baru  RAB
if (isset($_POST['addnewrab'])) {
    $tglbelanja = $_POST['tglbelanja'];
    $namabarang = $_POST['namabarang'];
    $merek = $_POST['merek'];
    $qty = $_POST['qty'];
    $jumlah = $_POST['jumlah'];
    $deskripsi = $_POST['deskripsi'];



    ///soal gambar
    $allowed_extension = array('png', 'jpg');
    $nama = $_FILES['file']['name']; // ngambil nama file gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); //mengambil ekstensinya
    $ukuran = $_FILES['file']['size']; // mengambil size nya 
    $file_tmp = $_FILES['file']['tmp_name']; //mengambil lokasi filenya

    //penamaan file  ->> enkripsi biar gk kedouble 
    $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //menggabungkan nama file yg dienkripsi dgn ekstensinya


    //upload gambar 

    if (in_array($ekstensi, $allowed_extension) === true) {
        //validasi ukuran filenya
        if ($ukuran < 150000000) {
            move_uploaded_file($file_tmp, 'images/' . $image);
            $addtotable = mysqli_query($conn, "insert into rab1 (tglbelanja,namabarang, merek, qty,jumlah,deskripsi, image) values('$tglbelanja','$namabarang','$merek','$qty','$jumlah','$deskripsi','$image')");
            if ($addtotable) {
                header('localtion:rab.php');
            } else {
                echo 'gagal';
                header('localtion:rab.php');
            }
        } else {
            //kalau filenya lebih dri 15mb
            echo '
        <script>
        alert("ukuran terlalu besar");
        window.location.href="rab.php"
        </script>
        ';
        }
    } else {
        //kalau gambar tdk png/jpg
        echo '
        <script>
        alert("file harus png/jpg");
        window.location.href="rab.php"
        </script>
        ';
    }
};

//update barang RAB
if (isset($_POST['updatebarangrab'])) {
    $idrab = $_POST['idrab'];
    $namabarang = $_POST['namabarang'];
    $merek = $_POST['merek'];
    $qty = $_POST['qty'];
    $hargasatuan = $_POST['hargasatuan'];
    $jumlah = $_POST['jumlah'];
    $deskripsi = $_POST['deskripsi'];

    //soal gambar
    $allowed_extension = array('png', 'jpg');
    $nama = $_FILES['file']['name']; // ngambil nama file gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); //mengambil ekstensinya
    $ukuran = $_FILES['file']['size']; // mengambil size nya 
    $file_tmp = $_FILES['file']['tmp_name']; //mengambil lokasi filenya

    //penamaan file  ->> enkripsi biar gk kedouble 
    $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //menggabungkan nama file yg dienkripsi dgn ekstensinya


    //validasi gambar
    if ($ukuran == 0) {
        //jika tidak inginupload
        $update = mysqli_query($conn, "update rab1 set namabarang='$namabarang', merek='$merek', qty='$qty', hargasatuan='$hargasatuan', jumlah='$jumlah', deskripsi='$deskripsi' where idrab ='$idrab'");
        if ($update) {
            header('localtion:rab.php');
        } else {
            echo 'gagal';
            header('localtion:rab.php');
        }
    } else {
        //jika ingin
        move_uploaded_file($file_tmp, 'images/' . $image);
        $update = mysqli_query($conn, "update rab1 set namabarang='$namabarang', merek='$merek', qty='$qty', hargasatuan='$hargasatuan', jumlah='$jumlah', deskripsi='$deskripsi', image='$image' where idrab ='$idrab'");
        if ($update) {
            header('localtion:rab.php');
        } else {
            echo 'gagal';
            header('localtion:rab.php');
        }
    }
}

//menghapus barang dari RAB
if (isset($_POST['hapusbarangrab'])) {
    $idrab = $_POST['idrab']; // idbarang

    $gambar = mysqli_query($conn, "select * from rab1 where idrab='$idrab'");
    $get = mysqli_fetch_array($gambar);
    $img = 'images/' . $get['image'];
    unlink($img);

    $hapus = mysqli_query($conn, "delete from rab1 where idrab='$idrab'");
    if ($hapus) {
        header('localtion:rab.php');
    } else {
        echo 'gagal';
        header('localtion:rab.php');
    }
};

//pengajuan barang

if (isset($_POST['addpengajuan'])) {
    $namabarang = $_POST['namabarang'];
    $qty = $_POST['qty'];  //mengambil qty
    $merek = $_POST['merek']; //mengambil nama penerima
    $tanggal = $_POST['tanggal'];  //mengambil tgl pinjam



    //mulai query insert
    $insertpengajuan = mysqli_query($conn, "INSERT INTO pengajuan (namabarang,qty,merek,tanggal) values('$namabarang','$qty','$merek','$tanggal')");




    if ($insertpengajuan) {
        header('localtion:usulan_barang.php');
    } else {
        echo 'gagal';
        header('localtion:usulan_barang.php');
    }
}

if (isset($_POST['setujuu'])) {
    $idp = $_POST['idp'];
    $idb = $_POST['idb'];

    $updatesetuju = mysqli_query($conn, "UPDATE pengajuan set status='setuju'  where idpengajuan ='$idp'");


    if ($updatesetuju) {
        //jika berhasil
        echo '
        <script>
        alert("berhasil");
        window.location.href="usulan_barang.php"
        </script>
        ';
    } else {
        //jika gagal
        echo '
        <script>
        alert("gagal");
        window.location.href="usulan_barang.php"
        </script>
        ';
    }
}

if (isset($_POST['tidaksetuju'])) {
    $idp = $_POST['idp'];
    $idb = $_POST['idb'];

    $updatesetuju = mysqli_query($conn, "UPDATE pengajuan set status='tidaksetuju'  where idpengajuan ='$idp'");


    if ($updatesetuju) {
        //jika berhasil
        echo '
        <script>
        alert("berhasil");
        window.location.href="usulan_barang.php"
        </script>
        ';
    } else {
        //jika gagal
        echo '
        <script>
        alert("gagal");
        window.location.href="usulan_barang.php"
        </script>
        ';
    }
}
//menghapus pengajuan
if (isset($_POST['hapuspengajuan'])) {
    $idp = $_POST['idp'];
    $idb = $_POST['idb'];

    $hapusdata_pengajuan = mysqli_query($conn, "DELETE from pengajuan where idpengajuan='$idp'");
}


//addpemusnahan
if (isset($_POST['addpemusnahan'])) {
    $tanggal = $_POST['tanggal'];
    $qty = $_POST['qty'];
    $idbarang = $_POST['barangnya'];
    $keterangan = $_POST['keterangan'];

    // Generate kode barang otomatis untuk pemusnahan
    $prefix_pem = date('Ym');
    $cek_urut_pem = mysqli_query($conn, "SELECT COUNT(*) as total FROM pemusnahan WHERE kode_barang LIKE '$prefix_pem%'");
    $dat_pem = mysqli_fetch_array($cek_urut_pem);
    $kode_barang_pem = $prefix_pem . str_pad($dat_pem['total'] + 1, 4, '0', STR_PAD_LEFT);

    //mulai query insert
    $insertpemusnahan = mysqli_query($conn, "INSERT INTO pemusnahan (tanggal,qty,idbarang,kode_barang,keterangan) values('$tanggal','$qty','$idbarang','$kode_barang_pem','$keterangan')");



    if ($insertpemusnahan) {
        header('localtion:berita_acara.php');
    } else {
        echo 'gagal';
        header('localtion:berita_acara.php');
    }
}

//update pemusnahan barang
if (isset($_POST['updatepemusnahan'])) {
    $idpem = $_POST['idpem'];
    $idbarang = $_POST['barangnya'];
    $qty = $_POST['qty'];
    $keterangan = $_POST['keterangan'];

    $updatepemusnahan = mysqli_query($conn, "update pemusnahan set idbarang='$idbarang', keterangan='$keterangan', qty='$qty' where idpemusnahan ='$idpem'");

    if ($updatepemusnahan) {
        header('localtion:berita_acara.php');
    } else {
        echo 'gagal';
        header('localtion:berita_acara.php');
    }
}

// menghapus pemusnahan
if (isset($_POST['hapuspemusnahan'])) {
    $idb = $_POST['idb'];
    $idpem = $_POST['idpem'];

    $hapuspemusnahan = mysqli_query($conn, "delete from pemusnahan where idpemusnahan='$idpem'");

    if ($hapuspemusnahan) {
        header('localtion:berita_acara.php');
    } else {
        header('localtion:berita_acara.php');
    }
}
