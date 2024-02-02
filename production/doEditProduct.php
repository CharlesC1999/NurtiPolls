<?php

require_once("../db_connect.php");

// 检查是否有 POST 请求并获取数据
if (!isset($_POST["product_id"])) {
    die("請循正常管道進入");
}

$product_id = $_POST["product_id"];
$product_name = $_POST["product_name"];
$category = $_POST["category"];
$price = $_POST["price"];
$stock_quantity = $_POST["quantity"];
$description = $_POST["description"];
$old_image = isset($_POST["old_image"]) ? $_POST["old_image"] : '';

$image = $old_image;

if (isset($_FILES["file"]) && $_FILES["file"]['error'] === UPLOAD_ERR_OK) {
    $fileName = $_FILES["file"]["name"];
    $fileTmpName = $_FILES["file"]["tmp_name"]; //預設檔案名
    $targetDirectory = "p_image/images/"; //指定上傳文件的目錄
    $targetFile = $targetDirectory . basename($flieName);

    if (move_uploaded_file($fileTmpName, $targetFile)) {
        echo "文件上傳成功";
        $image = $targetFile; //新的圖片路徑
    } else {
        echo  "文件上傳失敗";
    }
} else {
    echo "沒有文件被上傳，使用舊圖片";
    $image = $old_image;
}

// 更新 product 表
$sqlProduct = "UPDATE product SET name=?, category_id=?, price=?, stock_quantity=?, description=? WHERE id=?";
$stmtProduct = $conn->prepare($sqlProduct);
$stmtProduct->bind_param("siidsi", $product_name, $category, $price, $stock_quantity, $description, $product_id);

if ($stmtProduct->execute()) {
    echo "產品資訊更新成功<br>";
} else {
    echo "更新產品資訊錯誤: " . $conn->error . "<br>";
}

// 更新 product_image 表，假设只更新第一张图片的 URL
$sqlImage = "UPDATE product_image SET image_url=? WHERE F_product_id=? LIMIT 1";
$stmtImage = $conn->prepare($sqlImage);
$stmtImage->bind_param("si", $image, $product_id);

if ($stmtImage->execute()) {
    echo "產品圖片更新成功<br>";
} else {
    echo "更新產品圖片錯誤: " . $conn->error . "<br>";
}

$conn->close();

// 重定向回编辑页面
header("location: editProduct.php?id=$product_id");
