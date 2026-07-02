<?php
$files = glob('*.php');
$replacements = [
    'Stok Barang di Gudang' => 'fas fa-boxes',
    'Barang Masuk' => 'fas fa-download',
    'Barang Keluar' => 'fas fa-upload',
    'Peminjaman Barang' => 'fas fa-exchange-alt',
    'Kondisi Barang' => 'fas fa-tools',
    'Data Pegawai' => 'fas fa-users',
    'Rencana Anggaran Belanja' => 'fas fa-file-invoice-dollar',
    'Usulan Barang' => 'fas fa-envelope-open-text',
    'Pemusnahan Barang' => 'fas fa-trash-alt',
    'Logout' => 'fas fa-sign-out-alt'
];

$count = 0;
foreach ($files as $file) {
    if (!is_file($file)) continue;
    $content = file_get_contents($file);
    
    // Quick check if file has sidebar
    if (strpos($content, 'sb-sidenav-menu') === false) continue;

    $changed = false;
    
    // For each target menu item, we find its anchor block and replace the icon
    foreach ($replacements as $text => $icon) {
        // Regex to find:
        // <a class="nav-link" href="...">
        //     <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        //     Text
        // </a>
        // Note: the icon might already be changed, so we match `<i class="..."></i>`
        $pattern = '/(<a\s+class="nav-link".*?>\s*<div\s+class="sb-nav-link-icon">\s*<i\s+class=")([^"]+)("><\/i>\s*<\/div>\s*' . preg_quote($text, '/') . '\s*<\/a>)/is';
        
        $content = preg_replace_callback($pattern, function($matches) use ($icon, &$changed) {
            if ($matches[2] !== $icon) {
                $changed = true;
                return $matches[1] . $icon . $matches[3];
            }
            return $matches[0];
        }, $content);
    }
    
    if ($changed) {
        file_put_contents($file, $content);
        echo "Updated icons in $file<br>\n";
        $count++;
    }
}
echo "Total files updated: $count";
?>
