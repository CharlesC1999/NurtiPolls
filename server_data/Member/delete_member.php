<?php
require_once "./connect.php";
$sql = "SELECT * FROM member WHERE id=$id AND valid=1";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete</title>

    <? include("./css.php");
    ?>
</head>
<body>
<div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <!-- <h2>Default Example <small>Users</small></h2> -->
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a> -->
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <p class="text-muted font-13 m-b-30">
                      <!-- DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code> -->
                    </p>
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                        <td>id</td>
                        <td>name</td>
                        <td>Email</td>
                        <td>phone</td>
                        <td></td>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $rows = $result->fetch_all(MYSQLI_ASSOC);
foreach ($rows as $user): ?>
                        <tr>
                            <td><?=$user["id"]?></td>
                            <td><?=$user["User_name"]?></td>
                            <td><?=$user["Account"]?></td>
                            <td><?=$user["Phone"]?></td>
                            <td class=" d-flex justify-content-center">
                                <a class="btn btn-secondary" href="user.php?id=<?=$user["id"]?>" role="button"><i class="fa-solid fa-user"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                      </tbody>
                    </table>


                    <?php if (!isset($_GET["search"])): ?>
                <!-- 判斷在search不顯示分頁 -->
                <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $pageCount; $i++): ?>
                    <li class="page-item <?php if ($i == $p) {
    echo "active";
}
?>">
                        <a class="page-link"
                    href="member.php?p=<?=$i?>"><?=$i?></a></li>

                    <?php endfor;?>
                </ul>
            </nav>

        <?php else: ?>
            沒有使用者
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


<? include("./js.php");
    ?>
</body>
</html>
