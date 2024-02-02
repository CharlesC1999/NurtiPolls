<?php
require_once("../db_connect.php");

if(!isset($_POST["name"])){
    echo "請循正常管道進入";
    exit;
}

$id=$_POST["id"];
$name=$_POST["name"];
$code=$_POST["code"];
$startdate=$_POST["validStartDate"];
$enddate=$_POST["validEndDate"];
$discount_type=$_POST["discount_type"];
$couponAmount=$_POST["couponAmount"];
$min_Amount=$_POST["min_amount"];
$coupon_description=$_POST["coupon_description"];


$sql="UPDATE coupons 
SET C_name='$name' ,C_code='$code' ,Discount_amount='$couponAmount',Discount_type='$discount_type',
Coupon_description='$coupon_description',
Valid_start_date='$startdate', Valid_end_date='$enddate', minimum_spend='$min_Amount' WHERE Coupon_ID=$id";

if($conn->query($sql)){
    echo "更新優惠券資料完成";
} else {
    echo "更新優惠券資料錯誤: " . $conn->error; 
}


// 更新優惠券適用商品
if (isset($_POST["categories"]) && is_array($_POST["categories"])){

// 1. 接收從表單提交的分類
$can_use_product=$_POST["categories"];

// 2. 獲取目前優惠券的分類
$sqlcc = "SELECT GROUP_CONCAT(pc.Product_cate_ID) as category_ids 
FROM coupons c 
JOIN coupon_categories cc ON c.Coupon_ID = cc.coupon_id 
JOIN product_categories pc ON cc.category_id = pc.Product_cate_ID 
WHERE c.Coupon_ID = $id 
GROUP BY c.Coupon_ID;";

// 抓出關聯資料表中，目前每筆優惠券已選中的商品分類
$resultcc = $conn->query($sqlcc);
$rowcc = $resultcc->fetch_assoc();
$existingCategories = $rowcc["category_ids"] ? explode(",", $rowcc["category_ids"]) : array();

// 3. 比對並更新
// 判斷哪些需要被刪除
foreach ($existingCategories as $category) {
    if (!in_array($category, $can_use_product)) {
        // 刪除不再選中的分類
        $deleteSql = "DELETE FROM coupon_categories WHERE coupon_id = $id AND category_id = $category";
        $conn->query($deleteSql);
    }
}

// 判斷哪些需要被添加
foreach ($can_use_product as $category) {
    if (!in_array($category, $existingCategories)) {
        // 新增被選中的分類
        $insertSql = "INSERT INTO coupon_categories (coupon_id, category_id) VALUES ($id, $category)";
        $conn->query($insertSql);
    }
}

}else{
    // 當用戶沒有選中任何分類時，刪除所有與該優惠券相關的分類
    $deleteAllSql = "DELETE FROM coupon_categories WHERE coupon_id = $id";
    $conn->query($deleteAllSql);
}
// 重定向或顯示訊息

$conn->close();

header("location: coupons.php");
exit();
?>