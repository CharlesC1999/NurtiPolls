<?php

require_once("../db_connect.php");

if (!isset($_POST["Title_R_name"])) {
    echo "請循正常管道進入";
    exit;
}
$Title_R_name = $_POST["Title_R_name"];
$Content = $_POST["Content"];
$Recipe_category_ID = $_POST["Recipe_categoey_ID"];

// echo $name;

// $file=$_FILES["pic"];
// var_dump($file);

if ($_FILES["pic"]["error"] == 0) {
    if (move_uploaded_file(
        $_FILES["pic"]["tmp_name"],
        "rimages/" . $_FILES["pic"]["name"]
    )) {
        $filename = $_FILES["pic"]["name"];
        $now = date("Y-m-d H:i:s");

        $sql = "INSERT INTO recipe (Title_R_name, Image_URL, Content, Publish_date,Recipe_category_ID, valid)
        VALUES ('$Title_R_name','$filename','$Content','$now','$Recipe_category_ID', 1)";
        if ($conn->query($sql)) {
            echo "新增完成";
        } else {
            echo "新增錯誤:" . $conn->error;
        }
        echo "upload success";
    } else {
        echo "upload failed";
    }
}
$conn->close();
header("location:recipe-list.php");
