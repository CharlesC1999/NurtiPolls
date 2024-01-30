<!-- 會員個人 ui -->
<?php
if (!isset($_GET["id"])) {
    $id = 0;
} else {
    $id = $_GET["id"];
}
require_once "./connect.php";
$sql = "SELECT * FROM member WHERE id=$id AND valid=1";
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

        <?php
include "./css.php";
?>
    </head>

    <body>
    <div class="modal fade" id="confirmModal" tabindex="-1"  aria-hidden="true">
                    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">刪除使用者</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        確認刪除?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
        <a role="button" class="btn btn-danger"
        href="userDelete.php?id=<?=$row["id"]?>"
        >確認</a>
		<!-- 連結到 doDeleteUser並做軟刪除-->
      </div>
    </div>
  </div>
</div>

        <div class="container">
            <div class="py-2">
                <a
                    name=""
                    id=""
                    class="btn btn-secondary"
                    href="member.php"
                    role="button"
                    > <i class="fa-solid fa-arrow-left"></i> 回使用者列表</a
                >

            </div>
        <?php if ($rowCount == 0): ?>
            使用者不存在
            <?php else:

?>

            <!-- 使用者照片 -->
                <img src="<?=$row["User_image"]?>" alt="">
            <table class="table table-bordered">
                <tr>
                 <td>ID</td>
                 <td><?=$row["id"]?></td>
                 </tr>
                <tr>
                    <td>Name</td>
                 <td><?=$row["User_name"]?></td>
                 </tr>
                <tr>
                    <td>gender</td>
                 <td><?=$row["Gender"]?></td>
                 </tr>
                <!-- <tr>
                <td>Account</td>
                 <td>?=$row["Account"]?</td>
                 </tr>
                <tr>
                <td>Password</td>
                 <td>?=$row["Password"]?</td>
                 </tr> -->
                <tr>
                <td>Email</td>
                 <td><?=$row["Email"]?></td>
                 </tr>
                <tr>
                <td>Phone</td>
                 <td><?=$row["Phone"]?></td>
                 </tr>
                <tr>
                <td>birth</td>
                 <td><?=$row["date_of_birth"]?></td>
                 </tr>
                 <tr>
                <td>Create time</td>
                 <td><?=$row["Create_date"]?></td>
                 </tr>
            </table>
            <div class="d-flex justify-content-between">
                <a
                    name=""
                    id=""
                    class="btn btn-secondary"
                    href="user-edit.php?id=<?=$row["id"]?>"
                    role="button"
                    ><i class="fa-solid fa-user-pen"></i></a>
                    <button
                    data-bs-toggle="modal"
                    data-bs-target="#confirmModal"
                    class="btn btn-danger"
                    href="userDelete.php?id=<?=$row["id"]?>"
                    role="button"
                    ><i class="fa-solid fa-trash-can"></i></button>
            </div>
            <?php endif;?>
        </div>
        <?php
include "./js.php";
?>
    </body>
</html>
