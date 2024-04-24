<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Quản lý nhân sự American English</title>

	<!-- Custom fonts for this template-->
	<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="../css/sb-admin-2.min.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
	<link href="../inc/css/sidebar.css" rel="stylesheet">
	<link href="../inc/css/datatable.css" rel="stylesheet">
	<link href="../inc/css/styles.css" rel="stylesheet">

	<!-- SweetAlert2 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

	<!-- SweetAlert2 JS -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>

	<script src="../js/message.js"></script>
	<link href="../inc/css/breadcrumb .css" rel="stylesheet">


</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-custom-color sidebar sidebar-dark accordion;" id="accordionSidebar">
			<!-- Sidebar - Brand -->
			<div>
				<a class="sidebar-brand d-flex align-items-center justify-content-center" href="../kttaikhoan/main.php" style="margin-bottom: 50px;">
					<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 40px;">
						<div style="text-transform: uppercase; font-size: 80px; font-family: 'Sorts Mill Goudy', serif; margin-top: 20px;">AE</div>
						<div style="font-size: 9px; text-align: left; margin-left: 5px; color: white;">the &star; American English School in An Giang</div>
					</div>
				</a>
			</div>

			<!-- Bảng lề trái quản lý nhân viên-->

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item active">
				<a class="nav-link" href="../kttaikhoan/main.php">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Tổng quan</span></a>
			</li>
			<?php if (isset($_SESSION["taikhoan"]) && $_SESSION["taikhoan"]["quyen"] == 1 || $_SESSION["taikhoan"]["quyen"] == 2) { ?>

				<!-- Divider -->
				<hr class="sidebar-divider my-0">

				<!-- Nav Item - Pages Collapse Menu -->
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNhanVien" aria-expanded="true" aria-controls="collapseNhanVien">
						<i class="bi bi-person-fill"></i>
						<span>Nhân viên</span>
					</a>
					<div id="collapseNhanVien" class="collapse" aria-labelledby="headingNhanVien" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<a class="collapse-item" href="../qlnhanvien/index.php">Danh sách nhân viên</a>
							<a class="collapse-item" href="../qlloainhanvien/index.php">Hình thức nhân viên</a>
							<a class="collapse-item" href="../qlchucvu/index.php">Chức vụ</a>
							<a class="collapse-item" href="../qltrinhdo/index.php">Trình độ</a>
							<a class="collapse-item" href="../qlchuyenmon/index.php">Chuyên môn</a>
							<a class="collapse-item" href="../qlbangcap/index.php">Bằng cấp</a>
							<a class="collapse-item" href="../qlquoctich/index.php">Quốc tịch</a>
							<a class="collapse-item" href="../qldantoc/index.php">Dân tộc</a>
							<a class="collapse-item" href="../qltongiao/index.php">Tôn giáo</a>

						</div>
					</div>
				</li>
			<?php } ?>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Utilities Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLuong" aria-expanded="true" aria-controls="collapseLuong">
					<i class="bi bi-cash-coin"></i>
					<span>Lương</span>
				</a>
				<div id="collapseLuong" class="collapse" aria-labelledby="headingLuong" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<a class="collapse-item" href="../qltinhluong/index.php">Tính lương</a>
						<a class="collapse-item" href="../qlluong/index.php">Bảng lương</a>

						<a class="collapse-item" href="../qlluong/index.php">Bảng lương</a>
					</div>
				</div>



			</li>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Utilities Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseChamcong" aria-expanded="true" aria-controls="collapseChamcong">
					<i class="bi bi-pencil-square"></i>
					<span>Chấm công</span>
				</a>
				<div id="collapseChamcong" class="collapse" aria-labelledby="headingChamcong" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<a class="collapse-item" href="../qldschamcong/index.php?action=them">Chấm công</a>
						<a class="collapse-item" href="../qlbangchamcong/index.php">Bảng chấm công</a>

						<?php if (isset($_SESSION["taikhoan"]) && $_SESSION["taikhoan"]["quyen"] == 1 || $_SESSION["taikhoan"]["quyen"] == 2) { ?>
							<a class="collapse-item" href="../qlchamcong/index.php">Duyệt chấm công</a>
						<?php } ?>

						<a class="collapse-item" href="../qldschamcong/index.php">Danh sách chấm công</a>
					</div>
				</div>
			</li>


			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Utilities Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLichlamviec" aria-expanded="true" aria-controls="collapseLichlamviec">
					<i class="bi bi-calendar"></i>
					<span>Lịch làm việc</span>
				</a>
				<div id="collapseLichlamviec" class="collapse" aria-labelledby="headingLichlamviec" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<a class="collapse-item" href="">Lịch</a>
						<a class="collapse-item" href="">Danh sách lịch làm việc</a>
					</div>
				</div>
			</li>


			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
					<i class="bi bi-person-bounding-box"></i>
					<span>Công tác</span>
				</a>
				<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<a class="collapse-item" href="../qlcongtac/index.php">Danh sách công tác</a>
					</div>
				</div>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Charts -->
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGroup" aria-expanded="true" aria-controls="collapseGroup">
					<i class="bi bi-people-fill"></i>
					<span>Nhóm nhân viên</span>
				</a>
				<div id="collapseGroup" class="collapse" aria-labelledby="headingGroup" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<a class="collapse-item" href="">Danh sách nhóm</a>
					</div>
				</div>
			</li>

			<?php if (isset($_SESSION["taikhoan"]) && $_SESSION["taikhoan"]["quyen"] == 1) { ?>
				<!-- Divider -->
				<hr class="sidebar-divider my-0">

				<!-- Nav Item - Tables -->
				<li class="nav-item">

					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAccount" aria-expanded="true" aria-controls="collapseAccount">
						<i class="bi bi-gear-fill"></i>
						<span>Tài khoản</span>
					</a>

					<div id="collapseAccount" class="collapse <?php if (strpos($_SERVER['REQUEST_URI'], "qltaikhoan") !== false) echo "active"; ?>" aria-labelledby="headingAccount" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<a class="collapse-item " href="../qltaikhoan/index.php">Danh sách tài khoản</a>
						</div>
					</div>
				<?php } ?>

				</li>


				<!-- Divider -->
				<hr class="sidebar-divider d-none d-md-block">

				<!-- Sidebar Toggler (Sidebar) -->
				<div class="text-center d-none d-md-inline">
					<button class="rounded-circle border-0" id="sidebarToggle"></button>
				</div>


		</ul>

		<!-- End of Sidebar -->