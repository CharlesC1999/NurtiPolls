<?php 

if(!isset($_POST["name"])){
    echo "請循正常管道進入";
    exit;
}

$file=$_FILES["pic"];
var_dump($file);