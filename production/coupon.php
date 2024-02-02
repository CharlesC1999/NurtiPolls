<?php
if (!isset($_GET["Coupon_ID"])) {
    $Coupon_ID = 0;
} else {
    $Coupon_ID = $_GET["Coupon_ID"];
}


require_once("../db_connect.php");
$sql = "SELECT * from coupons WHERE Coupon_ID = $Coupon_ID";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
$discount_type = $row["Discount_type"];

// GROUP_CONCAT 函數用來將多個分類名稱合併為一個字串，並以逗號分隔
// c,cc,pc為自定義的資料表別名
$sqlcc = "SELECT c.coupon_id, GROUP_CONCAT(pc.Product_cate_name SEPARATOR ', ') as categories
FROM coupons c
JOIN coupon_categories cc ON c.Coupon_ID = cc.coupon_id
JOIN product_categories pc ON cc.category_id = pc.Product_cate_ID
WHERE c.Coupon_ID = $Coupon_ID
GROUP BY c.Coupon_ID;";

$resultcc = $conn->query($sqlcc);
$rowcc = $resultcc->fetch_assoc();

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

    <title>coupon-edit</title>
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
        .img-circle.profile_img {
            background: #ddd;
        }

        .profile_info span {
            font-size: 14px;
            line-height: 30px;
            font-weight: 500;
            color: #ecf0f1;
        }

        .profile_info h2 {
            font-size: 14px;
            color: #ecf0f1;
            margin: 0;
            font-weight: 500;
        }

        .side-menu {
            font-size: 15px;
        }
    </style>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="../logo4.png" alt="..." class="img-circle profile_img" />
                        </div>
                        <div class="profile_info">
                            <span>Hi,</span>
                            <h2>第四組</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">

                            <ul class="nav side-menu">
                                <li class="px-1">
                                    <a href="Member/member.php"><i class="fa-solid fa-user"></i> 會員管理
                                    </a>
                                </li>
                                <li class="px-1">
                                    <a href="product.php"><i class="fa-solid fa-store"></i> 商品管理
                                    </a>
                                </li>
                                <li class="px-1">
                                    <a><i class="fa-solid fa-hashtag"></i> </i>分類管理<span class="fa fa-chevron-down"></span>
                                        <ul class="nav child_menu">
                                            <li><a href="categories_product.php">商品</a></li>
                                            <li><a href="categories_class.php">課程</a></li>
                                            <li><a href="categories_recipe.php">食譜</a></li>
                                        </ul>
                                    </a>
                                </li>
                                <li class="px-1">
                                    <a href="recipe-list.php"><i class="fa-solid fa-kitchen-set"></i> 食譜管理</a>
                                </li>
                                <li class="px-1">
                                    <a href="speaker.php"><i class="fa-solid fa-chalkboard-user"></i> 講師管理</a>
                                </li>
                                <li>
                                    <a href="redirectClass.php"><i class="fa-solid fa-chalkboard"></i> 課程管理</a>
                                </li>
                                <li class="px-1">
                                    <a href="coupons.php"><i class="fa-sharp fa-solid fa-tag"></i> 優惠卷管理</a>
                                </li>
                                <hr style="border-top: 2px solid aliceblue" />
                                <li class="px-1">
                                    <a href="./order_file/order.php"><i class="fa-solid fa-note-sticky"></i> 訂單管理</a>
                                </li>
                            </ul>
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
                        <li class="nav-item dropdown open" style="padding-left: 15px">
                  <a
                    href="javascript:;"
                    class="user-profile dropdown-toggle"
                    aria-haspopup="true"
                    id="navbarDropdown"
                    data-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <img src="../logo4.png" alt="" />第四組
                  </a>
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
                <div class="container">
                    <div class="py-3">
                        <a type="submit" class="btn btn-secondary" href="coupons.php" role="button"><i class="fa-solid fa-chevron-left"></i>返回列表</a>
                    </div>
                    <h1 class="my-3 h3">優惠券詳情</h1>
                    <input type="hidden" name="id" value="<?= $row["Coupon_ID"] ?>">
                    <form action="updateCoupon.php" method="post">
                        <table>
                            <tr>
                                <th>優惠券編號</th>
                                <td class="p-3">
                                    <?= $row["Coupon_ID"] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>優惠券名稱</th>
                                <td class="p-3">
                                    <?= $row["C_name"] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>優惠券代碼</th>
                                <td class="p-3">
                                    <?= $row["C_code"] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>優惠券使用時間</th>
                                <td class="p-3">
                                    <div class="row">
                                        <div class="col-auto">
                                            <?= $row["Valid_start_date"] ?>
                                        </div>
                                        <div class="col-auto">~</div>
                                        <div class="col-auto">
                                            <?= $row["Valid_end_date"] ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>折扣方式</th>
                                <td class="p-3">
                                    <?= $row["Discount_type"] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>優惠券面額</th>
                                <td class="p-3">
                                    <?= $row["Discount_amount"] ?>
                                </td>
                            </tr>
                            <!-- 若未填寫商品分類，則優惠券預設為適用全站商品 -->
                            <tr>
                                <th>優惠券適用範圍</th>
                                <td class="p-3">
                                    <?php
                                    // 檢查 categories 是否有值
                                    if (!empty($rowcc["categories"])) {
                                        echo $rowcc["categories"];
                                    } else {
                                        // 如果 categories 為空或不存在，則顯示 "適用於全站商品"
                                        echo "適用於全站商品";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>最低消費金額</th>
                                <td class="p-3">
                                    <?= $row["minimum_spend"] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>優惠說明</th>
                                <td class="p-3">
                                    <?= $row["Coupon_description"] ?>
                                </td>
                            </tr>



                        </table>

                    </form>
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
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>