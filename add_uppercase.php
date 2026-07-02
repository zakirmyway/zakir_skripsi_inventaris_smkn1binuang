<?php
$files = glob('*.php');

$count = 0;
foreach ($files as $file) {
    if (!is_file($file)) continue;
    $content = file_get_contents($file);
    
    // We want to add oninput to text inputs for namabarang, deskripsi, merek
    // if they don't already have it.
    
    $changed = false;
    
    // Patterns to match inputs that don't have oninput
    $patterns = [
        '/(<input[^>]*name="namabarang"[^>]*?)(>)/i',
        '/(<input[^>]*name="deskripsi"[^>]*?)(>)/i',
        '/(<input[^>]*name="merek"[^>]*?)(>)/i'
    ];
    
    foreach ($patterns as $pattern) {
        $content = preg_replace_callback($pattern, function($matches) use (&$changed) {
            // Check if it already has oninput
            if (stripos($matches[1], 'oninput') === false) {
                $changed = true;
                // add oninput before the closing bracket
                return $matches[1] . ' oninput="this.value = this.value.toUpperCase()"' . $matches[2];
            }
            return $matches[0];
        }, $content);
    }
    
    if ($changed) {
        file_put_contents($file, $content);
        echo "Updated inputs in $file<br>\n";
        $count++;
    }
}
echo "Total files updated: $count";
?>
