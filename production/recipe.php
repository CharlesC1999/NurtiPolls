<?php
if (!isset($_GET["Recipe_ID"])) {
    $Recipe_ID = 0;
} else {
    $Recipe_ID = $_GET["Recipe_ID"];
}
require_once "../db_connect.php";
// $id=$_GET["id"];

$sql = "SELECT recipe.*,recipe_categories.Recipe_cate_name AS category_name FROM recipe
JOIN recipe_categories ON recipe.Recipe_Category_ID = recipe_categories.Recipe_cate_ID
 WHERE Recipe_ID=$Recipe_ID";
$result = $conn->query($sql);

$rowCount = $result->num_rows;
if ($rowCount != 0) {
    $row = $result->fetch_assoc();
}
?>





<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />



        <?php require_once "../css.php";?>
    </head>

    <body>
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">
            <i class="fa-solid fa-lightbulb"></i> 提示 </h1>
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
        <div class="container col-lg-6 col-md-8 col-sm-12">
            <div class="py-2">
                <a href="recipe-list.php" class="btn btn-primary" role="button">回食譜列表</a>
            </div>
            <?php if ($rowCount == 0): ?>
                沒有食譜

                <?php else:

?>
                    <input type="hidden" name="Recipe_ID" value="<?=$row["Recipe_ID"]?>">
                    <table class="table table-bordered">

                        <tr>
                            <th>食譜名稱</th>
                            <td><?=$row["Title_R_name"]?></td>
                        </tr>
                        <tr>
                            <th>展示圖片</th>
                            <td>
                                <div class="ratio ratio-1x1">
                                <img class="object-fit-cover" src="rimages/<?=$row["Image_URL"]?>" alt="">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>簡介</th>
                            <td><?=$row["Content"]?></td>
                        </tr>
                        <tr>
                            <th>建立日期</th>
                            <td><?=$row["Publish_date"]?></td>
                        </tr>
                        <tr>
                            <th>分類</th>
                            <td><?=$row["category_name"]?></td>
                        </tr>
                    </table>
                    <div class="d-flex justify-content-between">
                    <a href="recipe-edit.php?Recipe_ID=<?=$row["Recipe_ID"]?>" role="button" class="btn btn-secondary"><i class="fa-solid fa-wand-magic-sparkles"></i>修改</a>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal" >
                        <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>

                <?php endif;?>

        </div>
        <?php require_once "../js.php";?>
    </body>
</html>
