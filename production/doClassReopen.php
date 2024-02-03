<?php
require_once("../db_connect.php");

if (!isset($_GET["reopenID"])) {
    die("請循正常管道進入此頁");
}

$reopenID = $_GET["reopenID"];


$sql = "UPDATE class SET valid = 1 WHERE Class_ID = '$reopenID'";
// echo $sql;

if ($conn->query($sql)) {
    echo "課程上架成功";
} else {
    echo "課程上架失敗" . $conn->error;
}

$conn->close();
header("location: class_new.php?Class_cate_ID=&status=1&min=0&max=99999");
