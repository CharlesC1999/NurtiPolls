<?php
require_once "../db_connect.php";
$todayDate = date('Y-m-d');
$sqlFilter = "";

if (isset($_GET["status"])) {
  if ($_GET["status"] == "all") {
    // 顯示所有資料
    $sqlFilter = "";
  } elseif ($_GET["status"] == "upcoming") {
    // 未開始
    $sqlFilter = " AND Valid_start_date > '$todayDate'";
  } elseif ($_GET["status"] == "ongoing") {
    // 進行中
    $sqlFilter = " AND Valid_start_date <= '$todayDate' AND Valid_end_date >= '$todayDate'";
  } elseif ($_GET["status"] == "expired") {
    // 已結束
    $sqlFilter = " AND Valid_end_date < '$todayDate'";
  }
}

$sqlAll = "SELECT * FROM coupons WHERE valid=1 $sqlFilter";
$resultAll = $conn->query($sqlAll);

$sql = "SELECT * FROM coupons WHERE valid=1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!isset($_GET["Coupon_ID"])) {
  $Coupon_ID = 0;
} else {
  $Coupon_ID = $_GET["Coupon_ID"];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>營養大選 Nutripoll</title>
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
  <style>
    /* 自定義按鈕基礎樣式 */
    .custom-btn {
      color: #333;
      /* 文字顏色 */
      border-bottom: 5px solid transparent;
      /* 邊框顏色 */
    }

    /* 活躍狀態的按鈕樣式 */
    .custom-btn.active {
      color: #17a2b8;
      /* 活躍狀態的文字顏色 */
      border-bottom: 5px solid #17a2b8;
      /* 活躍狀態的邊框顏色 */
    }
  </style>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="HomePage.html" class="site_title"><i class="fa fa-paw"></i> <span>營養大選 Nutripoll</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2>John Doe</h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">

                <li><a href="member.php"><i class="fa fa-table"></i> 會員管理 <span class="fa fa-chevron-down"></span></a>
                </li>
                <li><a href="product.php"><i class="fa fa-table"></i>商品管理 <span class="fa fa-chevron-down"></span></a>
                </li>
                <li><a><i class="fa fa-table"></i>分類管理<span class="fa fa-chevron-down"></span>
                    <ul class="nav child_menu">
                      <li><a href="categories_product.php" style="font-size: 16px;">商品</a></li>
                      <li><a href="categories_class.php" style="font-size: 16px;">課程</a></li>
                      <li><a href="categories_recipe.php" style="font-size: 16px;">食譜</a></li>
                    </ul>
                </li>
                <li><a href="recipe-list.php"><i class="fa fa-table"></i>食譜管理<span class="fa fa-chevron-down"></span></a>
                </li>
                <li><a href="speaker.php"><i class="fa fa-table"></i>講師管理<span class="fa fa-chevron-down"></span></a>
                </li>
                <li><a href="redirectClass.php"><i class="fa fa-table"></i>課程管理<span class="fa fa-chevron-down"></span></a>
                </li>
                <li><a href="coupons.php"><i class="fa fa-table"></i>優惠卷管理<span class="fa fa-chevron-down"></span></a>
                </li>

            </div>


          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">

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
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <img src="images/img.jpg" alt="">John Doe
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="javascript:;"> Profile</a>
                  <a class="dropdown-item" href="javascript:;">
                    <span class="badge bg-red pull-right">50%</span>
                    <span>Settings</span>
                  </a>
                  <a class="dropdown-item" href="javascript:;">Help</a>
                  <a class="dropdown-item" href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                </div>
              </li>

              <li role="presentation" class="nav-item dropdown open">
                <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <span class="badge bg-green">6</span>
                </a>
                <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                  <li class="nav-item">
                    <a class="dropdown-item">
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="dropdown-item">
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="dropdown-item">
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="dropdown-item">
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
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

              <h3>我的優惠券</h3>
              <a href="add-coupon.php" class="btn btn-info my-3">新增優惠券</a>

            </div>
          
          </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
          <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <?php
              // 確定當前篩選狀態
              $status = isset($_GET['status']) ? $_GET['status'] : 'all';
              ?>
              <div class="filter-buttons x_title">
                <a href="?status=all" class="btn custom-btn <?php if ($status == 'all') {
                                                              echo 'active';
                                                            }
                                                            ?>">全部</a>
                <a href="?status=ongoing" class="btn custom-btn <?php if ($status == 'ongoing') {
                                                                  echo 'active';
                                                                }
                                                                ?>">進行中的活動</a>
                <a href="?status=upcoming" class="btn custom-btn <?php if ($status == 'upcoming') {
                                                                    echo 'active';
                                                                  }
                                                                  ?>">接下來的活動</a>
                <a href="?status=expired" class="btn custom-btn <?php if ($status == 'expired') {
                                                                  echo 'active';
                                                                }
                                                                ?>">已結束</a>
              </div>



              <div class="x_content">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card-box table-responsive">

                      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>編號</th>
                            <th>優惠券名稱</th>
                            <th>優惠券代碼</th>
                            <th>優惠券種類</th>
                            <th>折扣額度</th>
                            <th>開始日期</th>
                            <th>結束日期</th>
                            <th>操作</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $rows = $resultAll->fetch_all(MYSQLI_ASSOC);
                          foreach ($rows as $coupon) :
                          ?>
                            <tr>
                              <td><?= $coupon["Coupon_ID"] ?></td>
                              <td><?= $coupon["C_name"] ?></td>
                              <td><?= $coupon["C_code"] ?></td>
                              <td><?= $coupon["Discount_type"] ?></td>
                              <td>
                                <?= $coupon["Discount_amount"] ?></td>
                              <td><?= $coupon["Valid_start_date"] ?></td>
                              <td><?= $coupon["Valid_end_date"] ?></td>
                              <td>
                                <a name="" id="" href="coupon-edit.php?Coupon_ID=<?= $coupon["Coupon_ID"] ?>" role="button" class="btn btn-outline-dark mr-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a name="" id="" href="coupon.php?Coupon_ID=<?= $coupon["Coupon_ID"] ?>" role="button" class="btn btn-outline-info"><i class="fa-solid fa-eye"></i></a>
                              </td>

                            </tr>

                          <?php endforeach; ?>


                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>

      <!-- /page content -->


      <!-- /footer content -->
    </div>
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

</body>

</html>