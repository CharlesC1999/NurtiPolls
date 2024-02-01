<?php
require_once("../db_connect.php");

// 定義變量並從表單獲取數據
$category = $_POST['category'];
$productName = $_POST['product_name'];
$productDescription = $_POST['product_Description'];
$productPrice = $_POST['product_price'];
$quantity = $_POST['quantity'];
// $status = $_POST['status'];
$now = date("Y-m-d H:i:s");

// 檢查必要字段是否填寫
if (empty($category) || empty($productName) || empty($productDescription) || empty($productPrice) || empty($quantity)) {
    echo "請填入必要欄位";
    exit;
}

// 插入產品信息到product表
$sqlCreateProduct = "INSERT INTO product (category_id, name, description, price, stock_quantity, upload_date) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sqlCreateProduct);
$stmt->bind_param("issiis", $category, $productName, $productDescription, $productPrice, $quantity, $now);
$stmt->execute();

// 檢查產品是否成功插入並獲取最新插入的id
if ($stmt->affected_rows > 0) {
    $lastInsertedId = $conn->insert_id;

    // 如果有上傳圖片，處理圖片上傳
    if ($_FILES["product_image"]["error"] == 0) {
        $targetDirectory = "./p_image/";
        $targetFile = $targetDirectory . basename($_FILES["product_image"]["name"]);

        $targetFile = str_replace('\\', '/', $targetFile);
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
            echo "圖片上傳成功！";


            // 插入圖片信息到product_image表
            $sqlInsertImage = "INSERT INTO product_image (F_product_id, image_url, sort_order ,upload_date) VALUES (?, ?, ?)";
            $stmtImage = $conn->prepare($sqlInsertImage);
            $stmtImage->bind_param("iss", $lastInsertedId, $targetFile, 0, $now);
            $stmtImage->execute();

            if ($stmtImage->affected_rows > 0) {
                echo "圖片信息新增成功！";
            } else {
                echo "圖片信息新增失敗：" . $conn->error;
            }
            $stmtImage->close();
        } else {
            echo "圖片上傳失敗！";
        }
    }
} else {
    echo "新增產品資料失敗：" . $conn->error;
}

$stmt->close();
$conn->close();
