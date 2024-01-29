<?php
require_once("../db-connect.php");
if (!isset($_GET["id"])) {
    $id = 0;
    echo "請由正常管道進入";
} else {
    $id = $_GET["id"];
}

// http://localhost/小專/production/speaker.php?id=5 (id=後面可以帶參數)
$sql = "SELECT * FROM speaker WHERE Speaker_ID=$id";
$result = $conn->query($sql);

//確定只有一筆資料(可使用fetch_assoc() 一維陣列)
$row = $result->fetch_assoc();

$rowCount = $result->num_rows; //result裡面有幾筆(num_rows)


?>


<!doctype html>
<html lang="en">

<head>
    <title>Edit_Speaker</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <style>
        .object-fit-cover {
            width: 100%;
            height: 100%;
            border: 2px solid #aaa;
            border-radius: 5%;
        }

        .box {
            width: 18rem;
            height: 22rem;
        }

        .card {
            width: 18rem;
            height: 22rem;
            overflow-y: overlay;
        }
    </style>
</head>

<!-- input -> value="<?= $row["Speaker_name"] ?> show 出資料 -->
<!-- textarea -> 直接打 不用 value "<?= $row["Speaker_description"] ?> show 出資料 -->
<!-- <input type="hidden" name="id" value="<?=$row["Speaker_ID"]?>"> 要接id到doUpdateSpeaker做處理 (hidden頁面做隱藏) -->

<body>
    <div class="container">
        <form action="doUpdateSpeaker.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$row["Speaker_ID"]?>">
            <div class="row justify-content-center ">
                <div class="h2 text-center">修改教師 <?= $row["Speaker_name"] ?> 個人資訊</div>
                <div class="box">
                    <!-- 把原本的圖片資訊存在 hidden 裡，post 之後用來判斷是否要替換圖片 -->
                    <input type="hidden" name="old_img" value="<?=$row["Image"]?>">
                    <!-- 建立一個img(output)作為縮圖的容器，設定好id並以display:none隱藏起來 並做js事件onchange當檔案值做變化時 -->
                    <img id="output" height="200" style="display:none" class="rounded mx-auto d-block object-fit-cover" src="Speaker_pic/<?= $row["Image"] ?>">
                </div>
                <div class="card">
                    <div class="card-body">
                        <label for="" class="form-label">姓名 :</label>
                        <input type="text" class="form-control" value="<?= $row["Speaker_name"] ?>" name="name">
                        <p class="">
                            <label for="" class="form-label">個人簡介 :</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="description"><?= $row["Speaker_description"] ?></textarea>
                        </p>
                    </div>
                </div>
            </div>
            <!-- d-flex justify-content-between -->
            <div class="container d-flex justify-content-center py-3" >
                <div class="px-3"><input type="file" class="form-control " name="pic" onchange="openFile(event)"></div>
                <a name="" id="" class="btn btn-outline-secondary " href="speaker.php" role="button">返回列表</a>
                <div class="px-3" ><button class="btn btn-outline-secondary " type="submit">確定修改</button></div>
            </div>
        </form>
    </div>
    <script>
        function openFile(event) {
            var input = event.target; //取得上傳檔案
            var reader = new FileReader(); //建立FileReader物件

            reader.readAsDataURL(input.files[0]); //以.readAsDataURL將上傳檔案轉換為base64字串

            reader.onload = function() { //FileReader取得上傳檔案後執行以下內容
                var dataURL = reader.result; //設定變數dataURL為上傳圖檔的base64字串
                $('#output').attr('src', dataURL).show(); //將img的src設定為dataURL並顯示
            };
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- 讀取jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>