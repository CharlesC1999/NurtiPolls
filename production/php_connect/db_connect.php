<?php
$servername = "localhost";
$username = "admin";
$password = "111111";
$dbname = "nutripolls_version_1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// 檢查連線
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
} else {
    // echo "連線成功";
}

