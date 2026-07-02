<?php
$files = glob('*.php');
$files[] = 'components/siswa/navbar.php';

$count = 0;
foreach ($files as $file) {
    if (!is_file($file)) continue;
    $content = file_get_contents($file);
    
    // Pattern to match the previously inserted navbar brand
    $pattern = '/<a\s+class="navbar-brand"\s+href="([^"]*)">\s*<img\s+src="(.*?)"\s+width="35"\s+style="margin-right:\s*10px;">\s*BMD-SMKN 1 BINUANG\s*<\/a>/is';
    
    // Add inline style to force width and smaller font size, bypassing CSS cache
    $replacement = '<a class="navbar-brand" href="$1" style="width: max-content; font-size: 15px; padding-right: 1.5rem;"><img src="$2" width="35" style="margin-right: 10px;">BMD-SMKN 1 BINUANG</a>';
    
    $newContent = preg_replace($pattern, $replacement, $content);
    if ($newContent !== $content) {
        file_put_contents($file, $newContent);
        echo "Fixed navbar in $file<br>\n";
        $count++;
    }
}
echo "Total files updated: $count";
?>
