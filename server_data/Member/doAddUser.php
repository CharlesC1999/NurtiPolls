<!-- 增加會員連線中的處理 後台-->
<?php
require_once("./connect.php");

if(!isset($_POST["name"])){
    echo "請循正常管道";
    exit;
}

$name=$_POST["name"];
$email=$_POST["email"];
$phone=$_POST["phone"];

if(empty($name) || empty($email) || empty($phone)){
    echo "請填入必要欄位";
    exit;
}

$now = date('Y-m-d H:i:s');
$sql="INSERT INTO member (User_name,Email,Phone,Create_date,valid) VALUES('$name','$email','$phone','$now',1)";

// echo $sql;
// exit;

if($conn->query($sql)){
    echo"新增資料完成";
    // $last_id =$conn->insert_id;
    // echo" id為 $last_id";
}else{
    echo "新增資料錯誤" . $conn->error;
}
$conn->close();

header("location:users.php");


