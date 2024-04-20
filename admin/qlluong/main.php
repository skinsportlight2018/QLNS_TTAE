<?php
include("../inc/sidebar.php");
include("../inc/top.php");

// Kiểm tra xem session đã được khởi tạo hay chưa
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

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

<link rel="stylesheet" href="../css/table.css">

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
	<div class="container">
		<h1 class="h3 mb-0 custom-heading">Bảng lương nhân viên</h1>
	</div>
</nav>

<!-- Begin Page Content -->
<div class="container-fluid">
<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="../kttaikhoan/main.php"><i class="fas fa-home"></i> Tổng Quát</a></li>
			<li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Bảng lương nhân viên</li>
		</ol>
	</nav>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">

				<div class="mb-4 d-flex align-items-center">
					<a href="../qltinhluong/index.php" class="btn btn-primary mr-2">
						<i class="bi bi-file-earmark-plus px-0.5"></i>Tính lương
					</a>
					<a href="exportLuong.php" class="btn btn-info mr-2">
						<i class="bi bi-file-earmark-excel-fill px-0.5"></i>Excel
					</a>
					<button type="button" class="btn btn-search" onclick="searchByMonth()">
						<i class="bi bi-search"></i>
					</button>
					<input type="month" class="form-control" id="searchMonth" name="searchMonth" style="width: 195px;margin-left:10px;">
				</div>


				<table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>STT</th>
							<th>Mã lương</th>
							<th>Tên nhân viên</th>
							<th>Chức vụ</th>
							<th>Lương tháng</th>
							<th>Ngày công</th>
							<th>Thực lãnh</th>
							<th>Ngày chấm</th>
							<th>Chi tiết</th>
							<th>Xóa</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($luong) {
							$stt = 1;
							foreach ($luong as $l) :
						?>
								<tr>
									<td><?php echo $stt++; ?></td>
									<td><?php echo $l["maluong"]; ?></td>
									<td><?php echo $l["hotennv"]; ?></td>
									<td><?php echo $l["tenchucvu"]; ?></td>
									<td><?php echo number_format($l["luongthang"], 0, ',', '.') . ' VNĐ'; ?></td>
									<td class="text-center"><?php echo $l["ngaycong"]; ?></td>
									<td><?php echo number_format($l["thuclanh"], 0, ',', '.') . ' VNĐ'; ?></td>
									<td class="text-center"><?php echo date("d/m/Y", strtotime($l["ngaychamcong"])); ?></td>

									<td><a class="btn btn-info" href="index.php?action=chitiet&id=<?php echo $l["nhanvien_id"]; ?>"><i class="align-middle fas fa-eye"></i></a></td>
									<td><a href="javascript:void(0);" onclick="showDeleteMessage(<?php echo $l['id']; ?>);" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a></td>
								</tr>
						<?php
							endforeach;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- End of Main Content -->
<?php include("../inc/footer.php"); ?>