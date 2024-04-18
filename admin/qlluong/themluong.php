<?php
include("../inc/sidebar.php");
include("../inc/top.php");

// Kiểm tra xem session đã được khởi tạo hay chưa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$arrNV = $tinhLuong->layDanhSachNhanVien();

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
		<h1 class="h3 mb-0 custom-heading">Thêm lương mới</h1>
	</div>
</nav>

<form action="index.php?action=xem" enctype="multipart/form-data" method="POST">
<input type="hidden" name="action" value="xulythem">
    <div class="content-wrapper">
        <section class="content">
                <div class="col-xs-12">
                    <div class="box box-primary" style="margin-left:40px; margin-right:40px;">
                        <div class="card shadow mb-5" style="margin-left:10px; margin-right:10px;">
                            <div class="card-header py-3" style="background-color:#2C3D57;">
                                <h6 class="m-0 font-weight-bold text-center" style="color:white;">Thông tin chi tiết</h6>
                            </div>
                            <div class="card-body">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Mã lương</label>
                                            <?php
                                            $random = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
                                            $maLuong = 'MLAE' . $random;
                                            ?>
                                            <input type="text" class="form-control" name="maluong" value="<?php echo $maLuong; ?>" readonly>
                                        </div>
                                            <div class="form-group">
                                                <label for="opttennhanvien" class="form-label"><em>(Mã nhân viên - Họ tên)</em></label>
                                                <select class="form-control" name="manhanvien" id="nhanvien">
                                                    <option value="chon">--- Chọn nhân viên ---</option>
                                                        <?php
                                                        foreach ($arrNV as $nv) {
                                                            echo "<option value='" . $nv['id'] . "'>" . $nv['manv'] . " - " . $nv['hotennv'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Số ngày công</label><span style="color: red;"> *</span>
                                                    <input type="text" class="form-control" placeholder="Nhập số ngày công" name="soNgayCong" value="<?php echo isset($_POST['soNgayCong']) ? $_POST['soNgayCong'] : ''; ?>" id="soNgayCong">
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Tạm ứng</label>
                                                    <input type="text" class="form-control" id="tamUng" name="tamUng" placeholder="Nhập số tiền muốn tạm ứng" value="0">

                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Ngày tính lương</label>
                                                    <input type="date" class="form-control" id="ngayTinhLuong" placeholder="Nhập số tiền phụ cấp" name="ngayTinhLuong" value="<?php echo date('Y-m-d'); ?>">
                                                </div>
                                                <div class="form-group">
                                                <div class="my-1">    
                                                    <label class="form-label">Mô tả</label>
                                                    <textarea class="form-control" id="ghichu" name="moTa" style="font-size: 13px"></textarea>
                                                </div>
                                                <script>
                                                    CKEDITOR.replace('ghichu'); 
                                                </script>
                                                <div class="mb-3 mt-3 text-center" >
                                                    <input type="submit" value="Tính" class="btn btn-info" style="margin-right: 20px;" name="tinhLuong">
                                                    <input type="reset" value="Hủy" class="btn btn-danger">
                                                </div>       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</form>
<?php include("../inc/footer.php"); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('nhanvien').addEventListener('change', function() {
            var selectedIndex = document.getElementById('nhanvien').selectedIndex;
            // Lấy giá trị của lương ngày từ thuộc tính data-luongngay của option được chọn
            var luongNgayInput = parseFloat(document.getElementById('nhanvien').options[selectedIndex].getAttribute('data-luongngay'));
            var soNgayCongInput = parseFloat(document.getElementById('soNgayCong').value);
            var phuCapInput = document.getElementById('phuCap');

            // Kiểm tra xem cả hai giá trị đều là số hợp lệ
            if (!isNaN(luongNgayInput) && !isNaN(soNgayCongInput)) {
                // Tính toán giá trị phụ cấp
                var phuCapValue = luongNgayInput * soNgayCongInput;
                // Cập nhật giá trị phụ cấp vào input phụ cấp
                phuCapInput.value = phuCapValue.toFixed(2);
            } else {
                // Nếu một trong hai giá trị không hợp lệ, đặt giá trị phụ cấp là 0
                phuCapInput.value = '0';
            }
        });
    });
</script>


