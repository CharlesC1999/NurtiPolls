<?php
//連結資料庫 ppt.283
$servername = "localhost";
$username = "admin";
$password = "12345";
$dbname = "mfee";
    
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// 檢查連線
if ($conn->connect_error) {
  	die("連線失敗: " . $conn->connect_error);
}else{
    // echo"連線成功";
}
