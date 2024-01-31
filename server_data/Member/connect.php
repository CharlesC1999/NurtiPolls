<!-- wu connect -->
<?php
$servename = "localhost";
$username = "vvvv4577";
$password = "jk451244zxc";
$dbname = "nutripolls";

$conn = new mysqli($servename, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_errno) {
    die("連線失敗");
} else {
    // echo "連線成功";
}