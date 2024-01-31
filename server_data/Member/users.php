<!-- wu 會員資料列表 ui原版 -->
<?php
require_once "./connect.php";

$perPage = 10;
// 下面是搜尋的if

$sqlAll = "SELECT * FROM member WHERE valid=1";
$resultAll = $conn->query($sqlAll);
$userTotslCount = $resultAll->num_rows;

$pageCount = ceil($userTotslCount / $perPage);
// echo $pageCount;

if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT * FROM member WHERE User_name LIKE '%$search%' AND valid=1";
}
// 頁數的條件
elseif (isset($_GET["p"])) {
    $p = $_GET["p"];
    $startIndex = ($p - 1) * $perPage;

    $sql = "SELECT * FROM member WHERE valid=1 LIMIT $startIndex,$perPage";
} else {
    // 沒有選擇頁數時p=1
    $p = 1;
    $sql = "SELECT * FROM member WHERE valid=1 LIMIT $perPage";
}

$result = $conn->query($sql);

if (isset($_GET["search"])) {
    $userCount = $result->num_rows;
} else {
    $userCount = $userTotslCount;
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>users</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php
include "./css.php";
?>
</head>

<body>
    <div class="container">
        <h1>會員列表</h1>
        <div class="py-2">
            <div class="row g-3">
                <!-- 搜尋的返回按鍵 -->
                <?php if (isset($_GET["search"])): ?>
                    <div class="col-auto">
                        <a name="" id="" class="btn btn-secondary" href="users.php" role="button"><i class="fa-solid fa-arrow-left"></i></a>
                    </div>
                <?php endif;?>
                <div class="col">
                    <!-- 搜尋欄位 -->
                    <form action="" method="get">
                        <div class="input-group mb-3">
                            <input type="search" class="form-control" placeholder="Name" aria-label="Recipient's username" aria-describedby="button-addon2" name="search" <?php if (isset($_GET["search"])): $searchValue = $_GET["search"];?> value="<?=$searchValue?>" <?php endif?>>
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div>
                共 <?=$userCount?> 人
            </div>
            <div class="mb-2">
                <a name="" id="" class="btn btn-secondary" href="add-user.php" role="button"><i class="fa-solid fa-user-plus"></i></a>
            </div>
        </div>
        <?php
if ($userCount > 0):
?>
            <table class="table table-bordered">
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
                    href="users.php?p=<?=$i?>"><?=$i?></a></li>

                    <?php endfor;?>
                </ul>
            </nav>
            <?php endif;?>

        <?php else: ?>
            沒有使用者
        <?php endif;?>
    </div>
    <?php
include "./js.php";
?>
</body>

</html>