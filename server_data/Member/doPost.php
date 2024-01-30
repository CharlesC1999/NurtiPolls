<!-- wu 此檔案為判斷登入資料有無打錯的後台 -->
<?php

if (!isset($_POST["account"])) {
    echo "請循正常管道";
    exit;
}
// 判斷account 不存在報錯
$account = $_POST["account"];
$password = $_POST["password"];
$repassword = $_POST["repassword"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$gender = $_POST["gender"];

if (empty($account)) {
    echo "請填入帳號";
    exit;
}
if (strlen($account) < 4 || strlen($account) > 12) {
    echo "請輸入4~12數字元";
    exit;
}
if (empty($password) || empty($repassword)) {
    echo "請填入密碼";
    exit;
}
if ($password != $repassword) {
    echo "密碼輸入不一致";
    exit;
}
if (empty($email)) {
    echo "請輸入密碼";
    exit;
}
if (empty($phone)) {
    echo "請填入電話";
    exit;
}

echo "account:$account.<br>";
echo "password:$password.<br>";
echo "email:$email.<br>";
echo "phone:$phone.<br>";
echo "gender:$gender.<br>";