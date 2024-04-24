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
		<h1 class="h3 mb-0 custom-heading">Danh sách nhân viên</h1>
	</div>
</nav>

<!-- Begin Page Content -->
<div class="container-fluid">
<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="../kttaikhoan/main.php"><i class="fas fa-home"></i> Tổng Quát</a></li>
			<li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Danh sách nhân viên</li>
		</ol>
	</nav>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
					<thead >
						<tr>
							<th>STT</th>
							<th>Mã nhân viên</th>
							<th>Hình ảnh</th>
							<th>Tên nhân viên</th>
							<th>Chức vụ</th>
							<th>Giới tính</th>
							<th>Ngày sinh</th>
							<th>Số CCCD</th>
							<th>Tình trạng</th>
							<th>Xem</th>
							<th>Sửa</th>
							<th>Xóa</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$stt = 1;
						foreach ($nhanvien as $nv) :
						?>
							<tr>
								<td><?php echo $stt++; ?></td>
								<td><?php echo $nv["manv"]; ?></td>
								<td>
									<a>
										<img src="../img/Avatar/<?php echo $nv["hinhanh"]; ?>" width="95">
									</a>
								</td>
								<td><?php echo $nv["hotennv"]; ?></td>
								<td><?php echo $nv["tenchucvu"]; ?></td>
								<td><?php echo $nv["gioitinh"] == 1 ? "Nam" : "Nữ"; ?></td>
								<td><?php echo date("d/m/Y", strtotime($nv["ngaysinh"])); ?></td>
								<td><?php echo $nv["cccd"]; ?></td>
								<td>
								<?php if($nv["trangthai"] == 1): ?>
									<div class="bg-success text-white rounded-pill py-1 px-2">
										Đang làm việc
									</div>
								<?php else: ?>
									<div class="bg-danger text-white rounded-pill py-1 px-2">
										Đã nghỉ việc
									</div>
								<?php endif; ?>
								</td>

								<td><a class="btn btn-info" href="index.php?action=chitiet&id=<?php echo $nv["id"]; ?>"><i class="align-middle fas fa-eye"></i></a></td>
								<td><a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $nv["id"]; ?>"><i class="align-middle fas fa-edit"></i></a></td>
								<td><a href="javascript:void(0);" onclick="showDeleteMessage(<?php echo $nv['id']; ?>);" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a></td>

							</tr>
						<?php
						endforeach;
						?>
					</tbody>
					<div class="mb-4">
						<a href="index.php?action=them" class="btn btn-primary">
							<i class="bi bi-file-earmark-plus px-0.5"></i>Thêm
						</a>
						<a href="exportNV.php" class="btn btn-info">
							<i class="bi bi-file-earmark-excel-fill px-0.5"></i>Excel
						</a>
						<a href="exportPDFnv.php" class="btn btn-danger">
							<i class="bi bi-file-earmark-excel-fill px-0.5"></i>PDF
						</a>
					</div>
				</table>
			</div>

			<?php
				// Kiểm tra nếu $anh_nhanvien không rỗng và là một mảng hoặc đối tượng
				if (!empty($anh_nhanvien) && (is_array($anh_nhanvien) || is_object($anh_nhanvien))) {
					// Lặp qua mảng $anh_nhanvien và hiển thị ảnh nhân viên
					foreach ($anh_nhanvien as $anh) {
						echo '<div class="col-md-3">';
						echo '<img src="' . $anh . '" class="img-fluid">';
						echo '</div>';
					}
				} else {
					// Xử lý trường hợp khi $anh_nhanvien không tồn tại hoặc không hợp lệ
					echo "Dữ liệu ảnh nhân viên không hợp lệ.";
				}
				?>
		</div>
	</div>
</div>


<!-- End of Main Content -->
<?php include("../inc/footer.php"); ?>