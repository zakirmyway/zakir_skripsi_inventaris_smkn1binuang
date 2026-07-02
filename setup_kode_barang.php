<?php
$conn = mysqli_connect("localhost", "root", "", "stockbarang");
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());

$tables = ['masuk', 'keluar', 'kondisi', 'pemusnahan', 'peminjaman'];

foreach ($tables as $tbl) {
    $check = mysqli_query($conn, "SHOW COLUMNS FROM `$tbl` LIKE 'kode_barang'");
    if (mysqli_num_rows($check) == 0) {
        $result = mysqli_query($conn, "ALTER TABLE `$tbl` ADD COLUMN kode_barang VARCHAR(20) NOT NULL DEFAULT '' AFTER " . ($tbl == 'keluar' ? 'idbarang' : ($tbl == 'pemusnahan' ? 'idpemusnahan' : ($tbl == 'peminjaman' ? 'idbarang' : 'idbarang'))));
        echo $result
            ? "<p style='color:green'>&#10003; [$tbl] Kolom kode_barang berhasil ditambahkan.</p>"
            : "<p style='color:red'>&#10007; [$tbl] Gagal: " . mysqli_error($conn) . "</p>";
    } else {
        echo "<p style='color:blue'>&#9432; [$tbl] Kolom kode_barang sudah ada.</p>";
    }
}

echo "<hr><p><a href='masuk.php'>Kembali ke Barang Masuk</a></p>";
mysqli_close($conn);
?>
