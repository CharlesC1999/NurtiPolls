<!--wu 會員個人修改 ui 頁面-->
<?php
if (!isset($_GET["id"])) {
    $id = 0;
} else {
    $id = $_GET["id"];
}
require_once "../../db_connect.php";
$sql = "SELECT * FROM member WHERE id=$id AND valid=1";
$result = $conn->query($sql);
$rowCount = $result->num_rows;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>營養大選 Nutripolls</title>

    <!-- Bootstrap -->
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->

    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../profile.css">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
            <a href="../HomePage.html" class="site_title"
                ><img src="../../Logo_sm.png" alt="" style="height: 65px;"></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
            <div class="profile_pic">
              <img
                  src="../../logo4.png"
                  alt="..."
                  class="img-circle profile_img"
                />
              </div>
              <div class="profile_info">
                <span>Hi,</span>
                <h2>第四組</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div
              id="sidebar-menu"
              class="main_menu_side hidden-print main_menu"
            >
              <div class="menu_section">

                <ul class="nav side-menu">
                  <li class="h6"><a href="member.php"><i class="fa-solid fa-user fa-fw"></i> 會員管理</a>
                  </li><li class="h6"><a href="../product.php"><i class="fa-solid fa-store fa-fw"></i> 商品管理</a>
                  </li>
                  <li class="h6"><a><i class="fa-solid fa-hashtag fa-fw"></i> 分類管理<span class="fa fa-chevron-down"></span>
                  <ul class="nav child_menu">
                      <li><a href="../categories_product.php" style="font-size: 16px;"> 商品</a></li>
                      <li><a href="../categories_class.php" style="font-size: 16px;"> 課程</a></li>
                      <li><a href="../categories_recipe.php" style="font-size: 16px;"> 食譜</a></li>

                    </ul>

                  </li>
                  <li class="h6"><a href="../recipe-list.php"><i class="fa-solid fa-kitchen-set fa-fw"></i> 食譜管理</a>
                  </li>
                  <li class="h6"><a href="../speaker.php"><i class="fa-solid fa-chalkboard-user fa-fw"></i> 講師管理</a>
                  </li>
                  <li class="h6"><a href="../redirectClass.php"><i class="fa-solid fa-chalkboard fa-fw"></i> 課程管理</a>
                  </li>
                  <li class="h6"><a href="../coupons.php"><i class="fa-sharp fa-solid fa-tag fa-fw"></i> 優惠卷管理</a>
                  </li>
                  <hr style="border-top: 2px solid aliceblue;">
                  <li class="h6">
                    <a href="../order_file/order.php"
                      ><i class="fa-solid fa-note-sticky fa-fw"></i> 訂單管理</a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <!-- <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a> -->
              <!-- <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a> -->
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
          <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                <nav class="nav navbar-nav d-flex justify-content-end ">
                </div>
                <ul class=" navbar-right ">

                  <li class="nav-item dropdown open" style="padding-left: 15px">
                    <a
                      href="javascript:;"
                      class="user-profile dropdown-toggle"
                      aria-haspopup="true"
                      id="navbarDropdown"
                      data-toggle="dropdown"
                      aria-expanded="false"
                    >
                      <img src="../../logo4.png" alt="" />第四組
                    </a>
                    <a href="./login-sess.php"><i class="fa-solid fa-right-from-bracket py-2 px-1"></i></a>
                    <!-- <li class="nav-item dropdown open" style="padding-left: 15px;">
                      <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img src="../images/img.jpg" alt="">John Doe6
                      </a> -->
                      <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item"  href="login-sess.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                      </div>
                    </li>


                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>個人資料編輯</h3>
              </div>

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div> -->
            </div>


            <!-- <div class="clearfix"></div> -->

            <!-- 搜尋條 -->
            <div class="container">

        <?php if ($rowCount == 0): ?>
            使用者不存在
        <?php else:
    $row = $result->fetch_assoc();
    ?>
																																		<div class="container d-flex justify-content-start">
																																		    <div class="py-2 d-flex justify-content-start">
																																		        <a name="" id="" class="btn btn-secondary" href="user.php?id=<?=$row["id"]?>" role="button">
																																		            <i class="fa-solid fa-arrow-left"></i> 返回
																																		        </a>
																																		    </div>
																																		</div>

																																		<!-- 圖片上傳 -->
																																		<!-- <form action="upPicture.php" method="post" enctype="multipart/form-data"></form> -->
																																		<!-- <label for="" class="form-label">選擇圖片</label>
																																		<input type="file" class="form-control" name="pic"> -->

																																		<!--  -->
																																		<form action="upDateUser.php" method="post" enctype="multipart/form-data">
																																		    <input type="hidden" name="id" value="<?=$row["id"]?>">
																																		    <input type="hidden" name="Create_date" value="<?=$row["Create_date"]?>">
																																		    <table class="table table-bordered">
																																		        <div class="form-group">
																																		            <tr>

																																		                <td> <label for="" class="form-label">選擇圖片</label></td>
																																		                <td>

																																		                    <input type="hidden" class="form-control" name="img2" value="<?=$row["User_image"]?>">
																												                            <img src="./image_members/<?=$row["User_image"]?>" alt="">
																																		                    <input type="file" class="form-control" name="img" >

																																		                </td>
																																		            </tr>
																																		        </div>
																																		        <!-- <tr>
																																		            <td>ID</td>
																																		        </tr> -->
																																		        <tr>
																																		            <th>name</th>
																																		            <td><input type="text" class="form-control" name="name" value="<?=$row["User_name"]?>" required="required" maxlength="11" minlength="3"></td>
																																		        </tr>
																																		        <tr>
																																		            <td>Account</td>
																																		            <td><input type="text" class="form-control" name="account" value="<?=$row["Account"]?>" required="required" pattern="^(?=.*[a-zA-Z])(?=.*[0-9]).{4,}$"></td>
																																		        </tr>
																																		        <tr>
																																		            <td>Password</td>
																																		            <td><input type="password" class="form-control" name="password" value="<?=$row["Password"]?>" required="required"></td>
																																		        </tr>
																																		        <tr>
																																		            <th>gender</th>
																																		            <td>
																																		                <select id="gender" name="gender">
																																		                    <option value="M" name="M">Male</option>
																																		                    <option value="F" name="F">Female</option>
																																		                    <option value="Other" name="Other">Other</option>
																																		                </select>
																																		            </td>
																																		        </tr>
																																		        <tr>
																																		            <th>email</th>
																																		            <td><input type="email" class="form-control" name="email" value="<?=$row["Email"]?>"></td>
																																		        </tr>
																																		        <tr>
																																		            <th>phone</th>
																																		            <td><input type="number" class="form-control" name="phone" value="<?=$row["Phone"]?>" required="required"></td>
																																		        </tr>
																																		        <tr>
																																		            <th>birth</th>
																																		            <td><input type="date" class="form-control" name="birth" value="<?=$row["date_of_birth"]?>"></td>
																																		        </tr>
																																		    </table>
																																		    <div class="py-2">
																																		        <button type="submit" class="btn btn-info">
																																		            儲存
																																		        </button>
																																		    </div>
																																		</form>

																																		<?php endif;?>
</div>
    <?php
include "./js.php";
?>
        </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
   <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

      <?php
include "./js.php";
?>
  </body>
</html>