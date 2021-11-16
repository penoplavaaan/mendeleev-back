<?php
if(isset($_GET['name'])){
    $filename = $_GET['name'];
    if (is_file($filename)){
        unlink($filename);
        include 'ImageGallery.php';
        $gallery = new ImageGallery("img");
        return $gallery ->printTable();
    }
}