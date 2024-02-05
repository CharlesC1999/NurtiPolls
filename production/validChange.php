<?php
require_once "../db_connect.php";

$sql = "UPDATE recipe SET VALID = 1";
if ($conn->query($sql) === true) {
    echo "更新成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

$conn->close();
