<?php
require_once("../db_connect_class.php");

if (!isset($_GET["Class_ID"])) {
  die("請循正常管道進入此頁");
}

$Class_ID = $_GET["Class_ID"];

//class detail
$sql = "SELECT class.*, speaker.Speaker_name, class_image.Image_URL, class_categories.Class_cate_name
 FROM class 
 JOIN speaker ON class.F_Speaker_ID = speaker.Speaker_ID
 JOIN class_image ON class.Class_ID = class_image.F_Class_ID
 JOIN class_categories ON class.Class_category_ID = class_categories.Class_cate_ID
 WHERE Class_ID = '$Class_ID'";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>營養大選NutriPolls | 新增課程</title>

  <!-- Bootstrap -->
  <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

  <!-- Bootstrap 5.3.2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
  <style>
    .form-content {
      width: 800px;
      margin-inline: auto;
    }

    .classDescription {
      width: 100%;
      height: 300px;
    }

    .classPic {
      width: 100%;
    }

    /* .fullPage {
      height: calc(100vh - 50px);
    } */
  </style>

</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><span>營養大選NutriPolls</span></a>
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
                <li><a href="tables_dynamic.php"><i class="fa fa-table"></i> 會員管理 <span class="fa fa-chevron-down"></span></a>
                </li>
                <li><a href="tables_dynamic.php"><i class="fa fa-table"></i>商品管理 <span class="fa fa-chevron-down"></span></a>
                </li>
                <li><a href="tables_dynamic.php"><i class="fa fa-table"></i>分類管理<span class="fa fa-chevron-down"></span></a>
                </li>
                <li><a href="tables_dynamic.php"><i class="fa fa-table"></i>食譜管理<span class="fa fa-chevron-down"></span></a>
                </li>
                <li><a href="tables_dynamic.php"><i class="fa fa-table"></i>講師管理<span class="fa fa-chevron-down"></span></a>
                </li>
                <li class="active"><a href=" class_new.php?Class_cate_ID=&status=1&min=0&max=99999"><i class="fa fa-table"></i> 課程管理 </a>
                  <!-- <ul class="nav child_menu">
                    <li class="<?php if ($Class_cate_ID == "") echo "active" ?>"><a href="class_new.php?Class_cate_ID=">所有類別</a></li>
                    <?php foreach ($rowsClassCategories as $rowClassCategories) : ?>
                      <li class="<?php if ($rowClassCategories["Class_cate_ID"] == $Class_cate_ID) echo "active" ?>"><a href="class_new.php?Class_cate_ID=<?= $rowClassCategories["Class_cate_ID"] ?>"><?= $rowClassCategories["Class_cate_name"] ?></a></li>
                    <?php endforeach; ?>
                  </ul> -->
                </li>
                <li><a href="tables_dynamic.php"><i class="fa fa-table"></i>優惠卷管理<span class="fa fa-chevron-down"></span></a>
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

            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col fullPage" role="main">
        <div class="row">
          <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">

                <div class="row align-items-center">
                  <div class="col-auto">
                    <h1>課程詳情 <!-- <small>Users</small> --> </h1>
                  </div>
                  <div class="col-auto">
                    <a name="" id="" class="btn btn-secondary" href="class_new.php?Class_cate_ID=&status=1&min=0&max=99999" role="button">所有課程</a>
                    <a name="" id="" class="btn btn-info text-light" href="classEdit.php?Class_ID=<?= $Class_ID ?>" role="button">編輯</a>
                  </div>
                </div>

                <div class="clearfix"></div>
              </div>

              <!-- class content -->
              <div class="form-content row g-3 ">
                <div class="col-2 mb-3">
                  <label for="classID" class="form-label">課程編號</label>
                  <input type="text" class="form-control" id="classID" name="classID" value="<?= $rows[0]["Class_ID"] ?>" readonly>
                </div>

                <div class="col-10 mb-3">
                  <label for="className" class="form-label">課程名稱</label>
                  <input type="text" class="form-control" id="className" name="className" value="<?= $rows[0]["Class_name"] ?>" readonly>
                </div>


                <div class="col-6 mb-3">
                  <!-- <label for="classCategory" class="form-label">課程類別</label>
                    <input type="text" class="form-control" id="classCategory" name="classCategory" required> -->
                  <label for="classCategory" class="form-label">課程類別</label>
                  <input type="text" class="form-control" id="classCategory" name="classCategory" value="<?= $rows[0]["Class_cate_name"] ?>" readonly>
                </div>

                <div class="col-6 mb-3">
                  <label for="speaker" class="form-label">講師名稱</label>
                  <input type="text" class="form-control" id="speaker" name="speaker" value="<?= $rows[0]["Speaker_name"] ?>" readonly>
                </div>

                <div class="col-6 mb-3">
                  <label for="classPrice" class="form-label">課程價格</label>
                  <input type="number" class="form-control " id="classPrice" name="classPrice" value="<?= $rows[0]["C_price"] ?>" readonly>
                </div>
                <div class="col-6 mb-3">
                  <label for="personLimit" class="form-label">名額限制</label>
                  <input type="number" class="form-control" id="personLimit" name="personLimit" value="<?= $rows[0]["Class_person_limit"] ?>" readonly>
                </div>

                <div class="col-4 mb-3">
                  <label for="startDate" class="form-label">報名起始</label>
                  <input type="text" class="form-control" id="startDate" name="startDate" value="<?= $rows[0]["Start_date"] ?>" readonly>
                </div>

                <div class="col-4 mb-3">
                  <label for="endDate" class="form-label">報名截止</label>
                  <input type="text" class="form-control" id="endDate" name="endDate" value="<?= $rows[0]["End_date"] ?>" readonly>
                </div>

                <div class="col-4 mb-3">
                  <label for="classDate" class="form-label">開課日期</label>
                  <input type="text" class="form-control" id="classDate" name="classDate" value="<?= $rows[0]["Class_date"] ?>" readonly>
                </div>

                <div class="col-12 mb-3">
                  <label for="classDescription" class="form-label">課程敘述</label>
                  <textarea class="classDescription" name="classDescription" id="classDescription" readonly><?= $rows[0]["Class_description"] ?></textarea>
                </div>

                <!-- <div class="col-2 mb-3">
                  <label for="classPic" class="form-label">課程圖片</label>
                </div> -->

                <?php foreach ($rows as $row) : ?>
                  <div class="col-6">
                    <img src="../classImg/<?= $row["Image_URL"] ?>" class="classPic" alt="">
                  </div>
                <?php endforeach; ?>
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


  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>