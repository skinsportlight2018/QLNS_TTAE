<?php
include("../inc/sidebar.php");
include("../inc/top.php");
?>
<link rel="stylesheet" href="../css/chitietnv.css">

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
	<div class="container">
		<h1 class="h3 mb-0 custom-heading">Thông tin lương nhân viên</h1>
	</div>
</nav>

<!-- Begin Page Content -->
<div class="container-fluid">
<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="../kttaikhoan/main.php"><i class="fas fa-home"></i> Tổng Quát</a></li>
			<li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Thông tin lương nhân viên</li>
		</ol>
	</nav>
    <div class="row">
        <!-- Donut Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4 rounded-3">
                <!-- Card Body -->
                <div class="card-body" style="background-color:#2C3D57;">
                    <div class="text-center">
                            <img class="img-profile rounded-circle" src="../img/Avatar/<?php echo $nv["hinhanh"]; ?>" style="width: 150px; height: 150px;">
                    </div>
                            
                        <div class="my-1 text-center">    
                            <label class="form-label" style="font-size: 20px; text-transform: uppercase; font-weight: bold; color:#ffffff;"><?php echo $nv["hotennv"]; ?></label>    
                        </div>
                        
                        <div class="my-1">
                            <?php if ($nv["trangthai"] == 1): ?>
                                <div class="bg-success text-white text-center rounded-pill py-1 px-1">
                                    Đang làm việc
                                </div>
                            <?php elseif ($nv["trangthai"] == 0): ?>
                                <div class="bg-danger text-white text-center rounded-pill py-1 px-1">
                                    Đã nghỉ việc
                                </div>
                            <?php endif; ?>
                        </div>
                            </div>

                        <hr class="sidebar-divider my-0">
                        <!-- Cột 1-->
                        <div class="container">
                            <div class="col" style="max-width: 40px; margin-bottom: 24px;">
                                <div class="row" style="margin-top: 24px; margin-left: 5px;">
                                    <label class="form-label" style="font-size: 16px; color:#2C3D57;"><i class="bi bi-person-fill"></i></label> 
                                </div>

                                <div class="row" style="margin-top: 48px; margin-left: 5px;">
                                    <label class="form-label" style="font-size: 16px; color:#2C3D57;"><i class="bi bi-telephone-fill"></i></label> 
                                </div>

                                <div class="row" style="margin-top: 48px; margin-left: 5px;"> 
                                    <label class="form-label" style="font-size: 16px; color:#2C3D57;"><i class="bi bi-person-badge-fill"></i></label>    
                                </div>
                            </div>

                            <div class="col" style="max-width: 220px;">
                                <div class="row" style="margin-top: 24px;">
                                    <a class="ms-2" style="color: #2C3D57; font-size: 16px; margin-left: 10px;"><?php echo $nv["manv"]; ?></a>
                                </div>

                                <div class="row" style="margin-top: 54px;">                                        
                                    <a class="ms-2" style="color: #2C3D57; font-size: 16px; margin-left: 10px;"><?php echo $nv["sdt"]; ?></a>   
                                </div>

                                <div class="row" style="margin-top: 56px;"> 
                                    <a class="ms-2" style="color: #2C3D57; font-size: 17px; margin-left: 10px;"><?php echo $nv["tenloainv"]; ?></a>
                                </div>
                            </div>

                            <div class="col" style="max-width: 40px; margin-bottom: 24px;">
                                <div class="row" style="margin-top: 24px; margin-left: 5px;">
                                    <label class="form-label" style="font-size: 16px; color:#2C3D57;"><i class="bi bi-person-square"></i></label>    
                                </div>

                                <div class="row" style="margin-top: 48px; margin-left: 5px;">
                                    <label class="form-label" style="font-size: 16px; color:#2C3D57;"><i class="bi bi-calendar2-fill"></i></label>    
                                </div>

                                <div class="row" style="margin-top: 48px; margin-left: 5px;">
                                    <label class="form-label" style="font-size: 16px; color:#2C3D57;"><i class="bi bi-gender-ambiguous"></i></label>    
                                </div>
                            </div>

                            <div class="col" style="max-width: 220px;">
                                <div class="row" style="margin-top: 24px;">
                                    <a class="ms-3" style="color: #2C3D57; font-size: 16px; margin-left: 10px;"><?php echo $nv["tenchucvu"]; ?></a>
                                </div>

                                <div class="row" style="margin-top: 54px;">                                        
                                    <a class="ms-3" style="color: #2C3D57; font-size: 16px; margin-left: 10px;"><?php echo date("d/m/Y", strtotime($nv["ngaysinh"])); ?></a>                                               
                                </div>

                                <div class="row" style="margin-top: 58px;"> 
                                    <a class="ms-3" style="color: #2C3D57; font-size: 16px; margin-left: 10px;"><?php echo $nv["gioitinh"] == 1 ? "Nam" : "Nữ"; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <div class="col-xl-8 col-lg-7">
            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color:#2C3D57;">
                    <h6 class="m-0 font-weight-bold text-center" style="color:white;">Thông tin chi tiết</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col"> 

                        <div class="my-1">    
                            <label class="form-label">Căn cước công dân</label>
                            <input class="form-control" type="text" name="txtcccd" style="font-size: 13px" value="<?php echo $nv["cccd"]; ?>" readonly>
                        </div>

                            <div class="my-1">    
                                <label class="form-label">Nơi cấp CCCD</label>
                                <input class="form-control" type="text" name="txtnoicapcccd" style="font-size: 13px" value="<?php echo $nv["noicap_cccd"]; ?>" readonly>    
                            </div>  
                            
                            <div class="my-1">    
                                <label class="form-label">Ngày cấp CCCD</label>
                                <input class="form-control" type="text" name="txtngaycapcccd" style="font-size: 13px" value="<?php echo date("d/m/Y", strtotime($nv["ngaycap_cccd"])); ?>" readonly>                        
                            </div>

                            <div class="my-1">    
                                <label class="form-label">Nơi sinh</label>
                                <input class="form-control" type="text" name="txtnoisinh" style="font-size: 13px" value="<?php echo $nv["noisinh"]; ?>" readonly>                        
                            </div>

                            <div class="my-1">    
                                <label class="form-label">Quê quán</label>
                                <input class="form-control" type="text" name="txtquequan" style="font-size: 13px" value="<?php echo $nv["quequan"]; ?>" readonly>    
                            </div> 
                            
                            <div class="my-1">    
                                <label class="form-label">Tạm trú</label>
                                <input class="form-control" type="text" name="txttamtru" style="font-size: 13px" value="<?php echo $nv["tamtru"]; ?>" readonly>                        
                            </div>
                        </div>

                        <div class="col"> 

                            <div class="my-1">    
                                <label class="form-label">Quốc tịch</label>
                                <input class="form-control" type="text" name="txtquoctich" style="font-size: 13px" value="<?php echo $nv["tenquoctich"]; ?>" readonly>    
                            </div> 

                            <div class="my-1">    
                                <label class="form-label">Dân tộc</label>
                                <input class="form-control" type="text" name="txtdantoc" style="font-size: 13px" value="<?php echo $nv["tendantoc"]; ?>" readonly>    
                            </div> 

                            <div class="my-1">    
                                <label class="form-label">Tôn giáo</label>
                                <input class="form-control" type="text" name="txttongiao" style="font-size: 13px" value="<?php echo $nv["tentongiao"]; ?>" readonly>    
                            </div> 

                            <div class="my-1">    
                                <label class="form-label">Trình độ</label>
                                <input class="form-control" type="text" name="txttrinhdo" style="font-size: 13px" value="<?php echo $nv["tentrinhdo"]; ?>" readonly>    
                            </div> 

                            <div class="my-1">    
                                <label class="form-label">Chuyên môn</label>
                                <input class="form-control" type="text" name="txtchuyenmon" style="font-size: 13px" value="<?php echo $nv["tenchuyenmon"]; ?>" readonly>    
                            </div> 

                            <div class="my-1">    
                                <label class="form-label">Bằng cấp</label>
                                <input class="form-control" type="text" name="txtbangcap" style="font-size: 13px" value="<?php echo $nv["tenbangcap"]; ?>" readonly>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>

<div class="container-fluid">
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
					<thead>
						<tr style="background-color:#2C3D57; color: white">
                            <th>STT</th>
							<th>Mã lương</th>
							<th>Lương ngày</th>
							<th>Ngày công</th>
							<th>Lương tháng</th>
							<th>Phụ cấp</th>
                            <th>Khoản nộp</th>
                            <th>Tạm ứng</th>
                            <th>Thực lãnh</th>
							<th>Ngày chấm</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                        $stt = 1;
                        if ($chi_tiet_luong) {
                            foreach ($chi_tiet_luong as $l) {
                                ?>
                                <tr style="color:#2C3D57;font-size: 12px;">
							        <td><?php echo $stt++; ?></td>
                                    <td><?php echo $l["maluong"]; ?></td>
                                    <td><?php echo number_format($nv["luongngay"], 0, ',', '.') . ' VNĐ'; ?></td>
                                    <td class="text-center"><?php echo $l["ngaycong"]; ?></td>
                                    <td><?php echo number_format($l["luongthang"], 0, ',', '.') . ' VNĐ'; ?></td>
                                    <td><?php echo number_format($l["phucap"], 0, ',', '.') . ' VNĐ'; ?></td>
                                    <td style="color: red;"><?php echo number_format($l["khoannop"], 0, ',', '.') . ' VNĐ'; ?></td>
                                    <td><?php echo number_format($l["tamung"], 0, ',', '.') . ' VNĐ'; ?></td>
                                    <td style="color: blue;"><?php echo number_format($l["thuclanh"], 0, ',', '.') . ' VNĐ'; ?></td>
                                    <td class="text-center"><?php echo date("d/m/Y", strtotime($l["ngaychamcong"])); ?></td>
                                </tr>
                                <?php
                            }
                        }
                    ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

  <?php include("../inc/footer.php"); ?>