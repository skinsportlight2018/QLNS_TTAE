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

<link rel="stylesheet" href="../css/table.css">

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
	<div class="container">
		<h1 class="h3 mb-0 custom-heading">Danh sách trình độ</h1>
	</div>
</nav>

<!-- Begin Page Content -->
<div class="container-fluid">
<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="../kttaikhoan/main.php"><i class="fas fa-home"></i> Tổng Quát</a></li>
			<li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Danh sách trình độ</li>
		</ol>
	</nav>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>STT</th>
							<th>Mã trình độ</th>
							<th>Tên trình độ</th>
							<th>Sửa</th>
							<th>Xóa</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($trinhdo as $td) :
							if ($td["id"] == $idsua) {
						?>
								<tr>
									<form method="post" action="index.php?action=capnhat">
										<td><?php echo $td["id"]; ?></td>
										<input type="hidden" name="id" value="<?php echo $td["id"]; ?>">
										<td>
											<input class="form-control" name="matrinhdo" type="text" value="<?php echo $td["matrinhdo"]; ?>">
										</td>
										<td><input class="form-control" name="tentrinhdo" type="text" value="<?php echo $td["tentrinhdo"]; ?>"></td>
										<td><input class="btn btn-success" type="submit" value="Lưu"></td>
									</form>
									<td></td> <!-- Ô xóa -->
								</tr>
							<?php
							} else {
							?>
								<tr>
									<td><?php echo $td["id"]; ?></td>
									<td ondblclick="this.setAttribute('contenteditable', 'true')"><?php echo $td["matrinhdo"]; ?></td>
									<td ondblclick="this.setAttribute('contenteditable', 'true')"><?php echo $td["tentrinhdo"]; ?></td>
									<td><a href="index.php?action=sua&id=<?php echo $td["id"]; ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a></td>
									<td><a href="javascript:void(0);" onclick="showDeleteMessage(<?php echo $td['id']; ?>);" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a></td>
								</tr>
						<?php
							}
						endforeach;
						?>
						<!-- Hàng trống -->
						<tr class="d-none">
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
					<div class="mb-4">
						<button type="button" class="btn btn-primary" onclick="themHangMoi()"><i class="bi bi-file-earmark-plus px-0.5"></i>Thêm</button>
						<button type="button" class="btn btn-info" onclick="themHangMoi()"><i class="bi bi-file-earmark-excel-fill px-0.5"></i>Excel</button>
					</div>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	function themHangMoi() {
		var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
		var rowCount = <?php echo count($trinhdo); ?>;
		var newRow = table.insertRow();
		newRow.innerHTML = "<td>" + (rowCount + 1) + "</td><td contenteditable='true'></td><td contenteditable='true'></td><td><button type='button' class='btn btn-success' onclick='luuHangMoi(this.parentNode.parentNode)'>Lưu</button></td><td></td>";
	}


	function luuHangMoi(row) {
		var maTrinhDo = row.cells[1].innerHTML;
		var tenTrinhDo = row.cells[2].innerHTML;

		var xhr = new XMLHttpRequest();
		xhr.open("POST", "index.php?action=them", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				window.location.reload();
			}
		};
		xhr.send("tentrinhdo=" + encodeURIComponent(tenTrinhDo) + "&matrinhdo=" + encodeURIComponent(maTrinhDo));
	}

	document.addEventListener("DOMContentLoaded", function() {
		var rows = document.querySelectorAll("#myTable tbody tr");
		rows.forEach(function(row) {
			var cells = row.cells;
			for (var i = 1; i <= 2; i++) {
				cells[i].addEventListener('dblclick', function() {
					this.setAttribute('contenteditable', 'true');
				});
				cells[i].addEventListener('blur', function() {
					saveRow(this.parentNode);
					showSuccessMessage("Đã cập nhật thành công!");
				});
			}
		});
	});


	function saveRow(row) {
		var id = row.cells[0].innerHTML; // Lấy id của hàng
		var maTrinhDo = row.cells[1].innerHTML; // Lấy mã chuyên môn từ ô đầu tiên của hàng
		var tenTrinhDo = row.cells[2].innerHTML; // Lấy tên chuyên môn từ ô thứ hai của hàng

		var xhr = new XMLHttpRequest();
		xhr.open("POST", "index.php?action=capnhat", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				// Có thể thêm xử lý sau khi cập nhật thành công
			}
		};
		xhr.send("id=" + encodeURIComponent(id) + "&tentrinhdo=" + encodeURIComponent(tenTrinhDo) + "&matrinhdo=" + encodeURIComponent(maTrinhDo));
	}
</script>

<!-- End of Main Content -->
<?php include("../inc/footer.php"); ?>