<!-- wu儲存資料 後台 ui -->
<?php
require_once "../../db_connect.php";

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
$img = $_FILES["img"];
$filename = "";

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
}

$sql = "UPDATE member SET User_name='$name',Gender='$gender',Email='$email',Phone='$phone',date_of_birth='$birth',User_image='$filename' WHERE id=$id";

if ($conn->query($sql) === true) {
    echo "更新成功";
} else {
    echo "更新失敗:" . $conn->error;
}

$conn->close();
header("location: user.php?id=$id");