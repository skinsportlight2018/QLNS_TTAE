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
		<h1 class="h3 mb-0 custom-heading">Danh sách công tác</h1>
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
							<th>Mã công tác</th>
							<th>Tên nhân viên</th>
							<th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
							<th>Địa điểm</th>
							<th>Nhiệm vụ công tác</th>
							<th>Ghi chú</th>
                            <th>Trạng thái</th>
							<th>Sửa</th>
							<th>Xóa</th>
						</tr>
					</thead>
					<tbody>
                    <?php
					$stt = 1;
                    foreach ($congtac as $ct):
                        if (isset($ct["ngaybd"]) && isset($ct["ngaykt"])) {
                            $ngayBatDau = date("d/m/Y", strtotime($ct["ngaybd"]));
                            $ngayKetThuc = date("d/m/Y", strtotime($ct["ngaykt"]));

                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $ngayHomNay = date("d/m/Y");

                            if ($ngayHomNay >= $ngayBatDau && $ngayHomNay <= $ngayKetThuc) {
                                $trangThai = '<div class="bg-success text-white rounded-pill py-1 px-2 text-center">Đang công tác</div>';
                            } elseif ($ngayHomNay > $ngayKetThuc) {
                                $trangThai = '<div class="bg-danger text-white rounded-pill py-1 px-2 text-center">Đã hết hạn</div>';
                            }
                        } else {
							$trangThai = "";
						}
                    ?>

                    <tr>
                        <td><?php echo $stt++; ?></td>
                        <td><?php echo $ct["macongtac"]; ?></td>
                        <td><?php echo $ct["hotennv"]; ?></td>
                        <td><?php echo $ngayBatDau; ?></td>
                        <td><?php echo $ngayKetThuc; ?></td>
                        <td><?php echo $ct["diadiem"]; ?></td>
                        <td><?php echo $ct["nhiemvu_congtac"]; ?></td>
                        <td><?php echo $ct["ghichu"]; ?></td>
                        <td><?php echo $trangThai; ?></td>
                        <td><a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $ct["id"]; ?>"><i class="align-middle fas fa-edit"></i></a></td>
                        <td><a href="javascript:void(0);" onclick="showDeleteMessage(<?php echo $ct['id']; ?>);" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a></td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
					</tbody>
					<div class="mb-4">
						<a href="index.php?action=them" class="btn btn-primary">
							<i class="bi bi-file-earmark-plus px-0.5"></i>Thêm
						</a>
					</div>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- End of Main Content -->
<?php include("../inc/footer.php"); ?>
