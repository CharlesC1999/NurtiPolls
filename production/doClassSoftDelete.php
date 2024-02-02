<?php
require_once("../db_connect_class.php");

if (!isset($_GET["Class_ID"])) {
    die("請循正常管道進入此頁");
}

$Class_ID = $_GET["Class_ID"];


$sql = "UPDATE class SET valid = 0 WHERE Class_ID = '$Class_ID'";
// echo $sql;

if ($conn->query($sql)) {
    echo "課程刪除成功";
} else {
    echo "課程刪除失敗" . $conn->error;
}

$conn->close();
header("location: class_new.php?Class_cate_ID=&status=1&min=0&max=99999");
