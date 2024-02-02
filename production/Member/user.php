<!-- wu 會員個人 ui頁面 -->
<?php
if (!isset($_GET["id"])) {
    $id = 0;
} else {
    $id = $_GET["id"];
}
require_once "../../db_connect.php";
$sql = "SELECT * FROM member WHERE id=$id AND  valid=1";
//
$result = $conn->query($sql);
$rowCount = $result->num_rows;

if ($rowCount != 0) {
    $row = $result->fetch_assoc();
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

    <title>DataTables | Gentelella</title>

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
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
            <a href="HomePage.php" class="site_title"
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
                  <li class="px-1">
                    <a href="Member/member.php"
                      ><i class="fa-solid fa-user"></i> 會員管理
                     </a>
                  </li>

                  <li  class="px-1">
                    <a href="product.php"
                      ><i class="fa-solid fa-store"></i> 商品管理
                     </a>

                  </li>
                  <li   class="px-1">
                    <a
                      ><i class="fa-solid fa-hashtag"></i> </i>分類管理<span
                        class="fa fa-chevron-down"
                      ></span>
                      <ul class="nav child_menu">
                        <li><a href="categories_product.php">商品</a></li>
                        <li><a href="categories_class.php">課程</a></li>
                        <li><a href="categories_recipe.php">食譜</a></li>
                      </ul>
                    </a>
                  </li>
                  <li class="px-1">
                    <a href="recipe-list.php"
                      ><i class="fa-solid fa-kitchen-set"></i> 食譜管理</a>
                  </li>
                  <li  class="px-1">
                    <a href="speaker.php"
                      ><i class="fa-solid fa-chalkboard-user"></i> 講師管理</a>
                  </li>
                  <li>
                    <a href="redirectClass.php"
                      ><i class="fa-solid fa-chalkboard"></i> 課程管理</a>
                  </li>
                  <li class="px-1">
                    <a href="coupons.php"
                      ><i class="fa-sharp fa-solid fa-tag"></i> 優惠卷管理</a>
                  </li>
                  <hr style="border-top: 2px solid aliceblue" />
                  <li   class="px-1">
                    <a href="./order_file/order.php"
                      ><i class="fa-solid fa-note-sticky"></i> 訂單管理</a>
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
                </div>
                <nav class="nav navbar-nav">
              <ul class="navbar-right">
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
                  <div
                    class="dropdown-menu dropdown-usermenu pull-right"
                    aria-labelledby="navbarDropdown"
                  >
                    <a class="dropdown-item" href="javascript:;"> Profile</a>
                    <a class="dropdown-item" href="javascript:;">
                      <!-- <span class="badge bg-red pull-right">50%</span> -->
                      <span>Settings</span>
                    </a>
                    <a class="dropdown-item" href="javascript:;">Help</a>
                    <a class="dropdown-item" href="login.html"
                      ><i class="fa fa-sign-out pull-right"></i> Log Out</a
                    >
                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                  <ul
                    class="dropdown-menu list-unstyled msg_list"
                    role="menu"
                    aria-labelledby="navbarDropdown1"
                  >
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"
                          ><img src="images/img.jpg" alt="Profile Image"
                        /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie
                          makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"
                          ><img src="images/img.jpg" alt="Profile Image"
                        /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie
                          makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"
                          ><img src="images/img.jpg" alt="Profile Image"
                        /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie
                          makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"
                          ><img src="images/img.jpg" alt="Profile Image"
                        /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie
                          makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <div class="text-center">
                        <a class="dropdown-item">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
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
                <h3>個人資料</h3>
              </div>
              <!-- <div class="title_right d-flex justify-content-end">
              <a
                    name=""
                    id=""
                    class="btn btn-secondary "
                    href="member.php"
                    role="button"
                    > <i class="fa-solid fa-arrow-left"></i> 回使用者列表</a
                >
              </div> -->
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
            <div class="modal fade" id="confirmModal" tabindex="-1"  aria-hidden="true">
                    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">刪除使用者</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        確認刪除?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
        <a role="button" class="btn btn-danger"
        href="userDelete.php?id=<?=$row["id"]?>"
        >確認</a>
		<!-- 連結到 doDeleteUser並做軟刪除-->
      </div>
    </div>
  </div>
</div>



        <div class="container">


            </div>
        <?php if ($rowCount == 0): ?>
            使用者不存在
            <?php else:

?>


            <!-- 使用者照片 -->
            <div class="container d-flex justify-content-start">
            <div class="py-2 ">
            <a
                    name=""
                    id=""
                    class="btn btn-secondary "
                    href="member.php"
                    role="button"
                    > <i class="fa-solid fa-arrow-left"></i> 回使用者列表</a
                >
            </div>
            </div>
            <table class="table table-bordered">
                 <tr>
                    <td>使用者照片</td>
                    <td><img src="./image_members/<?=$row["User_image"]?>" alt=""></td>
                </tr>
                <tr>
                 <td>ID</td>
                 <td><?=$row["id"]?></td>
                 </tr>
                <tr>
                    <td>Name</td>
                 <td><?=$row["User_name"]?></td>
                 </tr>
                 <tr>
                    <td>Account</td>
                 <td><?=$row["Account"]?></td>
                 </tr>
                 <tr>
                    <td>Password</td>
                 <td><?=$row["Password"]?></td>
                 </tr>
                <tr>
                    <td>gender</td>
                 <td><?=$row["Gender"]?></td>
                 </tr>
                <!-- <tr>
                <td>Account</td>
                 <td>?=$row["Account"]?</td>
                 </tr>
                <tr>
                <td>Password</td>
                 <td>?=$row["Password"]?</td>
                 </tr> -->
                <tr>
                <td>Email</td>
                 <td><?=$row["Email"]?></td>
                 </tr>
                <tr>
                <td>Phone</td>
                 <td><?=$row["Phone"]?></td>
                 </tr>
                <tr>
                <td>birth</td>
                 <td><?=$row["date_of_birth"]?></td>
                 </tr>
                 <tr>
                <td>Create time</td>
                 <td><?=$row["Create_date"]?></td>
                 </tr>
            </table>
            <div class="d-flex justify-content-between">

            <!-- 修改鍵 -->
                <a
                    name=""
                    id=""
                    class="btn btn-outline-secondary"
                    href="user-edit.php?id=<?=$row["id"]?>"
                    role="button"
                    ><i class="fa-solid fa-user-pen"></i></a>

                    <!-- 刪除 -->
                    <button
                    data-bs-toggle="modal"
                    data-bs-target="#confirmModal"
                    class="btn btn-danger"
                    href="userDelete.php?id=<?=$row["id"]?>"
                    role="button"
                    ><i class="fa-solid fa-trash-can"></i></button>
            </div>
            <?php endif;?>
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