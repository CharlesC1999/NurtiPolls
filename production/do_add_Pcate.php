<?php
require_once "../db_connect.php";
if (!isset($_POST["categoryName"])) {
    echo "請循正常管道進入";
    exit;
}

$cate_name = $_POST["categoryName"];
$cate_description = $_POST["categoryDescription"];

if (empty($cate_name) || empty($cate_description)) {
    echo "請填入必要欄位";
    exit;
}

$now = date('Y-m-d H:i:s');

$sql = "INSERT INTO product_categories (Product_cate_name, P_Description, `valid`)
-- valid是保留字
VALUES ('$cate_name', '$cate_description', 1)";

// echo $sql;
// exit;

if ($conn->query($sql)) {
    echo "新增資料完成";
    $last_id = $conn->insert_id;
    echo ", id 為 $last_id";
} else {
    echo "新增資料錯誤: " . $conn->error;
}

$conn->close();
// 透過介面新增資料

header("location: categories_product.php");
