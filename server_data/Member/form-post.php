<?php
require_once("./connect.php");
?>

<!doctype html>
<html lang="en">
<!-- 註冊會員 畫面操做 ui -->
<head>
    <title>form-get</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php
    include("../css.php");
    ?>
</head>

<body>
    <div class="container">
        <form action="doPost.php" method="post">
            <div class="mt-2">
                <!-- 帳號 -->
                <label for="" class="form-label">
                    account
                </label>
                <input type="text" class="form-control" name="account">
                <div class="form-text">
                    請輸入4~12數字元
                </div>
            </div>
            <div class="mt-2">
                <!-- 密碼 -->
                <label for="" class="form-label">
                    password
                </label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mt-2">
                <!--重新輸入密碼 -->
                <label for="" class="form-label">
                    Retype-password
                </label>
                <input type="password" class="form-control" name="repassword">
            </div>
            <div class="mt-2">
                <!-- 請填入信箱 -->
                <label for="" class="form-label">
                    信箱
                </label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="mt-2">
                <!-- 請輸入電話 -->
                <label for="" class="form-label">
                    Phone
                </label>
                <input type="number" class="form-control" name="phone">
            </div>
            <div class="mt-2">
                <label for="" class="form-label">
                    性別
                </label>
            </div>
            <div class="mb-2">
                <!-- 性別 -->
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
                    <label class="form-check-label" for="inlineRadio1" >Male</label>
                </div>
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="female" value="female" >
                    <label class="form-check-label" for="inlineRadio2">Female</label>
                </div>
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="others" value="others">
                    <label class="form-check-label" for="inlineRadio2">others</label>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">送出</button>
            </div>
        </form>
    </div>
    <?php
    include("../js.php");
    ?>
</body>

</html>