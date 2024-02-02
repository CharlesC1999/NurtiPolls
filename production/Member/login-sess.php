<!-- SESS登入 -->

<?php
session_start();
if (isset($_SESSION["User_name"])) {
    header("locastion:member.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>session登入</title>
<?php
include "./css.php";
?>
<style>

</style>
</head>
<body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
      <?php if (isset($_SESSION["error"]["times"]) && $_SESSION["error"]["times"] > 5): ?>
        <h1>登入錯誤次數太多，請稍後再嘗試</h1>
        <?php else: ?>
<form action="doLoginSess.php" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label" >Account</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="account" >
    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" >
  </div>
  <!-- <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Repassword</label>
    <input type="password" class="form-control" id="exampleInputPassword2" name="repassword" >
  </div> -->

  <?php if (isset($_SESSION["error"]["message"])): ?>
      <div class="text-danger"><?=$_SESSION["error"]["message"]?></div>
    <?php endif;
unset($_SESSION["error"]["message"]);
?>
<!-- 重整後紅字消失 -->
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="remember">
    <label class="form-check-label" for="remember">Remember me</label>
  </div>
  <button type="submit" class="btn btn-primary">登入</button>

</form>
<?php endif;?>
</div>

<?php
include "./js.php";
?>
</body>
</html>