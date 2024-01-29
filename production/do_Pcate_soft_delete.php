<?php

require_once "../db_connect.php";

if (isset($_POST["Product_cate_ID"])) {
    $id = $_POST["Product_cate_ID"];

    $sql = "UPDATE product_categories SET valid=0 WHERE Product_cate_ID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "刪除成功";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

header("Location: categories_product_edit.php");
