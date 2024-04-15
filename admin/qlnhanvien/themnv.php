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
		<h1 class="h3 mb-0 custom-heading">Thêm nhân viên</h1>
	</div>
</nav>
<form method="post" enctype="multipart/form-data" action="index.php?action=xem">
    <input type="hidden" name="action" value="xulythem">
            <!-- Area Chart -->
            <div class="card shadow mb-4" style="margin-left:10px;">
                <div class="card-header py-3" style="background-color:#2C3D57;">
                    <h6 class="m-0 font-weight-bold text-center" style="color:white;">Thông tin chi tiết</h6>
                </div>
                <div class="card-body">
                    <div class="my-1">    
                        <label class="form-label" style=""><em>Dấu</em> <a class="Sao">*</a> <em>là bắt buộc</em></label>
                    </div>

                    <div class="my-1">    
                        <label for="opttrangthai" class="form-label" >Trạng thái</label> <a class="Sao">*</a>
                        <select class="form-control" name="opttrangthai" style="font-size: 13px">
                            <option value="Select">--- Chọn trạng thái ---</option>
                            <option value="1">Đang làm việc</option>
                            <option value="0">Đã nghỉ việc</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col"> 
                            
                            <div class="my-1">    
                                <label class="form-label">Mã nhân viên</label> <a class="Sao">*</a>
                                <input class="form-control" type="text" name="txtmanv" style="font-size: 13px" placeholder="Nhập mã nhân viên" value="" required>
                            </div>

                            <div class="my-1">    
                                <label class="form-label">Họ tên</label> <a class="Sao">*</a>
                                <input class="form-control" type="text" name="txthotennv" style="font-size: 13px" placeholder="Nhập họ tên nhân viên" value="" required>    
                            </div>  

                            <div class="my-1">    
                                <label class="form-label">Ngày sinh</label> <a class="Sao">*</a>
                                <input class="form-control" type="date" name="txtngaysinh" style="font-size: 13px" value="" required>    
                            </div> 

                            <div class="my-1">    
                                <label for="optgioitinh" class="form-label">Giới tính</label> <a class="Sao">*</a>
                                <select class="form-control" name="optgioitinh" style="font-size: 13px">
                                    <option value="Select">--- Chọn giới tính ---</option>
                                    <option value="1">Nam</option>
                                    <option value="0">Nữ</option>
                                </select>
                            </div>

                            <div class="my-1">    
                                <label for="optloainv" class="form-label">Loại nhân viên</label> <a class="Sao">*</a>
                                <select class="form-control" name="optloainv" style="font-size: 13px">
                                    <option value="Select">--- Chọn loại nhân viên ---</option>
                                    <?php
                                    foreach($loainhanvien as $lnv):
                                    ?>
                                        <option value="<?php echo $lnv["id"]; ?>"><?php echo $lnv["tenloainv"]; ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            
                            <div class="my-1">    
                                <label for="optchucvu" class="form-label">Chức vụ</label> <a class="Sao">*</a>
                                <select class="form-control" name="optchucvu" style="font-size: 13px">
                                    <option value="Select">--- Chọn chức vụ ---</option>
                                    <?php
                                    foreach($chucvu as $cv):
                                    ?>
                                        <option value="<?php echo $cv["id"]; ?>"><?php echo $cv["tenchucvu"]; ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div class="my-1">    
                                <label class="form-label">Số điện thoại</label> <a class="Sao">*</a>
                                <input class="form-control" type="text" name="txtsdt" style="font-size: 13px" value="" required>    
                            </div>

                            <div class="my-1">    
                                <label class="form-label">Căn cước công dân</label> <a class="Sao">*</a>
                                <input class="form-control" type="text" name="txtcccd" style="font-size: 13px" placeholder="Nhập số Căn cước công dân" value="" required>
                            </div>

                            <div class="my-1">    
                                <label class="form-label">Nơi cấp CCCD</label> <a class="Sao">*</a>
                                <input class="form-control" type="text" name="txtnoicapcccd" style="font-size: 13px" placeholder="Nhập nới cấp Căn cước công dân" value="" required>    
                            </div>  
                            
                            <div class="my-1">    
                                <label class="form-label">Ngày cấp CCCD</label> <a class="Sao">*</a>
                                <input class="form-control" type="date" name="txtngaycapcccd" style="font-size: 13px" value="" required>                        
                            </div>  
                            
                        </div>

                        <div class="col">                            

                            <div class="my-1">    
                                <label for="opttrinhdo" class="form-label">Trình độ</label> <a class="Sao">*</a>
                                <select class="form-control" name="opttrinhdo" style="font-size: 13px">
                                    <option value="Select">--- Chọn chức vụ ---</option>
                                    <?php
                                    foreach($trinhdo as $td):
                                    ?>
                                        <option value="<?php echo $td["id"]; ?>"><?php echo $td["tentrinhdo"]; ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                                    
                            <div class="my-1">    
                                <label for="optchuyenmon" class="form-label">Chuyên môn</label> <a class="Sao">*</a>
                                <select class="form-control" name="optchuyenmon" style="font-size: 13px">
                                    <option value="Select">--- Chọn chuyên môn ---</option>
                                    <?php
                                    foreach($chuyenmon as $cm):
                                    ?>
                                        <option value="<?php echo $cm["id"]; ?>"><?php echo $cm["tenchuyenmon"]; ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div class="my-1">    
                                <label for="optbangcap" class="form-label">Bằng cấp</label> <a class="Sao">*</a>
                                <select class="form-control" name="optbangcap" style="font-size: 13px">
                                    <option value="Select">--- Chọn bằng cấp ---</option>
                                    <?php
                                    foreach($bangcap as $bc):
                                    ?>
                                        <option value="<?php echo $bc["id"]; ?>"><?php echo $bc["tenbangcap"]; ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div class="my-1">    
                                <label class="form-label">Nơi sinh</label>
                                <input class="form-control" type="text" name="txtnoisinh" style="font-size: 13px" value="" required>                        
                            </div>

                            <div class="my-1">    
                                <label class="form-label">Quê quán</label>
                                <input class="form-control" type="text" name="txtquequan" style="font-size: 13px" value="" required>    
                            </div> 
                            
                            <div class="my-1">    
                                <label class="form-label">Tạm trú</label>
                                <input class="form-control" type="text" name="txttamtru" style="font-size: 13px" value="" required>                        
                            </div>
                            
                            <div class="my-1">    
                                <label for="optquoctich" class="form-label">Quốc tịch</label> <a class="Sao">*</a>
                                <select class="form-control" name="optquoctich" style="font-size: 13px">
                                    <option value="Select">--- Chọn quốc tịch ---</option>
                                    <?php
                                    foreach($quoctich as $qt):
                                    ?>
                                        <option value="<?php echo $qt["id"]; ?>"><?php echo $qt["tenquoctich"]; ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div class="my-1">    
                                <label for="optdantoc" class="form-label">Dân tộc</label> <a class="Sao">*</a>
                                <select class="form-control" name="optdantoc" style="font-size: 13px">
                                    <option value="Select">--- Chọn bằng cấp ---</option>
                                    <?php
                                    foreach($dantoc as $dt):
                                    ?>
                                        <option value="<?php echo $dt["id"]; ?>"><?php echo $dt["tendantoc"]; ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div class="my-1">    
                                <label for="opttongiao" class="form-label">Tôn giáo</label> <a class="Sao">*</a>
                                <select class="form-control" name="opttongiao" style="font-size: 13px">
                                    <option value="Select">--- Chọn tôn giáo ---</option>
                                    <?php
                                    foreach($tongiao as $tg):
                                    ?>
                                        <option value="<?php echo $tg["id"]; ?>"><?php echo $tg["tentongiao"]; ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div class="my-1">    
                                <label class="form-label">Hình ảnh (3x4)</label>
                                <input class="form-control" type="file" name="filehinhanh">
                            </div>  
                        </div>
                    </div>     
                        <div class="mb-3 mt-3 text-center" >
                            <input type="submit" value="Lưu" class="btn btn-info" style="margin-right: 20px;">
                            <input type="reset" value="Hủy" class="btn btn-danger">
                        </div>              
                </div>
            </div>
    </form>
<?php include("../inc/footer.php"); ?>