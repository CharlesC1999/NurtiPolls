<!-- 註冊後台 -->
<?php
require_once("./connect.php");

if (!isset($_POST["account"])) {
    echo ("請由正常管道進入");
}

$account = trim($_POST["account"]);
$password = trim($_POST["password"]);
$repassword = trim($_POST["repassword"]);

if(empty($account) || empty($password) || empty($repassword)){
    die("請輸入必填欄位");
}

if($password != $repassword){
    die("密碼輸入不一致");
}

$sql="SELECT * FROM  member WHERE Account='$account'";
$result=$conn->query($sql);
$accountExist=$result->num_rows;
// 檢查帳號每一行數是否存在
// echo $accountExist;

if($accountExist!=0){
    die("帳號已存在");
}

$now = date('Y-m-d H:i:s');
$password=md5($password);
//用now不用post
//md5 為密碼加密

$sql2 = "INSERT INTO member (Account,Password,Create_date,valid)VALUES ('$account', '$password', '$now',1)";
// echo $sql2;

if ($conn->query($sql2)) {
    echo "新增資料完成";
    // $last_id = $conn->insert_id; //用來抓最新一筆流水號的id
    // echo ",id 為$last_id";
} else {
    echo "修改資料表錯誤: " . $conn->error; 
}

$conn->close();
header("location:sign-in.php");