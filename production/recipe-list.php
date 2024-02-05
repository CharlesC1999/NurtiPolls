<?php
require_once "../db_connect.php";

$sqlCategory = "SELECT * FROM recipe_categories";
$resultCategory = $conn->query($sqlCategory);
$rowsCategory = $resultCategory->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT recipe.*,recipe_categories.Recipe_cate_name AS category_name FROM recipe
JOIN recipe_categories ON recipe.Recipe_Category_ID = recipe_categories.Recipe_cate_ID
 WHERE recipe_valid = 1 ORDER BY Recipe_ID ASC";

if (isset($_GET["cate"])) {
  $cate = $_GET["cate"];
  $sql = "SELECT  recipe.*,recipe_categories.Recipe_cate_name AS category_name FROM recipe
    JOIN recipe_categories ON recipe.Recipe_Category_ID = recipe_categories.Recipe_cate_ID
    WHERE recipe.Recipe_Category_ID = $cate AND recipe_valid = 1
    ORDER BY Recipe_ID ASC";
}

$result = $conn->query($sql);

$recipeCount = $result->num_rows;

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
  <?php require_once "../css.php"; ?>
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

  <?php
  $categories = [];
  foreach ($rowsCategory as $cate) {
    $categories[$cate["Recipe_cate_ID"]] = $cate["Recipe_cate_name"];
  }
  //print_r($categories);
  ?>






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

                <li class="h6"><a href="Member/member.php"><i class="fa-solid fa-user fa-fw"></i> 會員管理</a>
                </li>
                <li class="h6"><a href="product.php"><i class="fa-solid fa-store fa-fw"></i> 商品管理</a>
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
                  <a href="order_file/order.php"><i class="fa-solid fa-note-sticky fa-fw"></i> 訂單管理</a>
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
                  <a class="dropdown-item" href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
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

          </div>

          <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

            </div>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
          <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2>食譜管理</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <!-- <button class="btn btn-primary">新增</button> -->
                  <a href="add-recipe.php" role="button" class="btn btn-info"><i class="fa-solid fa-plus"></i>新增</a>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card-box table-responsive">
                      <p class="text-muted font-13 m-b-30">
                        共
                        <?= $recipeCount ?>份
                      </p>
                      <div class="mb-2">
                        <ul class="nav nav-tabs">
                          <li class="nav-item">
                            <a class="nav-link text-secondary <?php if (!isset($_GET["cate"])) {
                                                                echo "active text-info";
                                                              }
                                                              ?>" aria-current="page" href="recipe-list.php">全部</a>
                          </li>
                          <?php foreach ($rowsCategory as $category) : ?>
                            <li class="nav-item">
                              <a class="nav-link text-secondary <?php
                                                                if (isset($_GET["cate"]) && $_GET["cate"] == $category["Recipe_cate_ID"]) {
                                                                  echo "active text-info";
                                                                }

                                                                ?>" aria-current="page" href="recipe-list.php?cate=<?= $category["Recipe_cate_ID"] ?>">
                                <?= $category["Recipe_cate_name"] ?>
                              </a>
                            <?php endforeach; ?>
                            </li>
                        </ul>
                      </div>
                      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>食譜名稱</th>
                            <th>展示圖片</th>
                            <th>簡介</th>
                            <th style="width: 6vw">建立日期</th>
                            <th>分類</th>
                            <th></th>



                          </tr>
                        </thead>


                        <tbody>
                          <?php
                          $rows = $result->fetch_all(MYSQLI_ASSOC);
                          foreach ($rows as $recipe) :
                          ?>
                            <tr>
                              <td class="h6">
                                <?= $recipe["Title_R_name"] ?>
                              </td>
                              <td class="h6">
                                <div class="ratio ratio-1x1">
                                  <img class="object-fit-cover" src="rimages/<?= $recipe["Image_URL"] ?>" alt="<?= $recipe["Title_R_name"] ?>">
                                </div>
                              </td>
                              <td class="h6">
                                <?= $recipe["Content"] ?>
                              </td>
                              <td class="h6" style="width: 6vw">
                                <?= $recipe["Publish_date"] ?>
                              </td>
                              <td class="h6">
                                <?= $recipe["category_name"] ?>
                              </td>
                              <td>
                                <a role="button" class="btn btn-outline-secondary" href="recipe.php?Recipe_ID=<?= $recipe["Recipe_ID"] ?>">
                                  <i class="fa-solid fa-eye"></i>
                                </a>
                                <a role="button" class="btn btn-outline-info" href="recipe-edit.php?Recipe_ID=<?= $recipe["Recipe_ID"] ?>">
                                  <i class="fa-solid fa-pencil"></i>
                                </a>
                                <!-- <a href="doDeleteRecipe.php?Recipe_ID=
                                 $recipe["Recipe_ID"]?>
                            ">
                              <i class="fa-solid fa-trash"></i>
                            </a> -->


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
  <?php require_once "../js.php"; ?>
</body>

</html>