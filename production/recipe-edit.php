<?php
if (!isset($_GET["Recipe_ID"])) {
    $Recipe_ID = 0;
} else {
    $Recipe_ID = $_GET["Recipe_ID"];
}
require_once "../db_connect.php";

$sql = "SELECT * FROM recipe WHERE Recipe_ID=$Recipe_ID";
$result = $conn->query($sql);

$rowCount = $result->num_rows;
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php require_once "../css.php";?>
</head>

<body>
    <div class="container">
        <div class="py-2">
            <a href="recipe-list.php" class="btn btn-primary" role="button">回食譜列表</a>
        </div>
        <?php if ($rowCount == 0): ?>
            沒有食譜
        <?php else:
    $row = $result->fetch_assoc();
    ?>
	            <form action="updateRecipe.php" method="post" enctype="multipart/form-data">
	                <input type="hidden" name="Recipe_ID" value="<?=$row["Recipe_ID"]?>">
	                <table class="table table-bordered">
	                    <tr>
	                        <th>食譜名稱</th>
	                        <td><input type="text" class="form-control" value="<?=$row["Title_R_name"]?>" name="Title_R_name"></td>
	                    </tr>
	                    <tr>
	                        <th>展示圖片</th>
	                        <td>
	                            <input type="hidden" name="old_img" value="<?=$row["Image_URL"]?>">
	                            <img src="rimages/<?=$row["Image_URL"]?>" alt="">
	                            <input type="file" name="file">
	                        </td>
	                    </tr>
	                    <tr>
	                        <th>簡介</th>
	                        <td>
	                        <textarea class="form-control" name="Content" cols="30" rows="10"><?=$row["Content"]?></textarea>
	                        </td>
	                    </tr>
	                    <tr>
	                        <th>分類</th>
	                        <td>
	                            <select name="Recipe_category_ID" id="" class="form-select">

	                                <option value="1">主食</option>
	                                <option value="2">醬料</option>
	                                <option value="3">湯品</option>
	                                <option value="4">飲品</option>
	                                <option value="5">點心</option>
	                                <option value="6">沙拉</option>
	                            </select>
	                        </td>
	                    </tr>
	                </table>
	                <div>
	                    <button type="submit" class="btn btn-secondary">修改</button>
	                </div>
	            </form>
	        <?php endif;?>
    </div>

    <?php require_once "../js.php";?>
</body>

</html>
