<?php
require_once("../db_connect.php");
$todayDate = date('Y-m-d');
$sqlFilter = "";

if (isset($_GET["status"])) {
  if ($_GET["status"] == "upcoming") {
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

  <title>coupons</title>
  <!-- 引入 Select2 CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootstrap -->
  <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap 5.3.2-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title fs-5" id="exampleModalLabel">刪除優惠券</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          確認刪除?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
          <a role="button" class="btn btn-danger" href="doDeleteCoupon.php?id=<?= $row["Coupon_ID"] ?>">確認</a>
        </div>
      </div>
    </div>
  </div>
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


          <div class="clearfix"></div>
          <div class="container">
            <h1 class="my-3 h3">建立優惠券</h1>
            <form action="doAddCoupon.php" method="post" onsubmit="return validateDates()">
              <div class="mb-3">
                <label class="form-label" for="">優惠券名稱</label>
                <input type="text" class="form-control" name="name">
              </div>
              <div class="mb-3">
                <label class="form-label" for="couponCode">優惠券代碼</label>
                <input type="text" class="form-control mb-2" id="couponCode" placeholder="請填入八位英數混合數字，英文需為大寫字母" name="code" required="required" maxlength="8" pattern="[0-9A-Z]+">
                <button style="background-color: #17a2b8
                ;color:#fff" class="btn" onclick="generateCouponCode()" type="button">隨機生成代碼</button>
              </div>



              <div class="row mb-3">
                <label class="form-label" for="">優惠券使用時間</label>
                <div class="form-group col-auto">
                  <input type="date" class="form-control" id="datePicker1" name="validStartDate" min="<?= $todayDate ?>" max="2025-02-01" required="required">
                </div>
                <div class="col-auto">~</div>
                <div class="form-group col-auto">
                  <input type="date" class="form-control" id="datePicker2" name="validEndDate" min="<?= $todayDate ?>" max="2025-02-01" required="required">
                </div>
                <div id="dateAlert" style="color: #c80b2b; display: none;">起始日期不可晚於結束日期</div>
              </div>

              <div class="mb-3 row">
                <label for="" class="form-label">折扣方式</label>
                <div class="form-check col-auto">
                  <input class="form-check-input" type="radio" name="discount_type" id="" value="百分比">
                  <label class="form-check-label" for="flexRadioDefault1">
                    百分比
                  </label>
                </div>
                <div class="form-check col-auto">
                  <input class="form-check-input" type="radio" name="discount_type" id="" value="金額" checked>
                  <label class="form-check-label" for="flexRadioDefault2">
                    金額
                  </label>
                </div>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">優惠券面額</label>
                <input type="text" class="form-control" id="couponAmount" placeholder="請填入數字 / 折數，例如300或0.9" name="couponAmount">
              </div>
              <div class="form-group">
                <label for="" class="form-label">優惠券適用範圍</label>
                <select class="form-control select2-multi" name="categories[]" multiple="multiple">
                  <option value="1">蔬菜</option>
                  <option value="2">米麵五穀</option>
                  <option value="3">植物油</option>
                  <option value="4">魚類</option>
                  <option value="5">雞類</option>
                  <option value="6">豬類</option>
                  <option value="7">牛類</option>
                  <option value="8">季節水產</option>
                  <option value="9">即食粥麵/湯品/甜品</option>
                  <option value="10">乾貨/醃漬/素料</option>
                  <option value="11">調味/醬料</option>
                  <option value="12">抹醬/果醬</option>
                  <option value="13">堅果/果乾</option>
                  <option value="14">飲品/茶咖啡</option>
                  <option value="15">水果</option>
                  <option value="16">素料</option>
                  <option value="17">蛋類</option>
                  <option value="18">豆製品</option>
                  <option value="19">乳製品</option>
                  <option value="20">其他精選肉</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">最低消費金額</label>
                <input type="number" class="form-control" name="min_amount">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">優惠說明（選填）</label>
                <input type="text" class="form-control" name="coupon_description">

              </div>
              <div class="py-2">
                <button type="submit" class="btn btn-info me-3" role="button" style="background-color: #17a2b8;color:#fff">確認</button>
                <a type="" class="btn btn-secondary" href="coupons.php" role="button">取消</a>

              </div>
            </form>
          </div>

        </div>
      </div>
      <!-- /page content -->


      <!-- /footer content -->
    </div>
  </div>

  <!-- 引入 jQuery (必須先於 Select2) -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <!-- 引入 Select2 JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.select2-multi').select2();
    });
  </script>

  <!-- 隨機生成優惠券代碼 -->
  <script>
    function generateCouponCode() {
      var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      var codeLength = 8;
      var couponCode = '';
      // Math.random(): 這是一個JavaScript函數，用於生成一個0到1之間的隨機數（包括0，但不包括1）。每次調用這個函數時，它都會返回一個不同的隨機數。

      // characters.length: 這裡的 characters 是一個字符串，包含了所有可能使用的字符（在你的案例中是大寫字母和數字）。characters.length 是這個字符串的長度，即字符的總數。

      // Math.random() * characters.length: 將 Math.random() 生成的隨機數乘以字符集的長度。這樣做的目的是將隨機數的範圍從0-1擴展到0到 characters.length。但是，這個乘法的結果可能是一個小數。

      // Math.floor(...): Math.floor 函數會將其內部的數字向下取整到最接近的整數。在這個案例中，它被用來將上一步中計算出的可能為小數的數字轉換為一個整數。這樣我們就能得到一個從0到 characters.length - 1 的隨機索引。
      for (var i = 0; i < codeLength; i++) {
        var randomIndex = Math.floor(Math.random() * characters.length);
        couponCode += characters[randomIndex];
      }

      document.getElementById('couponCode').value = couponCode;
    }
  </script>

  <!-- 優惠券使用時間驗證(結束時間不可早於起始時間) -->
  <script>
    function validateDates() {
      var startDate = document.getElementById('datePicker1').value;
      var endDate = document.getElementById('datePicker2').value;
      var alertBox = document.getElementById('dateAlert');

      if (startDate > endDate) {
        alertBox.style.display = 'block'; // 顯示警告訊息
        return false; // 阻止表單提交
      } else {
        alertBox.style.display = 'none'; // 隱藏警告訊息
        return true; // 允許表單提交
      }
    }
  </script>

  <!-- jQuery -->
  <!-- <script src="../vendors/jquery/dist/jquery.min.js"></script> -->
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