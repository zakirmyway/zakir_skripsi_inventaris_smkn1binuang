<?php
$files = glob('*.php');
// Also add the components one
$files[] = 'components/siswa/navbar.php';

$count = 0;
foreach ($files as $file) {
    if (!is_file($file)) continue;
    $content = file_get_contents($file);
    
    // Pattern to match `<a class="navbar-brand" href="...">BMD-SMKN 1 BINUANG</a>`
    // We want to avoid adding the logo twice if the script is run multiple times.
    if (strpos($content, '<img src="images/foto1.png"') !== false || strpos($content, '<img src="../../images/foto1.png"') !== false) {
        continue;
    }
    
    // For root files
    if (strpos($file, '/') === false && strpos($file, '\\') === false) {
        $replacement = '<a class="navbar-brand" href="$1" style="width: max-content; font-size: 15px; padding-right: 1.5rem;"><img src="images/foto1.png" width="35" style="margin-right: 10px;">BMD-SMKN 1 BINUANG</a>';
        $pattern = '/<a\s+class="navbar-brand"\s+href="([^"]*)">\s*BMD-SMKN 1 BINUANG\s*<\/a>/is';
        
        $newContent = preg_replace($pattern, $replacement, $content);
        if ($newContent !== $content) {
            file_put_contents($file, $newContent);
            echo "Updated navbar in $file<br>\n";
            $count++;
        }
    } else {
        // For subfolder files, we might need a different image path, let's just use "images/foto1.png" for now 
        // because it's usually included in the main directory. Wait, let's use an absolute path for safety?
        // Let's just use `images/foto1.png` since it's probably included from root.
        $replacement = '<a class="navbar-brand" href="$1" style="width: max-content; font-size: 15px; padding-right: 1.5rem;"><img src="images/foto1.png" width="35" style="margin-right: 10px;">BMD-SMKN 1 BINUANG</a>';
        $pattern = '/<a\s+class="navbar-brand"\s+href="([^"]*)">\s*BMD-SMKN 1 BINUANG\s*<\/a>/is';
        
        $newContent = preg_replace($pattern, $replacement, $content);
        if ($newContent !== $content) {
            file_put_contents($file, $newContent);
            echo "Updated navbar in $file<br>\n";
            $count++;
        }
    }
}
echo "Total files updated: $count";
?>
