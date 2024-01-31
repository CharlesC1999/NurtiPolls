<?php
require_once("../db_connect_class.php");

if (!isset($_POST["classID"])) {
    die("請循正常管道進入此頁");
}

$classID = $_POST["classID"];
$className = $_POST["className"];
$classCategory = $_POST["classCategory"];
$speaker = $_POST["speaker"];
$classPrice = $_POST["classPrice"];
$personLimit = $_POST["personLimit"];
$startDate = $_POST["startDate"];
$endDate = $_POST["endDate"];
$classDate = $_POST["classDate"];
$classDescription = $_POST["classDescription"];

$sql = "UPDATE class SET Class_name='$className', Class_category_ID='$classCategory', F_Speaker_ID='$speaker', C_price='$classPrice', Class_person_limit='$personLimit', Start_date='$startDate', End_date='$endDate', Class_date='$classDate', Class_description='$classDescription' WHERE Class_ID='$classID'";

// echo $sql;

if ($conn->query($sql)) {
    echo "資料更新成功!";
} else {
    echo "資料更新錯誤" . $conn->error;
};

header("location: classDetail.php?Class_ID=$classID");

$conn->close();
