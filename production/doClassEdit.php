<?php
require_once("../db_connect_class.php");

if (!isset($_POST["classID"])) {
    die("請循正常管道進入此頁");
}

$classID = $_POST["classID"];
$className = $_POST["className"];
$classCategory = $_POST["classCategory"];
$speaker = $_POST["speaker"];
$classPrice = $_POST["classPrice"];
$personLimit = $_POST["personLimit"];
$startDate = $_POST["startDate"];
$endDate = $_POST["endDate"];
$classDate = $_POST["classDate"];
$classEndDate = $_POST["classEndDate"];
$classDescription = $_POST["classDescription"];


$sql = "UPDATE class SET Class_name='$className', Class_category_ID='$classCategory', F_Speaker_ID='$speaker', C_price='$classPrice', Class_person_limit='$personLimit', Start_date='$startDate', End_date='$endDate', Class_date='$classDate', Class_end_date = '$classEndDate', Class_description='$classDescription' WHERE Class_ID='$classID'";

// echo $sql . "<br>";

if ($conn->query($sql)) {
    echo "資料更新成功!";
} else {
    echo "資料更新錯誤" . $conn->error;
};


//計算檔案數量
$filesCount = count($_FILES["fileUpload"]["name"]);

//迴圈判斷每個input是否有上傳新檔案
for ($i = 0; $i < $filesCount; $i++) {
    $fileUpload = $_FILES["fileUpload"]["name"][$i];
    $oriFile = $_POST["oriFile"][$i];


    if ($_FILES["fileUpload"]["size"][$i] > 0) {
        // $fileUpdate[$i] = $fileUpload;

        //更新圖片
        if ($_FILES["fileUpload"]["error"][$i] == 0) {
            $time = time();
            $fileExt = pathinfo($_FILES["fileUpload"]["name"][$i], PATHINFO_EXTENSION);
            $fileName = $time . $i . "." . $fileExt;

            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"][$i], "../classImg/" . $fileName)) {
                $sql = "UPDATE class_image SET Image_URL='$fileName' WHERE Image_URL='$oriFile'";

                // echo "更新圖片為: " . $sql . "<br>";

                if ($conn->query($sql)) {
                    echo "檔案 " . $fileName . " 上傳資料庫成功" . "<br>";
                } else {
                    echo "檔案 " . $fileName . " 上傳資料庫失敗" . "<br>";
                }
            } else {
                echo "新檔案 " . $fileName . " 上傳失敗" . "<br>";
            }
        }
    } else {
        // $fileUpdate[$i] = $oriFile;

        $sql = "UPDATE class_image SET Image_URL='$oriFile' WHERE Image_URL='$oriFile'";

        // echo "維持圖片為: " . $sql . "<br>";

        if ($conn->query($sql)) {
            echo "檔案 " . $fileName . " 維持" . "<br>";
        } else {
            echo "檔案 " . $fileName . " 維持失敗" . "<br>";
        }
    }
}


// //新增圖片
// if ($_FILES["fileUpload"]["error"] == 0) {
//     $filename = time();
//     $fileExt = pathinfo($_FILES["fileUpload"]["name"], PATHINFO_EXTENSION);
//     $filename = $filename . "." . $fileExt;


//     if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], "../classImg/" . $filename)) {
//         $now = date("Y-m-d H:i:s");
//         $sqlImage = "INSERT INTO class_image (F_Class_ID, Image_URL, Upload_date) VALUES ('$classID','$filename','$now')";

//         if ($conn->query($sqlImage)) {
//             echo "圖片上傳資料庫成功";
//         } else {
//             echo "圖片上傳資料庫失敗";
//         }
//     } else {
//         echo "圖片上傳失敗";
//     }
// }



header("location: classDetail.php?Class_ID=$classID");

$conn->close();
