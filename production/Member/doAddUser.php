<!-- WU 增加會員連線中的處理 後台-->
<?php
session_start();
require_once "../../db_connect.php";

if (!isset($_POST["name"])) {
    echo "請循正常管道";
    exit;
}

$name = $_POST["name"];
$account = $_POST["account"];
$password = $_POST["password"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$img = $_FILES["img"];
// $img = $_POST["img"];
$filename = "";
$password = md5($password);

// if (empty($account)) {
//     $_SESSION["error"]["message"] = "請輸入帳號";
//     header("location:add-user.php");
//     exit;
// }

// if (empty($password)) {
//     $_SESSION["error"]["message"] = "請輸入密碼";
//     header("location:add-user.php");
//     exit;
// }

if (empty($name) || empty($email) || empty($phone) || empty($account) || empty($password)) {
    // echo "請填入必要欄位";
    $_SESSION["error"]["message"] = "請填入必要欄位";
    header("location:add-user.php");
    exit();
}
// if ($_FILES['img']['error'] == 0) {
// $filename = $_FILES['img']['name'];

// if (move_uploaded_file($_FILES['img']['images'], './image_members/' . $filename)) {
//     echo "success";
// } else {
//     echo "fail";
//     // } else {
//     //     echo $_FILES['img']['error'];

//     // }
// }

if ($_FILES['img']['error'] == 0) {
    $filename = $_FILES['img']['name'];
    // echo $filename;

    if (move_uploaded_file($_FILES['img']['tmp_name'], './image_members/' . $filename)) {
        echo "success";
    } else {
        echo "fail";
        // } else {
        //     echo $_FILES['img']['error'];
        // }
    }
} else {
    echo $_FILES['img']['error'];
    // $filename = $img2;
}

$now = date('Y-m-d H:i:s');
$sql = "INSERT INTO member (User_name,Account,Password,Email,Phone,User_image,Create_date,valid) VALUES('$name','$account','$password','$email','$phone','$filename','$now',1)";

$checkAccount= "SELECT * FROM member WHERE Account = '$account'";
$result=$conn->query($checkAccount);
$accountExist=$result->num_rows;
if($accountExist!= 0){
    // die("帳號已存在");
    // header("location:add-user.php");
    header("Location: add-user.php?error=account_exists");
        exit;
}

// echo $sql;
// exit;

if ($conn->query($sql)) {
    echo "新增資料完成";
    // $last_id =$conn->insert_id;
    // echo" id為 $last_id";
} else {
    echo "新增資料錯誤" . $conn->error;
}
$conn->close();

header("location:member.php");
