<?php

require_once "../db_connect.php";

if (isset($_POST["Class_cate_ID"])) {
    $id = $_POST["Class_cate_ID"];

    $sql = "UPDATE class_categories SET valid = 0 WHERE Class_cate_ID = ?";

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

header("Location: categories_class_edit.php");
