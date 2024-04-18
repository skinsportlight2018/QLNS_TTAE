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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nhiemvu_congtac = $_POST["nhiemvu_congtac"];
    
    if (isset($_POST["txtngaybd"]) && isset($_POST["txtngaykt"])) {
        $startDate = $_POST["txtngaybd"];
        $endDate = $_POST["txtngaykt"];

        if ($startDate > $endDate) {
            $_SESSION['error_message'] = "Chọn ngày không phù hợp, hãy chọn lại!";
            header("Location: suacongtac.php");
            exit();
        }
    }
}
?>

<link rel="stylesheet" href="../css/chitietnv.css">

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
	<div class="container">
		<h1 class="h3 mb-0 custom-heading">Sửa công tác</h1>
	</div>
</nav>

<form method="post" enctype="multipart/form-data" action="index.php?action=xem" onsubmit="return thongtinNgay();">
    <input type="hidden" name="action" value="xulysua">
    <input type="hidden" name="txtid" value="<?php echo $c["id"]; ?>">

            <div class="card shadow mb-4" style="margin-left:10px;">
                <div class="card-header py-3" style="background-color:#2C3D57;">
                    <h6 class="m-0 font-weight-bold text-center" style="color:white;">Thông tin chi tiết</h6>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col"> 
                            
                            <div class="my-1">    
                                <label class="form-label">Mã công tác</label>
                                <input class="form-control" type="text" name="txtmacongtac" style="font-size: 13px" placeholder="Nhập mã công tác" value="<?php echo $c["macongtac"]; ?>"required>
                            </div>

                            <div class="my-1">    
                                <label for="opttennhanvien" class="form-label">Họ tên nhân viên</label>
                                <select class="form-control" name="opttennhanvien" style="font-size: 13px">
                                    <?php
                                    foreach($nhanvien as $nv):
                                        $selected = ($nv["id"] == $c["nhanvien_id"]) ? "selected" : "";
                                    ?>
                                        <option value="<?php echo $nv["id"]; ?>" <?php echo $selected; ?>><?php echo $nv["manv"]; ?> - <?php echo $nv["hotennv"]; ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div class="my-1">    
                                <label class="form-label">Địa điểm</label>
                                <input class="form-control" type="text" name="txtdiadiem" style="font-size: 13px" placeholder="Nhập địa điểm" value="<?php echo $c["diadiem"]; ?>" required>    
                            </div>

                        </div>

                        <div class="col">                            

                            <div class="my-1">    
                                <label class="form-label">Ngày bắt đầu</label>
                                <input class="form-control" type="date" name="txtngaybd" style="font-size: 13px" value="<?php echo $c["ngaybd"]; ?>" required>    
                            </div> 

                            <div class="my-1">    
                                <label class="form-label">Ngày kết thúc</label>
                                <input class="form-control" type="date" name="txtngaykt" style="font-size: 13px" value="<?php echo $c["ngaykt"]; ?>" required>    
                            </div> 

                            <div class="my-1">    
                                <label class="form-label">Ghi chú</label>
                                <input class="form-control" type="text" name="txtghichu" style="font-size: 13px" value="<?php echo $c["ghichu"]; ?>">    
                            </div>  
    
                        </div>
                    </div>    

                    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>

                    <div class="my-1">    
                        <label class="form-label">Nhiệm vụ công tác</label>
                        <textarea class="form-control" id="nhiemvu_congtac" name="txtnhiemvu_congtac" style="font-size: 13px" required><?php echo $c["nhiemvu_congtac"]; ?></textarea>
                    </div>

                    <script>
                        CKEDITOR.replace( 'nhiemvu_congtac' );
                    </script>

                    <div class="mb-3 mt-3 text-center" >
                        <input type="submit" value="Lưu" class="btn btn-info" style="margin-right: 20px;">
                        <input type="reset" value="Hủy" class="btn btn-danger">
                    </div>       
                </div>
            </div>
    </form>
<?php include("../inc/footer.php"); ?>

<script>
function thongtinNgay() {
    var startDate = new Date(document.getElementsByName("txtngaybd")[0].value);
    var endDate = new Date(document.getElementsByName("txtngaykt")[0].value);
    
    if (startDate > endDate) {
        alert("Chọn ngày không phù hợp, hãy chọn lại!");
        return false;
    }
    return true;
}
</script>