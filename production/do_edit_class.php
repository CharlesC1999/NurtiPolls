<?php

require_once "../db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 獲取id
    $categoryName = $_POST["categoryName"];
    $categoryDescription = $_POST["categoryDescription"];
    $id = $_POST["id"];

    // 更新
    $sql = "UPDATE class_categories SET Class_cate_name = ?, C_Description = ? WHERE Class_cate_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $categoryName, $categoryDescription, $id);

    if ($stmt->execute()) {
        echo "更新成功";
        $stmt->close();
        $conn->close();

        header("Location: categories_class_edit.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
