<!-- 會員個人修改 ui -->
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

?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php
include "./css.php";
?>
</head>

<body>
    <div class="container">

        <?php if ($rowCount == 0): ?>
            使用者不存在
        <?php else:
    $row = $result->fetch_assoc();
    ?>
	            <div class="py-2">
	                <a name="" id="" class="btn btn-secondary" href="user.php?id=<?=$row["id"]?>" role="button"> <i class="fa-solid fa-arrow-left"></i> 返回</a>
	            </div>
	            <form action="upDateUser.php" method="post">
	                <input type="hidden" name="id" value="<?=$row["id"]?>">
	                <input type="hidden" name="Create_date" value="<?=$row["Create_date"]?>">

	                <table class="table table-bordered">

	                    <!-- <tr>
	                 <td>ID</td>
	                 </tr> -->
	                    <tr>
	                        <th>name</th>
	                        <td><input type="text" class="form-control" name="name" value="<?=$row["User_name"]?>"></td>
	                    </tr>
	                    <!-- <tr>
	                        <td>Account</td>
	                        <td><input type="text" class="form-control" name="account" value="<?=$row["Account"]?>"></td>
	                    </tr> -->
	                    <!-- <tr>
	                        <td>Password</td>
	                        <td><input type="password" class="form-control" name="password" value="<?=$row["Password"]?>"></td>
	                    </tr> -->
	                    <tr>
	                        <th>gender</th>
	                        <td>
	                            <select id="gender" name="gender">
	                                <option value="M" name="M">Male</option>
	                                <option value="F" name="F">Female</option>
	                                <option value="Other" name="Other">Other</option>
	                            </select>
	                        </td>
	                    </tr>
	                    <tr>
	                        <th>email</th>
	                        <td><input type="email" class="form-control" name="email" value="<?=$row["Email"]?>"></td>
	                    </tr>
	                    <tr>
	                        <th>phone</th>
	                        <td><input type="number" class="form-control" name="phone" value="<?=$row["Phone"]?>"></td>
	                    </tr>
	                    <tr>
	                        <th>birth</th>
	                        <td><input type="date" class="form-control" name="birth" value="<?=$row["date_of_birth"]?>"></td>
	                    </tr>

	                </table>
	                <div class="py-2">
	                    <button type="submit" class="btn btn-secondary">
	                        儲存
	                    </button>
	                </div>
	            </form>
	        <?php endif;?>
    </div>
    <?php
include "./js.php";
?>
</body>

</html>