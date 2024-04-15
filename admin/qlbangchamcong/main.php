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
                        <td><?php echo $ct["id"]; ?></td>
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


<style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>

<body>

<h2>Bảng Chấm Công</h2>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Mã Lương</th>
      <th>ID Nhân Viên</th>
      <th>Lương Tháng</th>
      <th>Ngày Công</th>
      <th>Phụ Cấp</th>
      <th>Khoản Nộp</th>
      <th>Tạm Ứng</th>
      <th>Lương Thực Lãnh</th>
      <th>Ngày Chấm Công</th>
      <th>Ghi Chú</th>
    </tr>
  </thead>
  <tbody>
    <?php
        // Kết nối đến cơ sở dữ liệu
        $dbcon = new PDO('mysql:host=localhost;dbname=ten_csdl', 'username', 'password');
        
        // Truy vấn dữ liệu từ bảng chấm công
        $stmt = $dbcon->query('SELECT * FROM bangchamcong');
        $bangchamcong = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Hiển thị dữ liệu trong bảng
        foreach ($bangchamcong as $row) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['maluong']}</td>";
            echo "<td>{$row['nhanvien_id']}</td>";
            echo "<td>{$row['luongthang']}</td>";
            echo "<td>{$row['ngaycong']}</td>";
            echo "<td>{$row['phucap']}</td>";
            echo "<td>{$row['khoannop']}</td>";
            echo "<td>{$row['tamung']}</td>";
            echo "<td>{$row['thuclanh']}</td>";
            echo "<td>{$row['ngaychamcong']}</td>";
            echo "<td>{$row['ghichu']}</td>";
            echo "</tr>";
        }
    ?>
  </tbody>
</table>

</body>
<!-- End of Main Content -->
<?php include("../inc/footer.php"); ?>
