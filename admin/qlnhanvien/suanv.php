<?php
include("../inc/sidebar.php");
include("../inc/top.php");

// Kiểm tra xem session đã được khởi tạo hay chưa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<?php
if (isset($_SESSION['success_message'])) {
    echo '<script>showSuccessMessage("' . $_SESSION['success_message'] . '")</script>';
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error_message'])) {
    echo '<script>showErrorMessage("' . $_SESSION['error_message'] . '")</script>';
    unset($_SESSION['error_message']);
}
if (isset($_SESSION['delete_message'])) {
    echo '<script>showDeleteMessage("' . $_SESSION['delete_message'] . '")</script>';
    unset($_SESSION['delete_message']);
}
?>

<link rel="stylesheet" href="../css/chitietnv.css">

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="container">
        <h1 class="h3 mb-0 custom-heading">Sửa nhân viên</h1>
    </div>
</nav>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../kttaikhoan/main.php"><i class="fas fa-home"></i> Tổng Quát</a></li>
        <li class="breadcrumb-item"><a href="../qlnhanvien/index.php"><i class="bi bi-person-fill"></i>Danh sách nhân viên</a></li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Sửa nhân viên</li>
    </ol>
</nav>
<form method="post" enctype="multipart/form-data" action="index.php">
    <input type="hidden" name="action" value="xulysua">
    <input type="hidden" name="txtid" value="<?php echo $nv["id"]; ?>">
    <!-- Area Chart -->
    <div class="card shadow mb-4" style="margin-left:10px;">
        <div class="card-header py-3" style="background-color:#2C3D57;">
            <h6 class="m-0 font-weight-bold text-center" style="color:white;">Thông tin chi tiết</h6>
        </div>
        <div class="card-body">
            <div class="my-1">
                <label class="form-label"><em>Dấu</em> <a class="Sao">*</a> <em>là bắt buộc</em></label>
            </div>

            <div class="my-1">
                <label for="opttrangthai" class="form-label">Trạng thái</label> <a class="Sao">*</a>
                <select class="form-control" name="opttrangthai" style="font-size: 13px">
                    <option value="1" <?php if ($nv["trangthai"] == 1) echo "selected"; ?>>Đang làm việc</option>
                    <option value="0" <?php if ($nv["trangthai"] == 0) echo "selected"; ?>>Đã nghĩ việc</option>
                </select>
            </div>

            <div class="row">
                <div class="col">

                    <div class="my-1">
                        <label class="form-label">Mã nhân viên</label> <a class="Sao">*</a>
                        <input class="form-control" type="text" name="txtmanv" style="font-size: 13px" value="<?php echo $nv["manv"]; ?>" required>
                    </div>

                    <div class="my-1">
                        <label class="form-label">Họ tên</label> <a class="Sao">*</a>
                        <input class="form-control" type="text" name="txthotennv" style="font-size: 13px" value="<?php echo $nv["hotennv"]; ?>" required>
                    </div>

                    <div class="my-1">
                        <label class="form-label">Ngày sinh</label> <a class="Sao">*</a>
                        <input class="form-control" type="date" name="txtngaysinh" style="font-size: 13px" value="<?php echo $nv["ngaysinh"]; ?>" required>
                    </div>

                    <div class="my-1">
                        <label for="optgioitinh" class="form-label">Giới tính</label> <a class="Sao">*</a>
                        <select class="form-control" name="optgioitinh" style="font-size: 13px">
                            <option value="1" <?php if ($nv["gioitinh"] == 1) echo "selected"; ?>>Nam</option>
                            <option value="0" <?php if ($nv["gioitinh"] == 0) echo "selected"; ?>>Nữ</option>
                        </select>

                    </div>

                    <div class="my-1">
                        <label for="optloainv" class="form-label">Loại nhân viên</label> <a class="Sao">*</a>
                        <select class="form-control" name="optloainv" style="font-size: 13px">
                            <?php foreach ($loainv as $lnv) { ?>
                                <option value="<?php echo $lnv["id"]; ?>" <?php if ($lnv["id"] == $nv["loai_nv_id"]) echo "selected"; ?>><?php echo $lnv["tenloainv"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="my-1">
                        <label for="optchucvu" class="form-label">Chức vụ</label> <a class="Sao">*</a>
                        <select class="form-control" name="optchucvu" style="font-size: 13px">
                            <?php foreach ($chucvu as $cv) { ?>
                                <option value="<?php echo $cv["id"]; ?>" <?php if ($cv["id"] == $nv["chucvu_id"]) echo "selected"; ?>><?php echo $cv["tenchucvu"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="my-1">
                        <label class="form-label">Số điện thoại</label> <a class="Sao">*</a>
                        <input class="form-control" type="text" name="txtsdt" style="font-size: 13px" value="<?php echo $nv["sdt"]; ?>" required>
                    </div>

                    <div class="my-1">
                        <label class="form-label">Căn cước công dân</label> <a class="Sao">*</a>
                        <input class="form-control" type="text" name="txtcccd" style="font-size: 13px" value="<?php echo $nv["cccd"]; ?>" required>
                    </div>

                    <div class="my-1">
                        <label class="form-label">Nơi cấp CCCD</label> <a class="Sao">*</a>
                        <input class="form-control" type="text" name="txtnoicapcccd" style="font-size: 13px" value="<?php echo $nv["noicap_cccd"]; ?>" required>
                    </div>

                    <div class="my-1">
                        <label class="form-label">Ngày cấp CCCD</label> <a class="Sao">*</a>
                        <input class="form-control" type="date" name="txtngaycapcccd" style="font-size: 13px" value="<?php echo $nv["ngaycap_cccd"]; ?>" required>
                    </div>

                </div>

                <div class="col">

                    <div class="my-1">
                        <label for="opttrinhdo" class="form-label">Trình độ</label> <a class="Sao">*</a>
                        <select class="form-control" name="opttrinhdo" style="font-size: 13px">
                            <?php foreach ($trinhdo as $td) { ?>
                                <option value="<?php echo $td["id"]; ?>" <?php if ($td["id"] == $nv["trinhdo_id"]) echo "selected"; ?>><?php echo $td["tentrinhdo"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="my-1">
                        <label for="optchuyenmon" class="form-label">Chuyên môn</label> <a class="Sao">*</a>
                        <select class="form-control" name="optchuyenmon" style="font-size: 13px">
                            <?php foreach ($chuyenmon as $cm) { ?>
                                <option value="<?php echo $cm["id"]; ?>" <?php if ($cm["id"] == $nv["chuyenmon_id"]) echo "selected"; ?>><?php echo $cm["tenchuyenmon"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="my-1">
                        <label for="optbangcap" class="form-label">Bằng cấp</label> <a class="Sao">*</a>
                        <select class="form-control" name="optbangcap" style="font-size: 13px">
                            <?php foreach ($bangcap as $bc) { ?>
                                <option value="<?php echo $bc["id"]; ?>" <?php if ($bc["id"] == $nv["bangcap_id"]) echo "selected"; ?>><?php echo $bc["tenbangcap"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="my-1">
                        <label class="form-label">Nơi sinh</label>
                        <input class="form-control" type="text" name="txtnoisinh" style="font-size: 13px" value="<?php echo $nv["noisinh"]; ?>" required>
                    </div>

                    <div class="my-1">
                        <label class="form-label">Quê quán</label>
                        <input class="form-control" type="text" name="txtquequan" style="font-size: 13px" value="<?php echo $nv["quequan"]; ?>" required>
                    </div>

                    <div class="my-1">
                        <label class="form-label">Tạm trú</label>
                        <input class="form-control" type="text" name="txttamtru" style="font-size: 13px" value="<?php echo $nv["tamtru"]; ?>" required>
                    </div>

                    <div class="my-1">
                        <label for="optquoctich" class="form-label">Quốc tịch</label> <a class="Sao">*</a>
                        <select class="form-control" name="optquoctich" style="font-size: 13px">
                            <?php foreach ($quoctich as $qt) { ?>
                                <option value="<?php echo $qt["id"]; ?>" <?php if ($qt["id"] == $nv["quoctich_id"]) echo "selected"; ?>><?php echo $qt["tenquoctich"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="my-1">
                        <label for="optdantoc" class="form-label">Dân tộc</label> <a class="Sao">*</a>
                        <select class="form-control" name="optdantoc" style="font-size: 13px">
                            <?php foreach ($dantoc as $dt) { ?>
                                <option value="<?php echo $dt["id"]; ?>" <?php if ($dt["id"] == $nv["dantoc_id"]) echo "selected"; ?>><?php echo $dt["tendantoc"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="my-1">
                        <label for="opttongiao" class="form-label">Tôn giáo</label> <a class="Sao">*</a>
                        <select class="form-control" name="opttongiao" style="font-size: 13px">
                            <?php foreach ($tongiao as $tg) { ?>
                                <option value="<?php echo $tg["id"]; ?>" <?php if ($tg["id"] == $nv["trinhdo_id"]) echo "selected"; ?>><?php echo $tg["tentongiao"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="my-1">
                        <label class="form-label">Hình ảnh (3x4)</label>
                        <div>
                            <input type="hidden" name="txthinhcu" value="<?php echo $nv["hinhanh"]; ?>">
                            <img src="../img/Avatar/<?php echo $nv["hinhanh"]; ?>" width="50" class="img-thumbnail">
                            <!-- Input để chọn file mới -->
                            <input type="file" class="form-control" name="filehinhanh">
                        </div>
                    </div>


                </div>
            </div>
            <div class="mb-3 mt-3 text-center">
                <input type="submit" value="Lưu" class="btn btn-info" style="margin-right: 20px;">
                <input type="reset" value="Hủy" class="btn btn-danger">
            </div>
        </div>
    </div>
</form>
<?php include("../inc/footer.php"); ?>