<?php

require_once "../db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 獲取id
    $categoryName = $_POST["categoryName"];
    $categoryDescription = $_POST["categoryDescription"];
    $id = $_POST["id"];

    // 更新
    $sql = "UPDATE product_categories SET Product_cate_name = ?, P_Description = ? WHERE Product_cate_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $categoryName, $categoryDescription, $id);

    if ($stmt->execute()) {
        echo "更新成功";
        $stmt->close();
        $conn->close();

        header("Location: categories_product_edit.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
