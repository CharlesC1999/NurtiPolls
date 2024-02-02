<?php
require_once("../db_connect_class.php");

$className = trim($_POST["className"]);
$classCategory = $_POST["classCategory"];
$speaker = $_POST["speaker"];
$classPrice = $_POST["classPrice"];
$personLimit = $_POST["personLimit"];
$startDate = $_POST["startDate"];
$endDate = $_POST["endDate"];
$classDate = $_POST["classDate"];
$classDescription = trim($_POST["classDescription"]);
$fileUpload = $_FILES["fileUpload"];

// 確認是否填入所有欄位
if (empty($className) || empty($classCategory) || empty($speaker) || empty($classPrice) || empty($personLimit) || empty($startDate) || empty($endDate) || empty($classDate) || empty($classDescription)) {
    echo ("請輸入必填欄位");
    exit;
}


//確認是否有重複課程名稱
$checkClassName = "SELECT * FROM class WHERE Class_name = '$className'";
$resultClassName = $conn->query($checkClassName);
$classNameExist = $resultClassName->num_rows;

if ($classNameExist != 0) {
    echo "課程名稱重複，請重新輸入";
    exit;
}


//將接收到的日期轉換為Y-m-d格式
$formattedStartDate = date("Y-m-d", strtotime($startDate));
$formattedEndDate = date("Y-m-d", strtotime($endDate));
$formattedClassDate = date("Y-m-d H:i:s", strtotime($classDate));


// 確認資料正確後新增課程
$sql = "INSERT INTO class (Class_name, Class_description, C_price, F_Speaker_ID, Class_person_limit, Start_date, End_date, Class_date, Class_category_ID, valid) VALUES ('$className', '$classDescription', '$classPrice', '$speaker', '$personLimit', '$formattedStartDate', '$formattedEndDate','$formattedClassDate','$classCategory',1)";


// 執行新增課程並取得新插入資料的id
if ($conn->query($sql)) {
    $insert_id = $conn->insert_id;
    echo "課程新增成功";
} else {
    echo "新增課程失敗";
    exit;
}


// 上傳單張圖片
/* if ($_FILES["fileUpload"]["error"] == 0) {
    $filename = time();
    $fileExt = pathinfo($_FILES["fileUpload"]["name"], PATHINFO_EXTENSION);
    $filename = $filename . "." . $fileExt;


    if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], "../classImg/" . $filename)) {
        $now = date("Y-m-d H:i:s");
        $sqlImage = "INSERT INTO class_image (F_Class_ID, Image_URL, Upload_date) VALUES ('$insert_id','$filename','$now')";


        if ($conn->query($sqlImage)) {
            echo "圖片上傳資料庫成功";
        } else {
            echo "圖片上傳資料庫失敗";
        }
    } else {
        echo "圖片上傳失敗";
    }
}
 */


//上傳多張圖片
$i = count($_FILES["fileUpload"]["name"]);
for ($j = 0; $j < $i; $j++) {
    if ($_FILES["fileUpload"]["error"][$j] == 0) {
        $time = time();
        $fileExt = pathinfo($_FILES["fileUpload"]["name"][$j], PATHINFO_EXTENSION);
        // echo $fileExt . "<br>";
        $fileName = $time . $j . "." . $fileExt;
        // echo $fileName . "<br>";

        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"][$j], "../classImg/" . $fileName)) {
            $now = date("Y-m-d H:i:s");
            $sqlImage = "INSERT INTO class_image (F_Class_ID, Image_URL, Upload_date) VALUES ('$insert_id','$fileName','$now')";

            if ($conn->query($sqlImage)) {
                echo "圖片上傳資料庫成功";
            } else {
                echo "圖片上傳資料庫失敗";
            }
        }
    } else {
        echo "圖片上傳失敗";
    }
}


$conn->close();
header("location: classDetail.php?Class_ID=$insert_id");
