<!-- wu connect -->
<?php
$servename = "localhost";
$username = "admin";
$password = "12345";
$dbname = "project";

$conn = new mysqli($servename, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_errno) {
    die("連線失敗");
} else {
    // echo "連線成功";
}