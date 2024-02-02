<!-- wu 新增加會員 ui 會員表格連線 -->
<?php
session_start();
require_once "../../db_connect.php";
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
<style>
    .img-upload input[type="file"] {
    /* 將文件輸入框的寬度固定為 200 像素 */
    width: 200px;
    /* 將文件輸入框的高度固定為 100 像素 */
    height: 100px;
}
table {
            background-color:gray;
        }
.img{
    /* display: flex;
    justify-content: center;
     align-items: center; */
     text-align: center;
            vertical-align: middle;
}
</style>
</head>

<body>

<div class="container">
<div class="d-flex justify-content-center mt-5">註冊會員</div>
<table class="table table-bordered ">
    <!-- table-secondary -->
    <thead>
        <tr>
        <td class="img">
            <img src="./img.png" alt="">

        </td>
        <td>
        <form action="doAddUser.php" method="post" enctype="multipart/form-data">
            <div class="mt-2">
                <!-- 名字 -->
                <label for="" class="form-label">
                    name
                </label>
                <input type="text" required="required" maxlength="11" minlength="3" class="form-control" name="name">
            </div>
            <div class="mt-2">
                <!-- 帳號 -->
                <label for="" class="form-label">
                    account
                </label>
                <input type="text"required="required"
                 class="form-control" name="account">
            </div>
            <div class="mt-2">
                <!-- 密碼 -->
                <label for="" class="form-label">
                    password
                </label>
                <input type="password" required="required" pattern="^(?=.*[a-zA-Z])(?=.*[0-9]).{3,}$" class="form-control" name="password">
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
                <input type="number" class="form-control" required="required" name="phone">
            </div>
            <div class="mt-2">
            <label for="" class="form-label">選擇圖片</label>
            <input type="file" class="form-control" name="img" >
            </div>
            <?php if (isset($_SESSION["error"]["message"])): ?>
            <div class="text-danger"><?=$_SESSION["error"]["message"]?></div>
            <?php endif;
unset($_SESSION["error"]["message"]);
?>
            <div class="mt-2">
            <button type="submit" class="btn btn-primary">送出</button>
            </div>

        </form>
        </td>


        </tr>
        </thead>
</table>
    </div>
    <?php
include "./js.php";
?>
</body>

</html>
</body>

</html>