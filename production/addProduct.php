<?php
require_once "../db_connect.php";
$sqlCategory = "SELECT * FROM product_categories";
$resultCategory = $conn->query($sqlCategory);
$rowsCategory = $resultCategory->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>營養大選 Nutripolls</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet" />

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet" />
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
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
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
                    <div class="page-title">
                        <div class="title_left">

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row ">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">

                                <h3>商品新增</h3>
                                </span>
                                <div class="x_title">
                                </div>
                                <div class="x_content justify-content-center">
                                    <span>

                                    </span>
                                    <!-- Smart Wizard -->
                                    <div id="justify-content-center">
                                        <form action="doAddProduct.php" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                            <div class="form-group row ">
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="hidden" value="<?=$row["id"]?>" name="id" class="form-control" readonly />
                                                </div>
                                            </div>
                                            <div class="h6 form-group row ">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">商品名稱<span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="text" name="product_name" required="required" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="h6 form-group row ">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">商品描述<span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="text" name="product_Description" required="required" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="h6 form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">價錢<span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="number" name="product_price" required="required" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="h6 form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">數量<span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="number" name="quantity" required="required" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="h6 form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">分類<span class="required">*</span>
                                                </label>

                                                <div class="col-md-6 col-sm-6">

                                                    <select name="category" required="required" class="form-control">
                                                        <?php foreach ($rowsCategory as $cate): ?>
                                                            <option value="<?=$cate["Product_cate_ID"]?>"><?=$cate["Product_cate_name"]?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row h6">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align align-items-center">圖片上傳</label>
                                                <div class="col-md-6 col-sm-6 d-flex align-items-center">
                                                    <input type="file" class="" name="product_image">
                                                </div>
                                            </div>


                                            <div class=" row">
                                                <div class="col-md-12 d-flex justify-content-end">
                                                    <!-- 確認按鈕 -->
                                                    <button type="submit" class="btn btn-secondary mr-2">確認</button>
                                                    <!-- 取消按鈕 -->
                                                    <a href="product.php" class="btn btn-secondary">取消</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End SmartWizard Content -->
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
                    Gentelella - Bootstrap Admin Template by
                    <a href="https://colorlib.com">Colorlib</a>
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
    <!-- jQuery Smart Wizard -->
    <script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
</body>

</html>