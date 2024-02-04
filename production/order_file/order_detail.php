<?php
session_start();
require_once "../../db_connect.php";

// $sql_ = "SELECT * FROM buy
// JOIN member ON buy.Member_ID = member.id
// JOIN buy_item ON buy.Order_ID = buy_item.Order_ID
// ORDER BY buy.Order_ID";
// $result_order = $conn->query($sql_order);
// $order_count = $result_order->num_rows;

$rowCount = 0; // 在條件外部定義 $rowCount 變量

if (isset($_POST['Order_ID'])) {
    $_SESSION['Order_ID'] = $_POST['Order_ID'];
} elseif (isset($_GET['Order_ID'])) {
    $_SESSION['Order_ID'] = $_GET['Order_ID'];
}

$orderID = isset($_SESSION['Order_ID']) ? $_SESSION['Order_ID'] : 0;

$orderID = isset($_SESSION['Order_ID']) ? $_SESSION['Order_ID'] : 0;
$orderString = "";
if (isset($_GET['sort'])) {
    switch ($_GET['sort']) {
        case 'total_price_asc':
            $orderString = "ORDER BY total_item_price ASC";
            break;
        case 'total_price_desc':
            $orderString = "ORDER BY total_item_price DESC";
            break;
        case 'quantity_asc':
            $orderString = "ORDER BY Quantity ASC";
            break;
        case 'quantity_desc':
            $orderString = "ORDER BY Quantity DESC";
            break;
        case 'stock_asc':
            $orderString = "ORDER BY stock_quantity ASC";
            break;
        case 'stock_desc':
            $orderString = "ORDER BY stock_quantity DESC";
            break;
    }
}

$sql_order_detail = "SELECT * FROM buy_item
    JOIN buy ON buy_item.Order_ID = buy.Order_ID
    WHERE buy_item.Order_ID = ?";

$sql_order_product = "SELECT * FROM buy_item
    JOIN product ON buy_item.Product_ID = product.id
    JOIN product_image ON buy_item.Product_ID = product_image.F_product_id AND product_image.sort_order = 0
    WHERE buy_item.Order_ID = ? $orderString";

$stmt = $conn->prepare($sql_order_detail);
if ($stmt === false) {
    die("準備 SQL 語句失敗：" . $conn->error);
}

$stmt->bind_param("i", $orderID);
if ($stmt->execute()) {
    $result = $stmt->get_result();
    $rowCount = $result->num_rows;

    if ($rowCount > 0) {
        $row = $result->fetch_assoc();

    }
}
$stmt->close();

$stmt_product = $conn->prepare($sql_order_product);
if ($stmt_product === false) {
    die("準備 SQL 語句失敗：" . $conn->error);
}

$stmt_product->bind_param("i", $orderID);
if ($stmt_product->execute()) {
    $result_product = $stmt_product->get_result();
    $order_product_count = $result_product->num_rows;

    if ($order_product_count > 0) {
        $products = $result_product->fetch_all(MYSQLI_ASSOC);

    }
}
$stmt_product->close();

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
    <!-- <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <link href="  ../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="  ../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="  ../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="  ../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->

    <link href="  ../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="  ../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="  ../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="  ../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="  ../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      .ovf_h{
        overflow-x: hidden;
      }
      .order_status{
        background: coral;
      }
      .status-訂單已完成 {
        background-color: #46A3FF; /* 新訂單的背景色 */
      }

      .status-付款完成 {
        background-color: #00CACA; /* 新訂單的背景色 */
      }
      .status-訂單處理中 {
        background-color: #F75000; /* 處理中訂單的背景色 */
      }

      .status-已出貨 {
        background-color: #019858; /* 已完成訂單的背景色 */
      }

      .status-已取消 .status-已退款 {
        background-color: #3C3C3C; /* 已取消訂單的背景色 */
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
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="HomePage.html" class="site_title"><img src="../../Logo_sm.png" alt="" style="height: 65px;"></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../../logo4.png" alt="..." class="img-circle profile_img" />
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
                  <!-- <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.html">Dashboard</a></li>
                      <li><a href="index2.html">Dashboard2</a></li>
                      <li><a href="index3.html">Dashboard3</a></li>
                    </ul>
                  </li> -->
                  <!-- <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="form.html">General Form</a></li>
                      <li><a href="form_advanced.html">Advanced Components</a></li>
                      <li><a href="form_validation.html">Form Validation</a></li>
                      <li><a href="form_wizards.html">Form Wizard</a></li>
                      <li><a href="form_upload.html">Form Upload</a></li>
                      <li><a href="form_buttons.html">Form Buttons</a></li>
                    </ul>
                  </li> -->
                  <!-- <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="general_elements.html">General Elements</a></li>
                      <li><a href="media_gallery.html">Media Gallery</a></li>
                      <li><a href="typography.html">Typography</a></li>
                      <li><a href="icons.html">Icons</a></li>
                      <li><a href="glyphicons.html">Glyphicons</a></li>
                      <li><a href="widgets.html">Widgets</a></li>
                      <li><a href="invoice.html">Invoice</a></li>
                      <li><a href="inbox.html">Inbox</a></li>
                      <li><a href="calendar.html">Calendar</a></li>
                    </ul>
                  </li> -->
                  <li class="h6"><a href="../member.php"><i class="fa-solid fa-user fa-fw"></i> 會員管理</a>
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
                    <a href="order.php"
                      ><i class="fa-solid fa-note-sticky fa-fw"></i> 訂單管理</a>
                  </li>
                  <!-- <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Chart JS</a></li>
                      <li><a href="chartjs2.html">Chart JS2</a></li>
                      <li><a href="morisjs.html">Moris JS</a></li>
                      <li><a href="echarts.html">ECharts</a></li>
                      <li><a href="other_charts.html">Other Charts</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                      <li><a href="fixed_footer.html">Fixed Footer</a></li>
                    </ul>
                  </li>
                </ul> -->
              </div>
              <!-- <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
              </div> -->

       </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!-- <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div> -->
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
                      <img src="../../logo4.png" alt="" />第四組
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
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
                <h3>Users <small>您好</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <!-- <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                  </div> -->
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>訂單詳情 <small>Orders detail</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a style="font-size: 16px" class="collapse-link text-secondary" href="order.php"><i class="fa fa fa-arrow-left"></i> 返回</a></li>
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="row">
                  <div class="col-sm-12">
                <div class="card-box table-responsive">
<?php if ($rowCount == 0): ?>
 使用者不存在
<?php else:

?>
                    <div class="ovf_h">
                      <div class="row py-2">
                          <div class="col">
                            <span class="order_status px-3 py-1 h6 rounded-pill text-white <?php echo 'status-' . strtolower($row["Status"]); ?>">
                              <?=$row["Status"]?>
                            </span>
                          </div>
                          <div class="col">
                                                    </div>
                          <div class="col">
                            <span class="h6 text-right d-block">訂單建立時間：<?=$row["Order_date"]?></span>
                          </div>
                          <!-- <div class="col"></div> -->
                      </div>
<div class="py-2">
                        <div class="d-flex justify-content-end">
                          <div class="dropdown">
                            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              選單
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <div class="text-center py-2"><a class="h6 text-info" href="order_detail.php?sort=quantity_asc">購買數量升序 <i class="fa-solid fa-arrow-down-short-wide fa-fw"></i></a></div>
                              <div class="text-center py-2 border-top"><a class="h6 text-info" href="order_detail.php?sort=quantity_desc">購買數量降序 <i class="fa-solid fa-arrow-down-wide-short fa-fw"></i></a></div>
                              <div class="text-center py-2 border-top"><a class="h6 text-info" href="order_detail.php?sort=total_price_asc">合計數量升序 <i class="fa-solid fa-arrow-down-short-wide fa-fw"></i></a></div>
                              <div class="text-center py-2 border-top"><a class="h6 text-info" href="order_detail.php?sort=total_price_desc">合計數量降序 <i class="fa-solid fa-arrow-down-wide-short fa-fw"></i></a></div>
                              <div class="text-center py-2 border-top"><a class="h6 text-info" href="order_detail.php?sort=stock_asc">剩餘庫存升序 <i class="fa-solid fa-arrow-down-short-wide fa-fw"></i></a></div>
                              <div class="text-center py-2 border-top"><a class="h6 text-info" href="order_detail.php?sort=stock_desc">剩餘庫存降序 <i class="fa-solid fa-arrow-down-wide-short fa-fw"></i></a></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="py-2">
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th class="d-none"></th>
                              <th style="width: 6vw;">商品ID</th>
                              <th style="width: 6vw;">商品圖片</th>
                              <th>商品名稱</th>
                              <th style="width: 7vw;">購買數量

                              </th>
                              <th style="width: 7vw;">合計金額

                              </th>
                              <th style="width: 7vw;">剩餘庫存

                              </th>
                            </tr>
                          </thead>
                          <tbody class="border border-secondary">
                              <?php if ($order_product_count > 0): ?>
                                  <?php foreach ($products as $product): ?>
                                      <tr>
                                          <td class="h6 text-center align-middle">#<?=htmlspecialchars($product["Product_ID"]);?></td>
                                          <td style="height: 15vh;">
                                              <img class="rounded-lg" src="../p_image/<?=htmlspecialchars($product["image_url"]);?>" alt="Product Image" style="height: 15vh;">
                                          </td>
                                          <td class="h6 align-middle align-middle"><?=htmlspecialchars($product["name"]);?></td>
                                          <td class="h6 align-middle align-middle"><?=htmlspecialchars($product["Quantity"]);?></td>
                                          <td class="h6 align-middle align-middle"><?=intval(htmlspecialchars($product["total_item_price"]));?></td>
                                          <td class="h6 align-middle align-middle"><?=htmlspecialchars($product["stock_quantity"]);?></td>
                                      </tr>
                                  <?php endforeach;?>
                              <?php endif;?>

                        </table>
                      </div>
                    </div>

<?php endif?>
                  </div>
                  </div>
              </div>
            </div>
                </div>
              </div>


                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
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
