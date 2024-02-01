<?php
require_once("../db_connectn.php");

$sql = "UPDATE recipe SET VALID = 1";
if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

$conn->close();
?>