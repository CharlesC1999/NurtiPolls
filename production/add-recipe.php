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

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
       <div class="container">
       <?php
           echo date('Y-m-d H:i:s');

        ?>
        <form action="doAddUser.php" method="post">
           <div class="mb-2">
                <label for="" class="form-label">食譜名稱</label>
                <input type="text" class="form-control" name="Title_R_name" >
                
            </div> 
            <div class="mb-2">
                <label for="" class="form-label">展示圖片</label>
                <input type="email" class="form-control" name="Image_Url" >
                
            </div> 
            <div class="mb-2">
                        <label for="" class="form-label">簡介</label>
                        <textarea class="form-control" name="Content" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="分類"></label>  
                        <select name="" id="" class="form-select">
                            <option value="">選擇分類</option>
                            <option value="1">主食</option>
                            <option value="2">醬料</option>
                            <option value="3">湯品</option>
                            <option value="4">飲品</option>
                            <option value="5">點心</option>
                            <option value="6">沙拉</option>
                        </select> 
                    </div>
            <button class="btn btn-primary" type="submit">
                送出
            </button>
        </form>






       </div>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
