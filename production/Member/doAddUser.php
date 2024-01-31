<!-- WU 增加會員連線中的處理 後台-->
<?php
require_once "./connect.php";

if (!isset($_POST["name"])) {
    echo "請循正常管道";
    exit;
}

$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$img = $_POST["img"];

if (empty($name) || empty($email) || empty($phone)) {
    echo "請填入必要欄位";
    header("add-user.php");
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

$now = date('Y-m-d H:i:s');
$sql = "INSERT INTO member (User_name,Email,Phone,Create_date,valid,User_image) VALUES('$name','$email','$phone','$now',1,$img)";

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

header("location:member3.php");
