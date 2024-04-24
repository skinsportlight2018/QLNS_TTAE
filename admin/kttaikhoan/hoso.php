<?php
include("../inc/sidebar.php");
include("../inc/top.php");
?>

<link rel="stylesheet" href="../css/main1.css">

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="container">
        <h1 class="h3 mb-0 custom-heading">Hồ sơ tài khoản</h1>
    </div>
</nav>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <form method="post" enctype="multipart/form-data" action="../kttaikhoan/index.php">
        <div class="row">
            <!-- Donut Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3" style="background-color:#2C3D57;">
                        <h6 class="m-0 font-weight-bold text-light text-center">Ảnh đại diện</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <input type="hidden" name="txtid" value="<?php echo $_SESSION["taikhoan"]["id"]; ?>">
                        <input type="hidden" name="txthinhanh" value="<?php echo $_SESSION["taikhoan"]["hinhanh"]; ?>">
                        <input type="hidden" name="action" value="xlhoso">

                        <div class="text-center">
                            <?php if (isset($_SESSION["taikhoan"]["hinhanh"]) && $_SESSION["taikhoan"]["hinhanh"] != NULL) : ?>
                                <img class="img-profile rounded-circle" src="../img/Avatar/<?php echo $_SESSION["taikhoan"]["hinhanh"]; ?>" style="width: 150px; height: 150px;" />
                            <?php else : ?>
                                <img class="img-profile rounded-circle" src="../img/Avatar/default.jpg" style="width: 150px; height: 150px;" />
                            <?php endif; ?>
                        </div>
                        <input type="hidden" name="txtid" value="<?php echo $_SESSION["taikhoan"]["id"]; ?>">

                        <div class="NameUser" style="margin:20px; text-align: center; font-size: 17px; color:#2C3D57;">
                            <strong><?php if (isset($_SESSION["taikhoan"])) echo $_SESSION["taikhoan"]["ho"]; ?></strong>
                            <strong><?php if (isset($_SESSION["taikhoan"])) echo $_SESSION["taikhoan"]["ten"]; ?></strong>
                        </div>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#changeInfo">
                            <div class="d-flex align-items-center justify-content-center">
                                <div>
                                    <i class="bi bi-file-person"></i>
                                    Thông tin tài khoản
                                </div>
                            </div>
                        </a>

                        <!-- Logout Modal-->
                        <div class="modal fade" id="changeInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title " id="exampleModalLabel">Thay đổi thông tin</h5>

                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>

                                    <div class="px-5">
                                        <div class="my-3">
                                            <label class="form-label">Họ</label>
                                            <input class="form-control" type="text" name="txtho" placeholder="Họ" value="<?php echo $_SESSION["taikhoan"]["ho"]; ?>" required>
                                        </div>

                                        <div class="my-3">
                                            <label class="form-label">Tên</label>
                                            <input class="form-control" type="text" name="txtten" placeholder="Tên" value="<?php echo $_SESSION["taikhoan"]["ten"]; ?>" required>
                                        </div>

                                        <div class="my-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control" type="email" name="txtemail" placeholder="Email" value="<?php echo $_SESSION["taikhoan"]["email"]; ?>" required>
                                        </div>

                                        <div class="my-3">
                                            <label class="form-label">Số điện thoại</label>
                                            <input class="form-control" type="text" name="txtsdt" placeholder="Số điện thoại" value="<?php echo $_SESSION["taikhoan"]["sdt"]; ?>" required>
                                        </div>

                                        <div class="my-3">
                                            <label class="form-label ">Đổi hình đại diện</label>
                                            <input class="form-control" type="file" name="fhinh">
                                        </div>

                                        <div class="modal-footer">
                                            <input class="btn btn-primary" type="submit" value="Cập nhật">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-7">
                <!-- Area Chart -->
                <div class="card shadow mb-4" style="color:#2C3D57;">
                    <div class="card-header py-3" style="background-color:#2C3D57;">
                        <h6 class="m-0 font-weight-bold text-light text-center">Thông tin cá nhân</h6>
                    </div>
                    <div class="card-body">
                        <div class="my-4">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="email" name="txtemail" placeholder="Email" value="<?php echo $_SESSION["taikhoan"]["email"]; ?>" required>
                        </div>

                        <div class="my-5">
                            <label class="form-label">Số điện thoại</label>
                            <input class="form-control" type="number" name="txtdienthoai" placeholder="Số điện thoại" value="<?php echo $_SESSION["taikhoan"]["sdt"]; ?>" required>
                        </div>
                    </div>
                </div>
            </div>
    </form>

</div>
</div>
<?php include("../inc/footer.php"); ?>