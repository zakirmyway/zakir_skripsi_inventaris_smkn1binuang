<?php
$files = glob('*.php');

foreach ($files as $file) {
    if (!is_file($file)) continue;
    $content = file_get_contents($file);
    
    // Fix the broken PHP tags caused by the previous script
    $pattern = '/\?\s*oninput="this\.value\s*=\s*this\.value\.toUpperCase\(\)"\s*>/i';
    
    $newContent = preg_replace($pattern, '?>"', $content);
    
    // Now correctly add the oninput attribute before the closing > of the input tag, 
    // ensuring we don't break PHP tags
    // Let's just use a simpler replacement for the inputs that need it, 
    // by finding class="form-control" required and appending it there, 
    // or by doing a more careful regex.
    // Actually, since I already broke it, fixing the broken tags is the first step.
    
    if ($newContent !== $content) {
        // Wait, if I replace `? oninput="...">` with `?>"` it fixes the PHP tag.
        // But then the input is missing the oninput attribute entirely.
        // We want to add oninput at the end of the tag.
        // Let's replace `\?\s*oninput="this.value = this.value.toUpperCase()">"`
        // with `?>" oninput="this.value = this.value.toUpperCase()">`
        
        $pattern2 = '/\?\s*oninput="this\.value\s*=\s*this\.value\.toUpperCase\(\)">"/i';
        $replacement2 = '?>" oninput="this.value = this.value.toUpperCase()">';
        $newContent2 = preg_replace($pattern2, $replacement2, $content);
        
        file_put_contents($file, $newContent2);
        echo "Fixed syntax error in $file<br>\n";
    }
}
?>
