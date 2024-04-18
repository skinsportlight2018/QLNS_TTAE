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
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
					<thead >
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
						?>
					</tbody>
					<div class="mb-4">
						<a href="index.php?action=them" class="btn btn-primary">
							<i class="bi bi-file-earmark-plus px-0.5"></i>Tính lương
						</a>
						<a href="exportNV.php" class="btn btn-info">
							<i class="bi bi-file-earmark-excel-fill px-0.5"></i>Excel
						</a>
					</div>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- End of Main Content -->
<?php include("../inc/footer.php"); ?>