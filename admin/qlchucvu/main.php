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
		<h1 class="h3 mb-0 custom-heading">Danh sách chức vụ</h1>
	</div>
</nav>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>STT</th>
							<th>Mã chức vụ</th>
							<th>Tên chức vụ</th>
							<th>Lương ngày</th>
							<th>Sửa</th>
							<th>Xóa</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($chucvu as $cv) :
							if ($cv["id"] == $idsua) {
						?>
								<tr>
									<form method="post" action="index.php?action=capnhat">
										<td><?php echo $cv["id"]; ?></td>
										<input type="hidden" name="id" value="<?php echo $cv["id"]; ?>">
										<td>
											<input class="form-control" name="machucvu" type="text" value="<?php echo $cv["machucvu"]; ?>">
										</td>
										<td><input class="form-control" name="tenchucvu" type="text" value="<?php echo $cv["tenchucvu"]; ?>"></td>
										<td><input class="form-control" name="luongngay" type="text" value="<?php echo $cv["luongngay"]; ?>"></td>
										<td><input class="btn btn-success" type="submit" value="Lưu"></td>
									</form>
									<td></td> <!-- Ô xóa -->
								</tr>
							<?php
							} else {
							?>
								<tr>
									<td><?php echo $cv["id"]; ?></td>
									<td ondblclick="this.setAttribute('contenteditable', 'true')"><?php echo $cv["machucvu"]; ?></td>
									<td ondblclick="this.setAttribute('contenteditable', 'true')"><?php echo $cv["tenchucvu"]; ?></td>
									<td ondblclick="this.setAttribute('contenteditable', 'true')"><?php echo number_format($cv["luongngay"]); ?> VNĐ</td>
									<td><a href="index.php?action=sua&id=<?php echo $cv["id"]; ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a></td>
									<td><a href="javascript:void(0);" onclick="showDeleteMessage(<?php echo $cv['id']; ?>);" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a></td>
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
							<td></td>
						</tr>
					</tbody>
					<div class="mb-4">
						<button type="button" class="btn btn-primary" onclick="themHangMoi()"><i class="bi bi-file-earmark-plus px-0.5"></i>Thêm</button>
						<button type="button" class="btn btn-info"><i class="bi bi-file-earmark-excel-fill px-0.5"></i>Excel</button>
					</div>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	function themHangMoi() {
		var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
		var rowCount = <?php echo count($chucvu); ?>;
		var newRow = table.insertRow();
		newRow.innerHTML = "<td>" + (rowCount + 1) + "</td><td contenteditable='true'></td><td contenteditable='true'></td><td contenteditable='true'></td><td><button type='button' class='btn btn-success' onclick='luuHangMoi(this.parentNode.parentNode)'>Lưu</button></td><td></td>";
	}

	function luuHangMoi(row) {
		var maChucVu = row.cells[1].innerHTML;
		var tenChucVu = row.cells[2].innerHTML;
		var luongNgay = row.cells[3].innerHTML;

		var xhr = new XMLHttpRequest();
		xhr.open("POST", "index.php?action=them", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				window.location.reload();
			}
		};
		xhr.send("luongngay=" + encodeURIComponent(luongNgay) 
				+ "&tenchucvu=" + encodeURIComponent(tenChucVu) 
				+ "&machucvu=" + encodeURIComponent(maChucVu));
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
    var maChucVu = row.cells[1].innerHTML; // Lấy mã chuyên môn từ ô đầu tiên của hàng
    var tenChucVu = row.cells[2].innerHTML; // Lấy tên chuyên môn từ ô thứ hai của hàng
    var luongNgay = row.cells[3].innerHTML; // Lấy giá trị từ ô input

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "index.php?action=capnhat", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Có thể thêm xử lý sau khi cập nhật thành công
        }
    };
    xhr.send("id=" + encodeURIComponent(id) 
			+ "&luongngay=" + encodeURIComponent(luongNgay) 
			+ "&tenchucvu=" + encodeURIComponent(tenChucVu)
			+ "&machucvu=" + encodeURIComponent(maChucVu));
}

</script>

<!-- End of Main Content -->
<?php include("../inc/footer.php"); ?>