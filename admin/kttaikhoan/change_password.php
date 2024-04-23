<?php
include("../inc/sidebar.php");
include("../inc/top.php");
?>

<link rel="stylesheet" href="../css/main2.css">

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="container">
        <h1 class="h3 mb-0 custom-heading">Đổi mật khẩu</h1>
    </div>
</nav>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["txtemail"])) {
        if ($_POST["txtmatkhaumoi"] !== $_POST["txtrematkhau"]) {
            echo "<script>showErrorMessage('Mật khẩu mới không khớp, vui lòng nhập lại.');</script>";
        } else {
            $result = $tk->doimatkhau($_POST["txtemail"], $_POST["txtmatkhaumoi"]);
            if ($result) {
                $passwordChanged = true; // Đánh dấu mật khẩu đã được đổi thành công
                echo "<script>showSuccessMessage('Đổi mật khẩu thành công.');</script>";
            } else {
                echo "<script>showErrorMessage('Đã có lỗi xảy ra, vui lòng thử lại sau.');</script>";
            }
        }
    }

    ?>
    <form method="post" action="index.php?action=doimatkhau">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4" style="color:#2C3D57;">
                    <div class="card-header py-3" style="background-color:#2C3D57;">
                        <h6 class="m-0 font-weight-bold text-light text-center">Thay đổi mật khẩu</h6>
                    </div>
                    <div class="card-body">
                        <div class="my-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="text" name="txtemail" value="<?php echo $_SESSION["taikhoan"]["email"]; ?>">
                        </div>

                        <div class="my-3">
                            <label class="form-label">Mật khẩu mới</label>
                            <input class="form-control" type="password" name="txtmatkhaumoi" placeholder="Mật khẩu mới" required>
                        </div>

                        <div class="my-3">
                            <label class="form-label">Nhập lại mật khẩu mới</label>
                            <input class="form-control" type="password" name="txtrematkhau" placeholder="Nhập lại mật khẩu mới" required>
                        </div>

                        <div class="my-3 text-center">
                            <input class="btn btn-primary" type="submit" value="Lưu">
                            <input class="btn btn-warning" type="reset" value="Hủy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php

    ?>
</div>
<?php include("../inc/footer.php"); ?>