<?php

require_once "../db_connect.php";

$id = $_GET["id"];

$sql = "UPDATE speaker SET valid='0' WHERE Speaker_ID=$id";

if ($conn->query($sql) === true) {
    echo "刪除成功";
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

$conn->close();

header("location: speaker.php");
