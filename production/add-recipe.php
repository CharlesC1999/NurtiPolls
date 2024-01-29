<?php
require_once("../db_connectn.php");
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

       <?php require_once("../css.php");  ?>
    </head>

    <body>
        <div class="container">
            <form action="doAddRecipe.php" method="post" enctype="multipart/form-data">
                <div class="mb-2">
                    <label for="" class="form-label">食譜名稱</label>
                    <input type="text" class="form-control" name="Title_R_name">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">展示圖片</label>
                    <input type="file" class="form-control" name="pic" >
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">內容</label>
                    <textarea type="text" class="form-control" name="Content" rows="6" cols="70"> </textarea>
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">分類</label>
                    <select name="Recipe_categoey_ID" id="" class="form-select">
                            <option value="">選擇分類</option>
                            <option value="1">主食</option>
                            <option value="2">醬料</option>
                            <option value="3">湯品</option>
                            <option value="4">飲品</option>
                            <option value="5">點心</option>
                            <option value="6">沙拉</option>
                        </select> 
                </div>
                
                
                
                <button class="btn btn-primary" type="submit">送出</button>
            </form>
        </div>
       


        <?php require_once("../js.php");  ?>
    </body>
</html>
