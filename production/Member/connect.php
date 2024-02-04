<!-- wu connect 連線 -->
<?php
$servename = "localhost";
$username = "admin";
$password = "12345";
$dbname = "nutripolls";

$conn = new mysqli($servename, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_errno) {
    die("連線失敗");
} else {
    // echo "連線成功";
}