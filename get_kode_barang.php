<?php
// API endpoint untuk preview kode barang berikutnya (tanpa session)
$conn = mysqli_connect("localhost", "root", "", "stockbarang");

$tahun = date('Y');
$bulan = date('m');
$prefix = $tahun . $bulan;

// Ambil tabel dari query param
$tabel = isset($_GET['table']) ? $_GET['table'] : 'masuk';
$allowed_tables = ['masuk', 'keluar', 'kondisi', 'pemusnahan', 'peminjaman'];

if (!in_array($tabel, $allowed_tables)) {
    $tabel = 'masuk';
}

// Hitung jumlah data masuk di bulan ini untuk urutan
$cek_urutan = mysqli_query($conn, "SELECT COUNT(*) as total FROM `$tabel` WHERE kode_barang LIKE '$prefix%'");
if ($cek_urutan) {
    $data_urutan = mysqli_fetch_array($cek_urutan);
    $urutan = $data_urutan['total'] + 1;
} else {
    $urutan = 1;
}
$kode_barang = $prefix . str_pad($urutan, 4, '0', STR_PAD_LEFT);

header('Content-Type: text/plain');
echo $kode_barang;
mysqli_close($conn);
?>
