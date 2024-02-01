<?php
require_once "../db_connect.php";

if (!isset($_GET["classId"])) {
    $data = [
        "status" => 0,
        "message" => "請循正常管道進入此頁",
    ];
    echo json_encode($data);
    exit;
}

$classId = $_GET["classId"];

$sql = "SELECT * FROM class WHERE valid = 1 && Class_ID = '$classId'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    $data = [
        "status" => 0,
        "message" => "課程不存在",
    ];
} else {
    $data = [
        "status" => 1,
        "class" => $row,
    ];
}

echo json_encode($data);
$conn->close();
