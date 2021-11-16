<?php
if(isset($_GET['pageNum'])){
    $pageNum = $_GET['pageNum'];
    include 'ImageGallery.php';
    $gallery = new ImageGallery("img", false, $pageNum);
    return $gallery ->printTable();
}