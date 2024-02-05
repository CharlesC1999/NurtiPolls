<?php
if (!isset($_GET["Recipe_ID"])) {
    $Recipe_ID = 0;
} else {
    $Recipe_ID = $_GET["Recipe_ID"];
}
require_once "../db_connect.php";
// $id=$_GET["id"];

$sql = "SELECT recipe.*, recipe_categories.Recipe_cate_name AS category_name FROM recipe
JOIN recipe_categories ON recipe.Recipe_Category_ID = recipe_categories.Recipe_cate_ID
WHERE recipe.Recipe_ID = ? AND recipe_valid = 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $Recipe_ID);
$stmt->execute();
$result = $stmt->get_result();

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

  <title>營養大選 Nutripolls</title>
  <?php require_once "../css.php";?>
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
  <link rel="stylesheet" href="profile.css">
</head>

<body class="nav-md">
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">
            <i class="fa-solid fa-lightbulb"></i> 提示
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          確認刪除嗎?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
          <a class="btn btn-danger" role="btn" href="doDeleteRecipe.php?Recipe_ID=<?=$row["Recipe_ID"]?>">確定</a></button>
        </div>
      </div>
    </div>
  </div>



  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="HomePage.html" class="site_title"><img src="../Logo_sm.png" alt="" style="height: 65px;"></a>
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

              <li class="h6"><a href="member.php"><i class="fa-solid fa-user fa-fw"></i> 會員管理</a>
                  </li><li class="h6"><a href="product.php"><i class="fa-solid fa-store fa-fw"></i> 商品管理</a>
                  </li>
                  <li class="h6"><a><i class="fa-solid fa-hashtag fa-fw"></i> 分類管理<span class="fa fa-chevron-down"></span>
                  <ul class="nav child_menu">
                      <li><a href="categories_product.php" style="font-size: 16px;"> 商品</a></li>
                      <li><a href="categories_class.php" style="font-size: 16px;"> 課程</a></li>
                      <li><a href="categories_recipe.php" style="font-size: 16px;"> 食譜</a></li>

                    </ul>

                  </li>
                  <li class="h6"><a href="recipe-list.php"><i class="fa-solid fa-kitchen-set fa-fw"></i> 食譜管理</a>
                  </li>
                  <li class="h6"><a href="speaker.php"><i class="fa-solid fa-chalkboard-user fa-fw"></i> 講師管理</a>
                  </li>
                  <li class="h6"><a href="redirectClass.php"><i class="fa-solid fa-chalkboard fa-fw"></i> 課程管理</a>
                  </li>
                  <li class="h6"><a href="coupons.php"><i class="fa-sharp fa-solid fa-tag fa-fw"></i> 優惠卷管理</a>
                  </li>
                  <hr style="border-top: 2px solid aliceblue;">
                  <li class="h6">
                    <a href="order_file/order.php"
                      ><i class="fa-solid fa-note-sticky fa-fw"></i> 訂單管理</a>
                  </li>
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
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="../logo4.png" alt="" />第四組
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


          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="x_panel">
                <div class="x_title">


                  <div class="clearfix"></div>
                </div>
                <div class="container col-lg-6 col-md-8 col-sm-12">
                  <div class="py-2">
                    <a href="recipe-list.php" class="btn btn-secondary" role="button"><i class="fa-solid fa-mail-reply fa-fw"></i> 回食譜列表</a>
                  </div>
                  <?php if ($rowCount == 0): ?>
                    沒有食譜

                  <?php else:

?>
                    <input type="hidden" name="Recipe_ID" value="<?=$row["Recipe_ID"]?>">
                    <table class="table table-bordered ">

                      <tr>
                        <th class="col-2">食譜名稱</th>
                        <td>
                          <?=$row["Title_R_name"]?>
                        </td>
                      </tr>
                      <tr>
                        <th class="col-2">展示圖片</th>
                        <td>
                          <div class="col-lg-6 col-md-10 col-sm-12 ratio ratio-1x1">
                            <img class="object-fit-cover" src="rimages/<?=$row["Image_URL"]?>" alt="">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="col-2">簡介</th>
                        <td>
                          <?=$row["Content"]?>
                        </td>
                      </tr>
                      <tr>
                        <th class="col-2">建立日期</th>
                        <td>
                          <?=$row["Publish_date"]?>
                        </td>
                      </tr>
                      <tr>
                        <th class="col-2">分類</th>
                        <td>
                          <?=$row["category_name"]?>
                        </td>
                      </tr>
                    </table>
                    <div class="d-flex justify-content-between">
                      <a href="recipe-edit.php?Recipe_ID=<?=$row["Recipe_ID"]?>" role="button" class="btn btn-info"><i class="fa-solid fa-wand-magic-sparkles"></i> 修改</a>
                      <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </div>

                  <?php endif;?>

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
  <?php require_once "../js.php";?>
</body>

</html>