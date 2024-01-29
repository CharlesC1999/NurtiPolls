<!doctype html>
<html lang="en">

<head>
    <title>Add coupon</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap -->
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="py-2">
            <a class="btn btn-info" href="coupons.php" role="button"><i class="fa-solid fa-chevron-left"></i>返回</a>
        </div>
        <form action="#" method="post">
            <div class="mb-2">
                <label for="">優惠券名稱</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="col-sm-3">
                <label class="visually-hidden" for="couponCode">Coupon Code</label>
                <div class="input-group">
                    <span class="input-group-text">NUTRI</span>
                    <input type="text" class="form-control" id="couponCode" placeholder="ABCDE">
                </div>
            </div>
            <div class="mb-2">
                <label for="">優惠券使用時間</label>
                <input type="tel" class="form-control" name="phone">
                <input type="tel" class="form-control" name="phone">
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="datePicker">優惠券使用時間</label>
                    <input type="date" class="form-control" id="datePicker">
                </div>
                <div class="form-group col-md-6">
                    <label for="datePicker"></label>
                    <input type="date" class="form-control" id="datePicker">
                </div>
            </div>
            <label for="">折扣方式｜折扣額度</label>
            <div class="row">

                <div class="col-md-6">
                    <select class="form-select form-select-lg mb-3" aria-label="Large select example">
                        <option value="1">折扣金額</option>
                        <option value="2">折扣折數</option>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="couponCode" placeholder="NT$">
                </div>
                </select>
            </div>
            <div class="mb-2">
                <label for="">Phone</label>
                <input type="tel" class="form-control" name="phone">
            </div>
            <button type="submit" class="btn btn-primary">
                送出
            </button>

        </form>

    </div>
    <script>
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
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>