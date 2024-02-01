<?php
require_once "../db_connect.php";

$perPage = 10; //預設10筆,寫成變數之後好改顯示筆數

$sqlAll = "SELECT * FROM speaker WHERE valid=1"; //SELECT * FROM 讀取資料

$resultAll = $conn->query($sqlAll); //吐出資料
$speakerToCount = $resultAll->num_rows; //總共筆數


//總共需要多少頁(下面用迴圈跑掉) celi無條件進位 筆數/頁數
$pageCount = ceil($speakerToCount / $perPage);

//判斷排序 丟給 搜尋處理( sql語法 要丟 $orderString進去)
if(isset($_GET["order"])){
  $order=$_GET["order"];
  
  if($order==1){
      $orderString="ORDER BY Speaker_ID ASC";
  }elseif($order==2){
      $orderString="ORDER BY Speaker_ID DESC";
  }
  elseif($order==3){
      $orderString="ORDER BY Speaker_name ASC";
  }
  elseif($order==4){
      $orderString="ORDER BY Speaker_name DESC";
  }
}

//判斷如果是搜尋 or 頁數 or 在預設值 (做的事情 -> 判斷完吐資料)
if (isset($_GET["search"])) {
  $search = $_GET["search"];
  //記得加入 valid=1 (否則軟刪除也會顯示出來)
  $sql = "SELECT * FROM speaker WHERE Speaker_name LIKE '%$search%' AND valid=1";
}
//elseif 判斷分頁頁面,從0開始,顯示幾筆 ($stratIndex,$perPage)
elseif (isset($_GET["p"])) {
  $p = $_GET["p"];
  $startIndex = ($p - 1) * $perPage; // (1-1)*10 = 0 從0後面開始 10筆
  // (2-1)*10 = 10 從10後面開始 10筆
  $sql = "SELECT * FROM speaker WHERE valid=1 $orderString LIMIT $startIndex, $perPage";
} else {
  $p = 1; //預設第一頁

  $order=1;
  $orderString="ORDER BY Speaker_ID DESC";  //預設直 (降冪[可以直接看由新到舊 -> ID排序])

  //SELECT * FROM 讀取資料
  $sql = "SELECT * FROM speaker WHERE valid=1 $orderString LIMIT $perPage";
}

$result = $conn->query($sql); //if判斷完 -> 吐資料 -> 升冪降冪





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

  <title>營養大選 Nutripoll</title>
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
                  </li><li><a href="product.php"><i class="fa fa-table"></i>商品管理 <span class="fa fa-chevron-down"></span></a>
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
              <h3>Gentelella <small>Alela!</small></h3>
            </div>


            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <form action="">
                  <div class="input-group">
                    <!-- 判斷是否有搜尋,有的話[返回箭頭icon] -->
                    <?php if (isset($_GET["search"])) : ?>
                      <a name="" id="" class="btn btn-secondary" href="speaker.php" role="button"><i class="fa-solid fa-arrow-left fa-fw"></i></a>
                    <?php endif; ?>

                    <!-- input的type="search" name="search" -->
                    <!-- button的type="submit" -->
                    <!-- 搜尋基本都用 GET 去做處理 (同個頁面上面)-->
                    <input type="search" class="form-control" placeholder="Search for name..." name="search" 
                    <?php
                      if (isset($_GET["search"])) :
                          $searchValue = $_GET["search"];
                          ?> value="<?= $searchValue ?>" 
                    <?php endif; ?>>
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="submit">Go!</button>
                    </span>
                  </div>
                </form>
              </div>
            </div>

          </div>

          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>教師管理</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> -->
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle text-info" data-toggle="dropdown" role="button" aria-expanded="false">排序</a>
                      <!-- ?order=1 升冪 , ?order=2 降冪 & 加分頁-->
                      <!-- if= "active"?>" 判斷在哪個選項裡(顏色不一樣) -->
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item <?php if($order==1)echo "active"?>" href="speaker.php?order=1&p=<?=$p?>">由舊到新</a>
                        <a class="dropdown-item <?php if($order==2)echo "active"?>" href="speaker.php?order=2&p=<?=$p?>">由新到舊</a>
                        <a class="dropdown-item <?php if($order==3)echo "active"?>" href="speaker.php?order=3&p=<?=$p?>">姓名升冪</a>
                        <a class="dropdown-item <?php if($order==4)echo "active"?>" href="speaker.php?order=4&p=<?=$p?>">姓名降冪</a>
                      </div>
                    <!-- </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li> -->
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">
                        <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <?php
                            //判斷 在搜尋裡總共有幾筆 or 預設值全部筆數
                                if (isset($_GET["search"])) {
                                  $searchCount = $result->num_rows;
                                  echo "搜尋<spen style=color:red;> $search </spen>的結果，共有 $searchCount 筆符合資料";
                                } else {
                                  $speakerCount = $speakerToCount;
                                  echo "教師共 $speakerCount 位，第 $p 頁，共 $pageCount 頁。";
                                } 
                            ?>
                          </div>
                          <a class="h6 text-end link-info" href="speaker_add.php" role="button">新增教師 <i class="fa-solid fa-user-plus"></i></a>
                        </div>
                        <p class="text-muted font-13 m-b-30">
                          <!--datatable DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code> -->
                          <!-- DataTables套件是一種JQuery外掛套件，特別針對table此種資料的呈現方式，內部已實作了各種相關操作的功能，並提供具有彈性的客製化選項，開發人員只需要下載並引用相關函式庫，即可輕鬆實作出功能豐富的table介面。https://www.it145.com/9/77315.html -->
                        </p>

                        <table id="" class="table table-striped table-bordered table table-striped table-hover" style="width:100%">
                          <thead>
                            <tr>
                              <th class="col-1">姓名 <i class="fa-sharp fa-solid fa-signature"></i></th>
                              <th class="col-10">簡介 <i class="fa-solid fa-file-signature"></i></th>
                              <th class="">操作 <i class="fa fa-wrench"></i></th>
                            </tr>
                          </thead>
                          <tbody>
                            <!-- 跑 foreach 找關聯式陣列 -->
                            <?php
                            $rows = $result->fetch_all(MYSQLI_ASSOC);
                            foreach ($rows as $speaker) :
                            ?>
                              <tr>
                                <!-- 文字置中垂直 text-center,align-middle -->
                                <td class="align-middle"><?= $speaker["Speaker_name"] ?></td>
                                <td class="align-middle"><?= $speaker["Speaker_description"] ?></td>

                                <td class="align-middle">
                                  <div class="d-flex justify-content-between">
                                    <!-- 去到speakeruser.php網頁丟id過去做處理(點擊到哪一位的id) -->
                                    <a role="button" class="btn btn-outline-secondary" href="speaker_user.php?id=<?= $speaker["Speaker_ID"] ?>"><i class="fa-regular fa-eye"></i></a>

                                    <!--button 做更改-->
                                    <a name="" id="" class="btn btn-outline-info" href="speaker_edit.php?id=<?= $speaker["Speaker_ID"] ?>" role="button"><i class="fa-regular fa-pen-to-square"></i></a>

                                  </div>
                                </td>

                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>

                        <?php if(!isset($_GET["search"])):?>
                        <nav aria-label="Page navigation example">
                          <ul class="pagination justify-content-end">
                            <!-- 依據 href="speaker.php?p=1" ["p"]做分頁-->
                            <!-- 跑迴圈做處理page-item (一定要有空格) -->
                            <!-- active 顯示出在第幾頁 -->
                            <a class="page-link" href="speaker.php?order=<?=$order?>&p=1" tabindex="-1" aria-disabled="true">首頁</a>
                            <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                              <li class="page-item <?php if ($i == $p) echo "active" ?>">
                              <a class="page-link" href="speaker.php?order=<?=$order?>&p=<?=$i?>"><?=$i?></a>
                              </li>
                            <?php endfor; ?>
                            <a class="page-link" href="speaker.php?order=<?=$order?>&p=<?=$pageCount?>">尾頁</a>
                          </ul>
                        </nav>
                        <?php endif;?>
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