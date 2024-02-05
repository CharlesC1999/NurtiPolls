<!-- wu 恢復刪除會員資格後台 -->
<?php
require_once "../../db_connect.php";

if (!isset($_GET["id"])) {
    echo "請循正常管道";
    exit;
}
$id = $_GET["id"];
$sql = "UPDATE   member SET valid='1' WHERE id=$id";

if ($conn->query($sql) === true) {
    echo "刪除成功";
} else {
    echo "刪除失敗:";
    $conn->error;
}
$conn->close();
header("location: delete_list.php");

