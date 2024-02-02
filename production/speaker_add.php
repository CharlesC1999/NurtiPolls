<?php
require_once "../db_connect.php";
// session_start();

$sql = "SELECT * FROM speaker ORDER BY Speaker_ID DESC"; //->DESC降冪(最新在前面)
$result = $conn->query($sql); //吐出資料
$rows = $result->fetch_all(MYSQLI_ASSOC); //轉換關聯式陣列

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

    .box1 {
      width: 300px;
      height: 500px;
    }

    .box2 {
      width: 275px;
      height: 250px;

    }

    .object-fit-cover {
      width: 100%;
      height: 100%;
      overflow: hidden;
    }

    .btn-info {
      background-color: #17a2b8;
      border: 1px solid #17a2b8;
    }

    .btn-info:hover {
      background-color: #128395;
      border: 1px solid #17a2b8;
    }
  </style>

</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0">
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
        <div class="container">
          <div class="row justify-content-center ">
            <h2 class="text-center">新增教師</h2>
            <div class="box1">
              <!-- 上傳檔案去doAddSpeaker.php做處理 -->
              <!-- 傳檔案一定要加 enctype="multipart/form-data"以便正確解析和保存上傳的文件 -->
              <form action="do_add_Speaker.php" method="post" enctype="multipart/form-data">
                <div class="mb-2">
                  <label for="" class="form-label">姓名 :</label>
                  <input type="text" class="form-control" name="name" id="name" required="required" oninput="setCustomValidity('');" oninvalid="setCustomValidity('請輸入姓名');">
                </div>
                <div class="mb-2">
                  <label for="" class="form-label">個人簡介 :</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="description" required="required" oninput="setCustomValidity('');" oninvalid="setCustomValidity('請輸入簡介');"></textarea>
                </div>

                <!-- 記得type="file" (選擇檔案) -->
                <div class="mb-2 py-2">
                  <label for="" class="form-label">預覽圖片 :</label>
                  <!-- 建立一個img(output)作為縮圖的容器，設定好id並以display:none隱藏起來 並做js事件onchange當檔案值做變化時 -->
                  <div class="box2">
                    <img id="output" src="Speaker_pic/speaker.jfif" height="200" style="display:none" class="rounded mx-auto d-block object-fit-cover">
                  </div>
                  <div class="pt-3">
                    <input type="file" class="form-control " name="pic" onchange="openFile(event)">
                  </div>
                </div>
                <!-- d-grid gap-2 d-md-flex justify-content-md-end py-2 同靠右邊-->
                <div class="d-flex justify-content-between align-items-center py-2">
                  <a name="" id="" class="btn btn-secondary" href="speaker.php" role="button"><i class="fa-solid fa-chevron-left"></i>返回教師列表</a>
                  <button class="btn btn-info text-white" type="submit" id="send">確定新增</button>
                </div>
              </form>
            </div>
          </div>
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

        <!-- 放錯誤訊息 (先判斷存不存在) 存在->顯示完->清除
                <?php if (isset($_SESSION["error"]["message"])) : ?>
                <div class="py-2">
                    <div>
                        <div class="text-danger"><?= $_SESSION["error"]["message"] ?></div>
                    </div>
                </div>
                <?php endif;
                unset($_SESSION["error"]["message"]); //做清除
                ?> -->



        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <!-- 讀取jquery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


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