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
                    <img src="Speaker_pic/<?= $row["Image"] ?>" class="object-fit-cover" alt="...">
                </div>
                <div class="card">
                    <div class="card-body">
                        <label for="" class="form-label">姓名 :</label>
                        <input type="text" class="form-control" value="<?= $row["Speaker_name"] ?>" name="name">
                        <p class="">
                            <label for="" class="form-label">個人簡介 :</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="8" name="description"><?= $row["Speaker_description"] ?></textarea>
                        </p>
                    </div>
                </div>
            </div>
            <div class="container d-flex justify-content-center py-3" >
                <!-- <div class="px-3"><input type="file" class="form-control" name="pic"></div> -->
                <div><button class="btn btn-outline-secondary" type="submit">確定修改</button></div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- 讀取jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>