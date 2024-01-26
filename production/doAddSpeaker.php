<!--pathinfo函式用法 https://www.runoob.com/php/func-filesystem-pathinfo.html -->
<?php
require_once("../db-connect.php");

if(!isset($_POST["name"])){
    echo "請循正常管道進入此頁面";
    exit;
}

$name=$_POST["name"];
$name=$_POST["description"];
echo $name;

//ppt.481 接收圖片是用$_FILES接住
// $file=$_FILES["pic"];
// var_dump($file);

//判斷檔案上傳的過程中是否有錯誤,==0沒有錯誤,再判斷是否移動成功 move_uploaded_file
if($_FILES["pic"]["error"]==0){
    //$filename=time(); 解決檔名重復
    $filename=time(); // 取得當前的 Unix 時間戳（秒級別）
     // pathinfo 取得上傳檔案的擴展名
    $fileExt=pathinfo($_FILES["pic"]["name"],PATHINFO_EXTENSION);
    $filename=$filename.".".$fileExt;  
    
    // echo $filename;
    // exit;

    if(move_uploaded_file($_FILES["pic"]["tmp_name"], "../upload/".$filename)){
        //上傳到資料庫裡
        //$filename=$_FILES["pic"]["name"];
        $now=date('Y-m-d H:i:s'); //直接在後台抓時間 丟給 下面sql
        $sql="INSERT INTO images (name, filename, created_at)
        VALUES ('$name', '$filename', '$now')";   
        
        if($conn->query($sql)){
            echo "新增資料完成!!";
        }else{
            echo "新增資料錯誤!!" .$conn->error;
        }


        echo "upload 成功!!";
    }else{
        echo "upload 失敗!!";
    }
}

// var_dump($_FILES["pic"])
$conn->close();
header("location: file-upload.php");