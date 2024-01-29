<?php

require_once("../db-connect.php");

if (!isset($_POST["name"])) {
    die("請循正常管道進去");
} 

$name=$_POST["name"];
$description=$_POST["description"];
$id = $_POST["id"]; 
$old_img=$_POST["old_img"];

if ($_FILES['file']['error'] == 0){
    #如果有選擇圖片就使用新上傳的圖片
    $filename=time(); // 取得當前的 Unix 時間戳（秒級別）
    // pathinfo 取得上傳檔案的擴展名(路徑/PATHINFO_EXTENSION(.jpg))
    $fileExt=pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
    $filename=$filename.".".$fileExt; 
    
    #上傳圖片
    if(move_uploaded_file($_FILES['file']['tmp_name'], 'Speaker_pic/'.$filename)){
        echo "成功";
    }else{
        echo "失敗";
    }
  } else {
    echo $_FILES['file']['error'];
    #如果沒有選擇圖片就使用原本資料庫的圖片
    $filename=$old_img;
  }
 

$sql="UPDATE speaker SET Speaker_name='$name', Speaker_description='$description',Image='$filename' WHERE Speaker_ID=$id";

if($conn->query($sql) === TRUE){
    echo "更新成功";
}else{
    echo "更新資料錯誤" .$conn->error;
}

$conn->close();

header("location: speaker.php");