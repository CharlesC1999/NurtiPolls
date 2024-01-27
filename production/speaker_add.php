<?php

require_once("../db-connect.php");

$sql = "SELECT * FROM speaker ORDER BY Speaker_ID DESC"; //->DESC降冪(最新在前面)
$result = $conn->query($sql);  //吐出資料
$rows = $result->fetch_all(MYSQLI_ASSOC); //轉換關聯式陣列


?>

<!doctype html>
<html lang="en">

<head>
    <title>Add_speaker</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        .box{
            width: 300px;
            height: 500px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center ">
            <h2 class="text-center">新增教師</h2>
            <div class="box">
                <!-- 上傳檔案去doAddSpeaker.php做處理 -->
                <!-- 傳檔案一定要加 enctype="multipart/form-data"以便正確解析和保存上傳的文件 -->
                <form action="doAddSpeaker.php" method="post" enctype="multipart/form-data">
                    <div class="mb-2">
                        <label for="" class="form-label">姓名 :</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">個人簡介 :</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="description"></textarea>
                    </div>
                    <!-- 記得type="file" (選擇檔案) -->
                    <div class="mb-2">
                        <label for="" class="form-label">上傳圖片 : </label>
                        <input type="file" class="form-control" name="pic">
                    </div>
                    <!-- d-grid gap-2 d-md-flex justify-content-md-end py-2 同靠右邊-->
                    <div class="d-flex justify-content-between align-items-center py-2">
                        <a name="" id="" class="btn btn-outline-secondary" href="speaker.php" role="button">返回列表</a>
                        <button class="btn btn-outline-secondary" type="submit">確定新增</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- 讀取jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>