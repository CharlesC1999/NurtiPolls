<!-- wu 註冊前台 -->
<?php
require_once "./connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
include "../css.php";
?>
</head>
<body>
<body>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <form action="doSignIn.php" method="post">
                <h1 class="text-center">註冊</h1>
                <div class="mb-2">
                    <label for="" class="form-label">account</label>
                    <input type="text" class="form-control" name="account">
                </div>

                <div class="mb-2">
                    <label for="" class="form-label">password</label>
                    <input type="text" class="form-control" name="password">
                </div>

                <div class="mb-2">
                    <label for="" class="form-label">Retype-Password</label>
                    <input type="text" class="form-control" name="repassword">
                </div>
                <button class="btn btn-primary" type="submit">送出</button>
                </form>
            </div>
        </div>
        </div>
    <?php
include "../js.php";
?>
    </body>
</html>
</body>
</html>