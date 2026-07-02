<?php

require_once __DIR__ . '/vendor/autoload.php';
include "koneksi.php";
$mpdf = new \Mpdf\Mpdf();

$tgl_a = $_POST['tgl_a'];
$tgl_b = $_POST['tgl_b'];

$html = '<!DOCTYPE html>
<html>
<head>
    <title>Barang Masuk Ketenagalistrikan</title>
    <link rel="stylesheet" href="css/print.css">
</head>
<body>
        <style type ="text/css">
    .besar {
        font-size: 24px;
    }
    .sedang {
        font-size: 16px;
    }
    .strip {
        font-size: 40px;
    }
</style>
    <table border="0" align="center" width="100%">
        <tr align="center">
                    <td width="1px">
                        <img width="100px" src="images/foto1.jpg">
                    </td>
                    <td align="center" style="margin-left:100">
                    <font align="center" size="6">PEMERINTAH PROVINSI KALIMANTAN SELATAN</font> <br>
                    <font align="center" size="6">DINAS PENDIDIKAN DAN KEBUDAYAAN</font> <br>
                    <font align="center" size="6">SMK NEGERI 2 PELAIHARI</font> <br>
                    <font align="center" size="3">Jl. Husni Thamrin Ds. Pemuda (KNPI) Pemuda,</font><br>
                    <font align="center" size="3">Kecamatan. Pelaihari, Kabupaten Tanah Laut, Kalimantan Selatan 70814</font><br>
                </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr size="3px" color="black">
                    </td>
                </tr>
            </table>
             <div style="text-align: center;">
        <font size="5"><b><u> Barang Masuk Ketenagalistrikan</u></b></font><br>
    </div>
    <br>
    <br>
        <table border="1" cellpadding="10" cellspacing="0">
         <thead>
                <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Kode Barang</th>
                <th>Asal Barang</th>
                <th>Penerima</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Gambar</th>
                </tr>
            </thead>
            <tbody>';

$sql = mysqli_query($koneksi, "Select * from masuk_lis 
                    INNER JOIN  stok_lis on  masuk_lis.idbarang_lis = stok_lis.idbarang_lis 
                    INNER JOIN pegawai on masuk_lis.id_pegawai = pegawai.id_pegawai where tanggal between '$tgl_a' and '$tgl_b'");
$i = 1;
while ($r = mysqli_fetch_array($sql)) {
    $html .=
        '<tr>
                        <td>' . $i++ . '</td>
                        <td>' . $r["tanggal"] . '</td>
                        <td>' . $r["namabarang"] . '</td>
                        <td>' . $r["kode_barang"] . '</td>
                        <td>' . $r["asal_barang"] . '</td>
                        <td>' . $r["nama_pegawai"] . '</td>
                        <td>' . $r["qty"] . '</td>
                       
                    <td><img src="images/' . $data["image"]  . '" width="100px" height="100px"/></td>// dewi
                        <td><img src="admin/images/' . $r["image"] . '" width="100px" height="100px"/></td>
                    </tr>';
}

$html .= '
</tbody>
</table>

<br><br><br>
<table border="0" width="100%">
    <tr>
        <td width="70%"></td>
        <td width="30%" align="left">
            <font size="3">Tapin, ' . date('d') . ' ' . array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember')[(int)date('m')] . ' ' . date('Y') . '</font><br>
            <font size="3">Mengetahui,</font><br>
            <font size="3">Kepala SMKN 1 Binuang</font>
            <br><br><br><br><br>
            <font size="3"><b>SATRIYA, M.Pd</b></font><br>
            <font size="3">NIP 19720923 199702 2 003</font>
        </td>
    </tr>
</table>

</body>
</html>';


$mpdf->WriteHTML($html);
$mpdf->Output('Data_Masuk_Listrik.pdf', 'I');
