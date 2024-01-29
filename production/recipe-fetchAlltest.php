<?php

require_once("../db_connectn.php");
$sql = "SELECT * FROM recipe";//搜尋資料庫裡全部吃廖
//$sql="SELECT name,phone,... FROM users"; ->不全讀
$result = $conn->query($sql); //搜尋資料表裡的全部資料存進$reslut

$userCount=$result->num_rows; //將結果集中的行數存儲在 $userCount 變數中
echo "共 $userCount 筆資料";

if($userCount > 0):
    $rows=$result->fetch_all(MYSQLI_ASSOC); //關聯是陣列
    ?>
    <pre>
        <?php print_r($rows); ?>
    </pre>
    
    
 <?php
else:
    echo "0 results";

endif;
?>