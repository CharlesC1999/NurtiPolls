<!-- wu儲存資料 後台 -->
<?php
require_once "./connect.php";

if (!isset($_POST["name"])) {
    echo "請循正常管道";
    exit;
}

$name = $_POST["name"];
$gender = $_POST["gender"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$birth = $_POST["birth"];
$id = $_POST["id"];

$sql = "UPDATE member SET User_name='$name',Gender='$gender',Email='$email',Phone='$phone',date_of_birth='$birth' WHERE id=$id";

if ($conn->query($sql) === true) {
    echo "更新成功";
} else {
    echo "更新失敗:" . $conn->error;
}

$conn->close();
header("location: user.php?id=$id");