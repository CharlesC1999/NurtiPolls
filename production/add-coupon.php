<!doctype html>
<html lang="en">

<head>
    <title>Add coupon</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


</head>

<body>
    <div class="container">
        <h2 class="my-3">建立優惠券</h2>
        <form action="doAddCoupon.php" method="post">
            <div class="mb-3">
                <label class="form-label" for="">優惠券名稱</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label class="form-label" for="couponCode">優惠券代碼</label>
                    <input type="text" class="form-control" id="couponCode" placeholder="請填入八位英數混合數字" name="code">
            </div>



            <div class="row mb-3">
                <label class="form-label" for="">優惠券使用時間</label>
                <div class="form-group col-auto">
                    <input type="date" class="form-control" id="datePicker" name="validStartDate">
                </div>
                <div class="col-auto">~</div>
                <div class="form-group col-auto">
                    <input type="date" class="form-control" id="datePicker" name="validEndDate">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="" class="form-label">折扣方式</label>
                <div class="form-check col-auto">
                    <input class="form-check-input" type="radio" name="discount_type" id="" value="百分比">
                    <label class="form-check-label" for="flexRadioDefault1">
                        百分比
                    </label>
                </div>
                <div class="form-check col-auto">
                    <input class="form-check-input" type="radio" name="discount_type" id="" value="金額" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        金額
                    </label>
                </div>
            </div>
            <div class="mb-3">
                    <label for="" class="form-label">優惠券面額</label>
                    <input type="text" class="form-control" id="couponCode" placeholder="請填入數字 / 折數，例如300或0.9" name="couponAmount">
                </div>

            <div class="mb-3">
                <label for="" class="form-label">最低消費金額</label>
                <input type="number" class="form-control" name="min_amount">
            </div>
            <div class="py-2">
                <button type="submit" class="btn btn-info me-3" role="button" style="background-color: #17a2b8;color:#fff">確認</button>
                <a type="" class="btn btn-secondary" href="coupons.php" role="button">取消</a>

            </div>
        </form>
    </div>

<!--     <script>
        // 當表單被提交時，確認優惠券碼的格式
        document.querySelector('form').addEventListener('submit', function(event) {
            var couponInput = document.getElementById('couponCode');
            var couponValue = couponInput.value;

            // 確認輸入是5個字元的英數混合
            if (!/^[A-Za-z0-9]{5}$/.test(couponValue)) {
                alert('Coupon code must be 5 alphanumeric characters!');
                event.preventDefault(); // 阻止表單提交
            }
        });
    </script> -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>