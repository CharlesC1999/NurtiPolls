<?php
require_once("/xampp/htdocs/project/php_connect/db_connect.php");

// if (!isset($_GET["min"]) && !isset($_GET["max"])) {
//     die("Fail to access this website");
// };

$min = $_GET["min"];
$max = $_GET["max"];


$now = date("Y-m-d");

//分類
if (isset($_GET["Class_cate_ID"])) {
    $Class_cate_ID = $_GET["Class_cate_ID"];
    $whereClause = "WHERE Class_category_ID = '$Class_cate_ID'";
    if ($Class_cate_ID == "") {
        $whereClause = "";
    }
} else {
    $whereClause = "";
}
echo "分類：" . $whereClause;
echo "<br>";

//開課狀態
if (isset($_GET["status"])) {
    $status = $_GET["status"];

    switch ($status) {
        case "2":
            $whereClause = "$whereClause && Start_date > '$now'";
            break;
        case "3":
            $whereClause = "$whereClause && Start_date <= '$now' && End_date >= '$now'";
            break;
        case "4":
            $whereClause = "$whereClause && End_date <= '$now'";
            break;
        case "5":
            $whereClause = "$whereClause && Class_date = '$now'";
            break;
        case "6":
            $whereClause = "$whereClause && Class_date < '$now'";
            break;
    }
}

echo "開課狀態：" . $whereClause;
echo "<br>";


//價格篩選
if (isset($_GET["min"]) && isset($_GET["max"])) {
    $min = $_GET["min"];
    $max = $_GET["max"];

    if ($max == 0) {
        $max == 99999;
    } elseif ($min >= $max) {
        $max = $min;
    }

    $whereClause = "$whereClause && C_price BETWEEN '$min' AND '$max'";
}

echo "價格篩選：" . $whereClause;
echo "<br>";


//join class, speaker and category 
$sqlClass = "SELECT class.*, speaker.Speaker_name, class_categories.Class_cate_name
 FROM class 
 JOIN speaker ON class.F_Speaker_ID = speaker.Speaker_ID
 JOIN class_categories ON class.Class_category_ID = class_categories.Class_cate_ID
 $whereClause";

// $resultClass = $conn->query($sqlClass);
// $rowsClass = $resultClass->fetch_all(MYSQLI_ASSOC);
