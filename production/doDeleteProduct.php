<?php

require_once("../db_connect.php");

// 检查 product_id 是否已设置并且不为空
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = $_GET["id"];
    echo $id;


    // 使用参数化查询
    $sql = "UPDATE product SET valid='0' WHERE id=?";


    // 准备 SQL 语句
    $stmt = $conn->prepare($sql);

    // 绑定参数
    $stmt->bind_param("i", $id);


    // 执行查询
    if ($stmt->execute()) {
        echo "刪除成功";
    } else {
        echo "刪除資料錯誤: " . $stmt->error;
    }

    // 关闭语句
    $stmt->close();
} else {
    echo "未提供产品 ID";
}

// 关闭数据库连接
$conn->close();

// 重定向回产品页面
header("location: product.php");
