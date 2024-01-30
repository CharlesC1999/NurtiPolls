<?php
require_once("../db-connect.php");
if (!isset($_GET["id"])) {
  $id = 0;
  echo "請由正常管道進入";
} else {
  $id = $_GET["id"];
}

// http://localhost/小專/production/speaker.php?id=5 (id=後面可以帶參數)
$sql = "SELECT * FROM speaker WHERE Speaker_ID=$id";
$result = $conn->query($sql);

//確定只有一筆資料(可使用fetch_assoc() 一維陣列)
$row = $result->fetch_assoc();

$rowCount = $result->num_rows; //result裡面有幾筆(num_rows)


?>
<!DOCTYPE html>
<html lang="en">

<head>

  </style>
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

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />


  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
  <!-- icon連結 https://cdnjs.com/libraries/font-awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .object-fit-cover {
      width: 100%;
      height: 100%;
      border: 2px solid #aaa;
      border-radius: 5%;
    }

    .box1 {
      width: 18rem;
      height: 22rem;
     
    }

    .card {
      width: 18rem;
      height: 22rem;
      overflow-y: overlay;
    }

    .frame {
      padding-top: 100px;
    }
  </style>

</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>營養大選 Nutripoll</span></a>
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
                <li><a href="tables_dynamic.html"><i class="fa fa-table"></i> 會員管理 <span class="fa fa-chevron-down"></span></a>
                </li>
                <li><a href="product.php"><i class="fa fa-table"></i>商品管理 <span class="fa fa-chevron-down"></span></a>
                </li>
                <li><a><i class="fa fa-table"></i>分類管理<span class="fa fa-chevron-down"></span>
                    <ul class="nav child_menu">
                      <li><a href="categories_product.php">商品</a></li>
                      <li><a href="categories_product.php">課程</a></li>
                      <li><a href="categories_product.php">食譜</a></li>
                    </ul>
                  </a>
                </li>
                <li><a href="tables_dynamic.html"><i class="fa fa-table"></i>食譜管理<span class="fa fa-chevron-down"></span></a>
                </li>
                <li><a href="speaker.php"><i class="fa fa-table"></i>講師管理<span class="fa fa-chevron-down"></span></a>
                </li>
                <li><a href="tables_dynamic.html"><i class="fa fa-table"></i>課程管理<span class="fa fa-chevron-down"></span></a>
                </li>
                <li><a href="tables_dynamic.html"><i class="fa fa-table"></i>優惠卷管理<span class="fa fa-chevron-down"></span></a>
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
        <div class="container">
          <form action="do_update_Speaker.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $row["Speaker_ID"] ?>">
            <div class="row justify-content-center frame">
              <div class="h2 text-center">修改教師 <?= $row["Speaker_name"] ?> 個人資訊</div>
              <div class="box1">
                <!-- 把原本的圖片資訊存在 hidden 裡，post 之後用來判斷是否要替換圖片 -->
                <input type="hidden" name="old_img" value="<?= $row["Image"] ?>">
                <!-- 建立一個img(output)作為縮圖的容器，設定好id並以display:none隱藏起來 並做js事件onchange當檔案值做變化時 -->
                <img id="output" style="display:none" class="rounded mx-auto d-block object-fit-cover" src="Speaker_pic/<?= $row["Image"] ?>" alt="Speaker_pic/<?= $row["Image"] ?>">
              </div>
              <div class="card">
                <div class="card-body">
                  <label for="" class="form-label">姓名 :</label>
                  <input type="text" class="form-control" value="<?= $row["Speaker_name"] ?>" name="name">
                  <p class="">
                    <label for="" class="form-label">個人簡介 :</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="description"><?= $row["Speaker_description"] ?></textarea>
                  </p>
                </div>
              </div>
            </div>
            <!-- d-flex justify-content-between -->
            <div class="container d-flex justify-content-center py-3">
              <div class="px-3"><input type="file" class="form-control " name="file" onchange="openFile(event)"></div>
              <a name="" id="" class="btn btn-outline-secondary " href="speaker.php" role="button">返回列表</a>
              <div class="px-3"><button class="btn btn-outline-secondary " type="submit">確定修改</button></div>
            </div>
          </form>
        </div>
        <script>
          function openFile(event) {
            var input = event.target; //取得上傳檔案
            var reader = new FileReader(); //建立FileReader物件

            reader.readAsDataURL(input.files[0]); //以.readAsDataURL將上傳檔案轉換為base64字串

            reader.onload = function() { //FileReader取得上傳檔案後執行以下內容
              var dataURL = reader.result; //設定變數dataURL為上傳圖檔的base64字串
              $('#output').attr('src', dataURL).show(); //將img的src設定為dataURL並顯示
            };
          }
        </script>


      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  <script>
    // https://datatables.net/examples/basic_init/filter_only.html
    //     new DataTable('#datatable', {
    //       info: false,
    //       ordering: false,
    //       paging: false
    // });
  </script>
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