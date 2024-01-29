<?php

require_once("../db_connectn.php");

if(!isset($_POST["Title_R_name"])){
    die("請循正常管道進入");
}

$Title_R_name=$_POST["Title_R_name"];
$Image_URL=$_POST["pic"];
$Content=$_POST["Content"];
$Recipe_category_ID=$_POST["Recipe_category_ID"];
$Recipe_ID=$_POST["Recipe_ID"];


// $sql="UPDATE recipe SET Title_R_name='$Title_R_name',pic='$Image_URL',Content='$Content' WHERE Recipe_ID=$Recipe_ID";

// if ($conn->query($sql) === TRUE) {
//     echo "更新成功";
// } else {
//     echo "更新資料錯誤: " . $conn->error;
// }

// $conn->close();

if($_FILES["pic"]["error"]==0){
    if(move_uploaded_file($_FILES["pic"]["tmp_name"],"/nurtipolls/rimages/".$_FILES["pic"]["Title_R_name"]
    )){
        $filename=$_FILES["pic"]["Title_R_name"];
        
        
        $sql="UPDATE recipe (Title_R_name, filename, Content,Recipe_category_ID ) 
        VALUES ('$Title_R_name','$filename','$Content','$Recipe_ID')";
        if($conn->query($sql)){
            echo "新增完成";
            
        }else{
            echo "新增錯誤:" .$conn->error;
        }
        echo "update success";

    }else{
        echo "update failed";
    }
}

// header("location: user-edit.php?id=$id");