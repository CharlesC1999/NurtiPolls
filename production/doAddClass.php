<?php
require_once("/xampp/htdocs/project/php_connect/db_connect.php");
if (!isset($_POST["className"])) {
    $data = [
        "status" => 0,
        "message" => "參數錯誤"
    ];
    echo json_encode($data);
    exit;
}

$className = trim($_POST["className"]);
$classCategory = trim($_POST["classCategory"]);
$speaker = trim($_POST["speaker"]);
$classPrice = $_POST["classPrice"];
$personLimit = $_POST["personLimit"];
$startDate = $_POST["startDate"];
$endDate = $_POST["endDate"];
$classDate = $_POST["classDate"];
$classDescription = trim($_POST["classDescription"]);

//確認是否填入所有欄位
if (empty($className) || empty($classCategory) || empty($speaker) || empty($classPrice) || empty($personLimit) || empty($startDate) || empty($endDate) || empty($classDate) || empty($classDescription)) {
    $data = [
        "stauts" => 0,
        "message" => "請輸入所有必填欄位"
    ];
    echo json_encode($data);
    exit;
}


//確認是否有重複課程名稱
$checkClassName = "SELECT * FROM class WHERE Class_name = '$className'";
$resultClassName = $conn->query($checkClassName);
$classNameExist = $resultClassName->num_rows;

if ($classNameExist != 0) {
    $data = [
        "status" => 0,
        "message" => "課程名稱重複，請重新輸入"
    ];
    echo json_encode($data);
    exit;
}

//將接收到的日期轉換為Y-m-d格式
$formattedStartDate = date("Y-m-d", strtotime($startDate));
$formattedEndDate = date("Y-m-d", strtotime($endDate));
$formattedClassDate = date("Y-m-d", strtotime($classDate));

// 確認資料正確後新增課程
$sql = "INSERT INTO class (Class_name, Class_description, C_price, F_Speaker_ID, Class_person_limit, Start_date, End_date, Class_date, Class_category_ID, valid) VALUES ('$className', '$classDescription', '$classPrice', '$speaker', '$personLimit', '$formattedStartDate', '$formattedEndDate','$formattedClassDate','$classCategory',1)";


//執行新增課程並取得新插入資料的id
if ($conn->query($sql)) {
    $data = [
        "status" => 1,
        "id" => $conn->insert_id
    ];
    echo json_encode($data);
    $insert_id = $conn->insert_id;
} else {
    $data = [
        "status" => 0,
        "message" => "新增課程失敗"
    ];
    echo json_encode($data);
    exit;
}


//時間戳記取代檔名
if ($_FILES["fileUpload"]["error"] == 0) {
    $filename = time();
    $fileExt = pathinfo($_FILES["fileUpload"]["name"], PATHINFO_EXTENSION);
    $filename = $filename . "." . $fileExt;

    if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], "../fileUpload/" . $filename)) {
        $now = date("Y-m-d H:i:s");
        $sqlImage = "UPDATE class_image SET F_Class_ID = '$insert_id', Image_URL = '$filename', Upload_date = '$now'";
        echo '$sqlImage';
    } else {
        echo "資料上傳失敗";
    }
}

// $conn->close();
