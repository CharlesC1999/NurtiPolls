<?php
if (!isset($_GET["Coupon_ID"])) {
    $Coupon_ID = 0;
} else {
    $Coupon_ID = $_GET["Coupon_ID"];
}


require_once("../db_connect.php");
$sql = "SELECT * from coupons WHERE Coupon_ID=$Coupon_ID";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
$discount_type = $row["Discount_type"];
$todayDate = date('Y-m-d');

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
    <!-- 引入 Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- 引入 Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
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
                                <li><a href="tables_dynamic.html"><i class="fa fa-table"></i>商品管理 <span class="fa fa-chevron-down"></span></a>
                                </li>
                                <li><a href="tables_dynamic.html"><i class="fa fa-table"></i>分類管理<span class="fa fa-chevron-down"></span></a>
                                </li>
                                <li><a href="tables_dynamic.html"><i class="fa fa-table"></i>食譜管理<span class="fa fa-chevron-down"></span></a>
                                </li>
                                <li><a href="tables_dynamic.html"><i class="fa fa-table"></i>講師管理<span class="fa fa-chevron-down"></span></a>
                                </li>
                                <li><a href="tables_dynamic.html"><i class="fa fa-table"></i>課程管理<span class="fa fa-chevron-down"></span></a>
                                </li>
                                <li><a href="coupons.php"><i class="fa fa-table"></i>優惠卷管理<span class="fa fa-chevron-down"></span></a>
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
                    <a type="submit" class="btn btn-secondary" href="coupons.php" role="button"><i class="fa-solid fa-chevron-left"></i>返回列表</a>
                </div>
                <h1 class="my-3 h3">修改優惠券</h1>

                <form action="updateCoupon.php" method="post">
                    <input type="hidden" name="id" value="<?= $row["Coupon_ID"] ?>">
                    <table>
                        <tr>
                            <th>優惠券編號</th>
                            <td class="p-2">
                                <?= $row["Coupon_ID"] ?>
                            </td>
                        </tr>
                        <tr>
                            <th>優惠券名稱</th>
                            <td class="p-3">
                                <input type="text" class="form-control" name="name" value="<?= $row["C_name"] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>優惠券代碼</th>
                            <td class="p-3">
                                <input type="text" class="form-control" id="couponCode" placeholder="" name="code" value="<?= $row["C_code"] ?>" maxlength="8">
                            </td>
                        </tr>
                        <tr>
                            <th>優惠券使用時間</th>
                            <td class="p-3">
                                <div class="row">
                                    <div class="form-group col-auto">
                                        <input type="date" class="form-control" id="datePicker1" name="validStartDate" min="<?=$todayDate?>" max="2025-02-01" required="required" value="<?= $row["Valid_start_date"] ?>">
                                    </div>
                                    <span class="col-auto">~</span>
                                    <div class="form-group col-auto">
                                        <input type="date" class="form-control" id="datePicker2" name="validEndDate" min="2021-02-01" max="2025-02-01" required="required" value="<?= $row["Valid_end_date"] ?>">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>折扣方式</th>
                            <td class="p-3">
                                <div class="row">
                                    <div class="form-check col-auto">
                                        <input class="form-check-input" type="radio" name="discount_type" id="radio" value="百分比" <?php if ($discount_type == "百分比") echo "checked"; ?>>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            百分比
                                        </label>
                                    </div>

                                    <div class="form-check col-auto">
                                        <input class="form-check-input" type="radio" name="discount_type" id="" value="金額" <?php if ($discount_type == "金額") echo "checked"; ?>>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            金額
                                        </label>
                                    </div>
                            </td>
                        </tr>
                        <tr>
                            <th>優惠券面額</th>
                            <td class="p-3">
                                <input type="text" class="form-control" id="couponCode" placeholder="" name="couponAmount" value="<?= $row["Discount_amount"] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>優惠券適用範圍</th>
                            <td class="p-3">
                                <select class="form-control select2-multi" name="categories[]" value="<?= $rowcc["categories"] ?>" multiple="multiple">
                                    <?php
                                    // 將字符串轉換為陣列
                                    $selectedCategories = explode(", ", $rowcc["categories"]); ?>
                                    <!-- 手動檢查每個選項 -->
                                    <option value="1" <?php if (in_array("蔬菜", $selectedCategories)) echo "selected"; ?>>蔬菜</option>
                                    <option value="2" <?php if (in_array("米麵五穀", $selectedCategories)) echo "selected"; ?>>米麵五穀</option>
                                    <option value="3" <?php if (in_array("植物油", $selectedCategories)) echo "selected"; ?>>植物油</option>
                                    <option value="4" <?php if (in_array("魚類", $selectedCategories)) echo "selected"; ?>>魚類</option>
                                    <option value="5" <?php if (in_array("雞類", $selectedCategories)) echo "selected"; ?>>雞類</option>
                                    <option value="6" <?php if (in_array("豬類", $selectedCategories)) echo "selected"; ?>>豬類</option>
                                    <option value="7" <?php if (in_array("牛類", $selectedCategories)) echo "selected"; ?>>牛類</option>
                                    <option value="8" <?php if (in_array("季節水產", $selectedCategories)) echo "selected"; ?>>季節水產</option>
                                    <option value="9" <?php if (in_array("即食粥麵/湯品/甜品", $selectedCategories)) echo "selected"; ?>>即食粥麵/湯品/甜品</option>
                                    <option value="10" <?php if (in_array("乾貨/醃漬/素料", $selectedCategories)) echo "selected"; ?>>乾貨/醃漬/素料</option>
                                    <option value="11" <?php if (in_array("調味/醬料", $selectedCategories)) echo "selected"; ?>>調味/醬料</option>
                                    <option value="12" <?php if (in_array("抹醬/果醬", $selectedCategories)) echo "selected"; ?>>抹醬/果醬</option>
                                    <option value="13" <?php if (in_array("堅果/果乾", $selectedCategories)) echo "selected"; ?>>堅果/果乾</option>
                                    <option value="14" <?php if (in_array("飲品/茶咖啡", $selectedCategories)) echo "selected"; ?>>飲品/茶咖啡</option>
                                    <option value="15" <?php if (in_array("水果", $selectedCategories)) echo "selected"; ?>>水果</option>
                                    <option value="16" <?php if (in_array("素料", $selectedCategories)) echo "selected"; ?>>素料</option>
                                    <option value="17" <?php if (in_array("蛋類", $selectedCategories)) echo "selected"; ?>>蛋類</option>
                                    <option value="18" <?php if (in_array("豆製品", $selectedCategories)) echo "selected"; ?>>豆製品</option>
                                    <option value="19" <?php if (in_array("乳製品", $selectedCategories)) echo "selected"; ?>>乳製品</option>
                                    <option value="20" <?php if (in_array("其他精選肉", $selectedCategories)) echo "selected"; ?>>其他精選肉</option>
                                </select>
                            </td>
                            <!-- <td class="p-3">
                                <select class="form-control select2-multi" name="categories[]" multiple="multiple">
                                    <?php
                                    // 假設 $allCategories 包含所有分類，每個分類有 id 和 name
                                    foreach ($allCategories as $category) {
                                        // 檢查該分類是否在已選分類中
                                        $selected = in_array($category['id'], $rowcc["categories"]) ? 'selected' : '';
                                        echo "<option value='" . $category['id'] . "' $selected>" . $category['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td> -->
                        </tr>
                        <tr>
                            <th>最低消費金額</th>
                            <td class="p-3">
                                <input type="number" class="form-control" name="min_amount" value="<?= $row["minimum_spend"] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>優惠券說明</th>
                            <td class="p-3">
                                <input type="text" class="form-control" name="coupon_description" value="<?= $row["Coupon_description"] ?>">
                            </td>
                        </tr>
                    </table>
                    <div class="py-3">
                        <button type="submit" class="btn btn-info" role="button">儲存</button>
                        <button type="button" class="btn btn-danger" role="button" data-toggle="modal" data-target="#confirmModal">刪除</button>
                    </div>
                    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title fs-5" id="exampleModalLabel">刪除優惠券</h2>
                                    
                                </div>
                                <div class="modal-body">
                                    確認刪除?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                    <a role="button" class="btn btn-danger" href="doDeleteCoupon.php?Coupon_ID=<?= $row["Coupon_ID"] ?>">確認</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>