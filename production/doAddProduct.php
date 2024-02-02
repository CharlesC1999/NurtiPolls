<?php
require_once("../db_connect.php");

// 定义变量并从表单获取数据
$category = $_POST['category'];
$productName = $_POST['product_name'];
$productDescription = $_POST['product_Description'];
$productPrice = $_POST['product_price'];
$quantity = $_POST['quantity'];
$now = date("Y-m-d H:i:s");

// 检查必要字段是否填写
if (empty($category) || empty($productName) || empty($productDescription) || empty($productPrice) || empty($quantity)) {
    echo "请填入必要栏位";
    exit;
}

// 插入产品信息到 product 表
$sqlCreateProduct = "INSERT INTO product (category_id, name, description, price, stock_quantity, upload_date) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sqlCreateProduct);
$stmt->bind_param("issiis", $category, $productName, $productDescription, $productPrice, $quantity, $now);
$stmt->execute();

// 检查产品是否成功插入并获取最新插入的id
if ($stmt->affected_rows > 0) {
    $lastInsertedId = $conn->insert_id;

    // 如果有上传图片，处理图片上传
    if ($_FILES["product_image"]["error"] == 0) {
        $fileName = basename($_FILES["product_image"]["name"]); // 获取文件名
        $targetDirectory = "p_image/"; // 临时存储文件的目录
        $targetFile = $targetDirectory . $fileName;

        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
            // 插入图片信息到 product_image 表
            $sqlInsertImage = "INSERT INTO product_image (F_product_id, image_url, sort_order, upload_date) VALUES (?, ?, ?, ?)";
            $stmtImage = $conn->prepare($sqlInsertImage);
            $sortOrder = 0; // 假设你想要的排序顺序是 0
            $stmtImage->bind_param("issi", $lastInsertedId, $fileName, $sortOrder, $now);
            $stmtImage->execute();

            $stmtImage->close();
        }
    }

    // 不论图片信息是否添加成功，都重定向到 product.php
    header('Location: product.php');
    exit; // 确保之后的代码不会被执行
} else {
    echo "新增产品资料失败：" . $conn->error;
}

// 关闭 statement 和数据库连接
$stmt->close();
$conn->close();
