<?php
$idToBan = $_GET["idToBan"];
$forbiddenList = explode(",",file_get_contents("forbiddenIDs.txt", FILE_USE_INCLUDE_PATH));
array_push($forbiddenList, $idToBan);
$str = "";
foreach ($forbiddenList as $id){
    $str = $str.$id.",";
}


file_put_contents("forbiddenIDs.txt", $str);