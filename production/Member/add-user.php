<!-- wu 新增加會員 ui 會員表格連線 -->
<?php
require_once "./connect.php";
?>

<!doctype html>
<html lang="en">

<head>
    <title>add-user</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php
include "./css.php";
?>
</head>

<body>

<div class="container">
        <form action="doAddUser.php" method="post" enctype="multipart/form-data">
            <div class="mt-2">
                <!-- 名字 -->
                <label for="" class="form-label">
                    name
                </label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mt-2">
                <!-- 帳號 -->
                <label for="" class="form-label">
                    account
                </label>
                <input type="text" class="form-control" name="account">
            </div>
            <div class="mt-2">
                <!-- 密碼 -->
                <label for="" class="form-label">
                    password
                </label>
                <input type="password" class="form-control" name="password">
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
            <label for="" class="form-label">選擇圖片</label>
            <input type="file" class="form-control" name="img" >
            </div>
            <div class="mt-2">
            <button type="submit" class="btn btn-primary">送出</button>
            </div>

        </form>

    </div>
    <?php
include "./js.php";
?>
</body>

</html>
</body>

</html>