<!--pathinfo函式用法 -> https://www.runoob.com/php/func-filesystem-pathinfo.html -->


<!-- 用PHP上傳檔案 -> https://www.tad0616.net/modules/tad_book3/html_all.php?tbsn=8
1.若表單中有file元件，表單一定要加上：「enctype="multipart/form-data"」。
2.每上傳一張圖（假設file欄位名稱為pic），都會產生一組 $_FILES 超級全域變數：
(1) $_FILES['pic']['name']（多檔：$_FILES['pic']['name'][0]）：上傳檔案原始名稱。
(2) $_FILES['pic']['type']：檔案的 MIME 類型，例如“image/gif”。
(3) $_FILES['pic']['size']：已上傳檔案的大小，單位為bytes。
(4) $_FILES['pic']['tmp_name']：檔案被上傳後的臨時檔案名。
(5) $_FILES['pic']['error']：和該檔案上傳相關的錯誤代碼。
3.上傳的步驟：送出上傳→圖會暫時放到tmp中→程式要搬移該檔到指定的位置。
4.搬移上傳檔方法：move_uploaded_file(暫存檔 , 新路徑檔名) -->
<?php
require_once "../db_connect.php";
// session_start();

if (!isset($_POST["name"])) {
    echo "請循正常管道進入此頁面";
    exit;
}

$name = $_POST["name"];
$description = $_POST["description"];

// if(empty($name)){
//     //$_SESSION 存錯誤訊息回到speaker_add.php頁面
//     $_SESSION["error"]["message"]="請輸入姓名";
//     header("location: speaker_add.php");
//     exit;
// }

// if(empty($description)){
//     $_SESSION["error"]["message"]="請輸入簡介";
//     header("location: speaker_add.php");
//     exit;
// }

//ppt.481 接收圖片是用$_FILES接住
// $file=$_FILES["pic"];
// var_dump($file);

//判斷檔案上傳的過程中是否有錯誤,==0沒有錯誤,再判斷是否移動成功 move_uploaded_file
if ($_FILES["pic"]["error"] == 0) {
    //$filename=time(); 解決檔名重復
    $filename = time(); // 取得當前的 Unix 時間戳（秒級別）

    // pathinfo 取得上傳檔案的擴展名(路徑/PATHINFO_EXTENSION(.jpg))
    $fileExt = pathinfo($_FILES["pic"]["name"], PATHINFO_EXTENSION);
    $filename = $filename . "." . $fileExt;

    // echo $filename;
    // exit;

    if (move_uploaded_file($_FILES["pic"]["tmp_name"], "Speaker_pic/" . $filename)) {

        //上傳到資料庫裡
        $sql = "INSERT INTO speaker (Speaker_name, Speaker_description, Image, valid)
        VALUES ('$name', '$description', '$filename',1)";

        if ($conn->query($sql)) {
            echo "新增資料完成!!";
        } else {
            echo "新增資料錯誤!!" . $conn->error;
        }

        echo "upload 成功!!";
    } else {
        echo "upload 失敗!!";
    }
} else {
    //沒新增圖片有設預設值 -> 資料表更改 Image 結構
    $sql = "INSERT INTO speaker (Speaker_name, Speaker_description, valid)
        VALUES ('$name', '$description',1)";
    $conn->query($sql);
}

$conn->close();
header("location: speaker.php");
?>