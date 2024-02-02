<?php

require_once("../db_connect.php");
var_dump($_POST);

if (!isset($_POST["product_id"])) {
    die("請循正常管道進入");
}

// 获取 POST 数据
$product_id = $_POST["product_id"];
$product_name = $_POST["product_name"];
$category = $_POST["category"];
$price = $_POST["price"];
$stock_quantity = $_POST["quantity"];
$description = $_POST["description"];
$old_image = isset($_POST["old_image"]) ? $_POST["old_image"] : '';
$valid = isset($_POST["valid"]) ? $_POST["valid"] : 0;

// 设定目标目录
$targetDirectory = "./p_image"; // 指定上传文件的目录

if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
    $fileTmpName = $_FILES["file"]["tmp_name"];
    $fileName = $_FILES["file"]["name"];
    // 使用时间戳和原文件名生成新的文件名，防止文件名冲突
    $newFileName = time() . '_' . $fileName;
    $targetFile = $targetDirectory . '/' . $newFileName;

    if (move_uploaded_file($fileTmpName, $targetFile)) {
        echo "文件上傳成功<br>";
        // 如果文件上传成功，将新的文件路径赋值给 $image
        $image = $newFileName;
    } else {
        echo "文件上傳失敗<br>";
        // 如果文件上传失败，保持使用旧的图片
        $image = $old_image;
    }
} else {
    echo "沒有文件被上傳，使用舊圖片<br>";
    $image = $old_image;
}

// 更新 product 表
$sqlProduct = "UPDATE product SET name=?, category_id=?, price=?, stock_quantity=?, description=?, valid=? WHERE id=?";
$stmtProduct = $conn->prepare($sqlProduct);
$stmtProduct->bind_param("siidsii", $product_name, $category, $price, $stock_quantity, $description, $valid, $product_id);
if ($stmtProduct->execute()) {
    echo "產品資訊更新成功<br>";
} else {
    echo "更新產品資訊錯誤: " . $conn->error . "<br>";
}

// 更新 product_image 表，假设只更新第一张图片的 URL
if (!empty($image)) {
    $sqlImage = "UPDATE product_image SET image_url=? WHERE F_product_id=? LIMIT 1";
    $stmtImage = $conn->prepare($sqlImage);
    $stmtImage->bind_param("si", $image, $product_id);
    $stmtImage->execute();
}

$conn->close();

// 重定向回编辑页面
header("location: Product.php?product_id=$product_id");
