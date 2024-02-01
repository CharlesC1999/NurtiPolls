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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>登入 </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
  <!-- <div class="vh-100 d-flex justify-content-center align-items-center"> -->
  <?php if (isset($_SESSION["error"]["times"]) && $_SESSION["error"]["times"] > 3): ?>
        <h1>登入錯誤次數太多，請稍後再嘗試</h1>
        <?php else: ?>

    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="doLoginSess.php">
              <h1>登入</h1>
              <div>
                <input type="text" class="form-control" placeholder="帳號" required=""  name="account"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="密碼" required="" name="password"/>
              </div>

              <?php if (isset($_SESSION["error"]["message"])): ?>
      <div class="text-danger"><?=$_SESSION["error"]["message"]?></div>
    <?php endif;
unset($_SESSION["error"]["message"]);
?>
              <div class="d-flex justify-content-center">
              <button type="submit" class="btn btn-secondary">log in</button>
                <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <!-- <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p> -->

                <div class="clearfix"></div>
                <!-- <br /> -->

                <div>
                  <h1><img src="./Logo.png" alt="" style="width:50px;height:50px;"></i> 營養大選</h1>
                  <p>©111 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
            <?php endif;?>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <!-- <h1>Create Account</h1> -->
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> 營養大選</h1>
                  <p>©111 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>

  </body>
</html>
