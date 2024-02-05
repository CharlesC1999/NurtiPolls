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

<!-- wu Css連接 -->
        <!-- Bootstrap CSS v5.2.1 -->
        <!-- <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <style>
        .login{
            /* background-color: 		#272727;  */
            background-color:#2A3F54;
            /* color:HEX #172a33; */
        }
        .img{
            width: 270px;
            height:270px;
            margin-right:180px;
        }
        .org{
          width: 270px;
            height:410.458px;
            margin-right: 175px;
            background-color:#172a33;
            display: flex;
            /* justify-content: center; */
            align-items: center;
        }
        .btn{
            /* font-size: 20px; Adjust the font size as needed */
            width: 200px;
    /* padding: 10px 20px; */
    margin-left: 5px;
        }
        p{
            color:#162932;
            margin-bottom:-50px;
            font-size:12px;
            /* #6C757D2 */
          position: relative;
          bottom:20px;
        }
        .times{
          position: relative;
          top:30vh;
          color:white;
        }
    </style>
  </head>

  <body class="login">
  <!-- <div class="vh-100 d-flex justify-content-center align-items-center"> -->
  <?php if (isset($_SESSION["error"]["times"]) && $_SESSION["error"]["times"] > 3): ?>
        <h1 class="d-flex align-items-end justify-content-center times">登入錯誤次數太多，請稍後再嘗試</h1>
        <?php else: ?>

    <div class="d-flex justify-content-center">
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper  d-flex justify-content-center">
      <!-- <table class="table table-bordered "> -->
        <!-- table-secondary -->
        <!-- <thead>
        <tr> -->
        <!-- <td>
                asc
            </td> -->
        <!-- <td  -->
            <div class="container ">
                <div class="row ">
                <div class="col-3 d-flex align-items-center justify-content-center ">
                <div class="org">
                <img src="./nut.png" class="img">
                </div>
          </div>
                    <div class="col-9" style="width:500px" style="background-color:white">
          <div class="animate form login_form" >
          <!-- style="background-color:white;height: 410px; width:400px" -->
          <section class="login_content" style="background-color:white;height: 410px; width:400px;margin-left:-15px">
            <form method="post" action="doLoginSess.php"  >
              <h1>登入</h1>
              <div class="d-flex justify-content-center">
                <input type="text" class="form-control" placeholder="帳號" name="account" style="width:200px"/>
                <!-- required=""  -->
              </div>
              <div class="d-flex justify-content-center">
                <input type="password" class="form-control" placeholder="密碼" name="password" style="width:200px"/>
                <!-- required=""  -->
              </div>

              <?php if (isset($_SESSION["error"]["message"])): ?>
              <div class="text-danger mb-2"><?=$_SESSION["error"]["message"]?></div>
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
                  <h1></i> 營養大選 <img src="./Logo.png" alt="" style="width:50px;height:50px;"></h1>
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
                <input type="text" class="form-control" placeholder="Username"/>
                <!-- required=""  -->
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" />
                <!--required=""  -->
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" />
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
                    <!-- <i class="fa fa-paw"></i> -->
                  <h1> 營養大選</h1>
                  <p>©111 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
               </div>
              </form>
             </section>
          </div>

              <!-- </td>
              </tr>
              </thead>
              </table> -->
              </div>
              </div>
              </div>
      </div>
    </div>

  </body>
</html>
