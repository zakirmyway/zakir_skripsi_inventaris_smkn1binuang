<?php
$files = glob(__DIR__ . '/laporan_*.php');
$cetaks = glob(__DIR__ . '/cetak*.php');
$all_files = array_unique(array_merge($files, $cetaks));

foreach ($all_files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    
    if (strpos($content, 'SATRIYA, M.Pd') !== false) {
        echo "Skipped (Already updated): " . basename($file) . "<br>";
        continue;
    }
    
    $pattern = '/(<\/tbody>\s*<\/table>).*?<\/body>\s*<\/html>\';/is';
    
    $footer_html = <<<'HTML'
$1

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
HTML;

    if (preg_match($pattern, $content)) {
        $newContent = preg_replace($pattern, $footer_html, $content);
        file_put_contents($file, $newContent);
        echo "Updated: " . basename($file) . "<br>";
    } else {
        echo "Pattern NOT found: " . basename($file) . "<br>";
    }
}
?>
