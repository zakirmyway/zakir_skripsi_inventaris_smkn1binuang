<?php
$src = "C:\\Users\\Digitalisasi\\Downloads\\logo-smk-1-binuang-300x300.png";
$dst = "C:\\xampp\\htdocs\\stockbarang\\images\\foto1.png";

if(copy($src, $dst)) {
    echo "Successfully copied image to foto1.png\n";
} else {
    echo "Failed to copy image\n";
}

$dst2 = "C:\\xampp\\htdocs\\stockbarang\\image\\logo.png";
if (!file_exists("C:\\xampp\\htdocs\\stockbarang\\image")) {
    mkdir("C:\\xampp\\htdocs\\stockbarang\\image", 0777, true);
}
if(copy($src, $dst2)) {
    echo "Successfully copied image to image/logo.png\n";
} else {
    echo "Failed to copy image to image/logo.png\n";
}
?>
