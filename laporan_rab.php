<?php

require_once __DIR__ . '/vendor/autoload.php';
require 'function.php';
require 'cek.php';


$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html>
<head>
    <title>Laporan Rencana Anggaran Belanja</title>
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
                        <font align="center" size="6">SMK NEGERI 1 BINUANG</font> <br>
                        <font align="center" size="3">Jl. Oscar Rt. 05 Rw. 02 Desa Pualam Sari Kecamatan Binuang Kabupaten Tapin 71183</font><br>
                    </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr size="3px" color="black">
                        </td>
                    </tr>
                </table>
                <div style="text-align: center;">
            <font size="5"><b><u> Laporan Rencana Anggaran Belanja</u></b></font><br>
        </div>
        <br>
        <br>
            <table border="1" cellpadding="10" width="100%" cellspacing="0">
             <thead>
                    <tr>
                    <th>No</th>
                    <th>Tanggal </th>
                    <th>Nama Barang</th>
                    <th>Merek</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>';

$ambilsemuadatastok = mysqli_query($conn, "select * from rab1");
$i = 1;
while ($data = mysqli_fetch_array($ambilsemuadatastok)) {

    $html .=
        '<tr>
                    <td>' . $i++ . '</td>
                    <td>' . $data["tglbelanja"] . '</td>
                    <td>' . $data["namabarang"] . '</td>
                    <td>' . $data["merek"] . '</td>
                    <td>' . $data["qty"] . '</td>
                    <td>' . $data["jumlah"] . '</td>
                    <td>' . $data["deskripsi"] . '</td>
                  
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
$mpdf->Output('Laporan-data-pegawi.pdf', 'I');
