<?php
include("../inc/sidebar.php");
include("../inc/top.php");

$conn = mysqli_connect("localhost", "root", "", "qlns_ttae");
if (!$conn) {
    die("Kết nối không thành công: " . mysqli_connect_error());
}

$chucvu = array(); // Khởi tạo mảng để lưu trữ dữ liệu chức vụ từ CSDL
// Truy vấn CSDL để lấy dữ liệu chức vụ
        // Truy vấn CSDL để lấy dữ liệu chức vụ
$sql_chucvu = "SELECT * FROM chucvu";
$result_chucvu = mysqli_query($conn, $sql_chucvu);

// Kiểm tra và lưu trữ dữ liệu chức vụ vào mảng $chucvu
if (mysqli_num_rows($result_chucvu) > 0) {
    while ($row_chucvu = mysqli_fetch_assoc($result_chucvu)) {
        $chucvu[] = $row_chucvu;
    }
}

$nhanvien = array(); // Khởi tạo mảng để lưu trữ dữ liệu chức vụ từ CSDL
// Truy vấn CSDL để lấy dữ liệu chức vụ
        // Truy vấn CSDL để lấy dữ liệu chức vụ
        $sql_nhanvien = "SELECT n.*, c.tenchucvu 
        FROM nhanvien n 
        INNER JOIN chucvu c ON n.chucvu_id = c.id";
$result_nhanvien = mysqli_query($conn, $sql_nhanvien);

// Kiểm tra và lưu trữ dữ liệu chức vụ vào mảng $chucvu
if (mysqli_num_rows($result_nhanvien) > 0) {
    while ($row_nhanvien = mysqli_fetch_assoc($result_nhanvien)) {
        $nhanvien[] = $row_nhanvien;
    }
}

$luong = array(); // Khởi tạo mảng để lưu trữ dữ liệu chức vụ từ CSDL
// Truy vấn CSDL để lấy dữ liệu chức vụ
        // Truy vấn CSDL để lấy dữ liệu chức vụ
        $sql_luong = "SELECT l.*, nv.hotennv, cv.tenchucvu
        FROM luong l 
        INNER JOIN nhanvien nv ON l.nhanvien_id = nv.id 
        INNER JOIN chucvu cv ON nv.chucvu_id = cv.id
        ORDER BY l.id DESC";
$result_luong = mysqli_query($conn, $sql_luong);

// Kiểm tra và lưu trữ dữ liệu chức vụ vào mảng $chucvu
if (mysqli_num_rows($result_luong) > 0) {
    while ($row_luong = mysqli_fetch_assoc($result_luong)) {
        $luong[] = $row_luong;
    }
}

// Truy vấn để đếm số lượng nhân viên
$sql = "SELECT COUNT(*) AS total FROM nhanvien";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalEmployees = $row['total'];

// Truy vấn để đếm số lượng nhân viên
$sql = "SELECT COUNT(*) AS total FROM taikhoan";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalTK = $row['total'];

// Truy vấn để đếm số lượng nhân viên
$sql = "SELECT COUNT(*) AS total FROM congtac";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalCT = $row['total'];

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" href="../css/table1.css">
<link rel="stylesheet" href="../css/main2.css">
<!-- Hàng số 1 -->
<div class="container-fluid">

    <!-- Phần button quản lý -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <div class="container">
            <h1 class="h3 mb-0 text-gray-800">Bảng điều khiển</h1>
        </div>
    </nav>
    <div class="row">
        <!-- Ô số 1 -->
        <div class="col">
            <div class="rounded-box1">
                <div class="icon1">
                    <lord-icon src="https://cdn.lordicon.com/lhwyshcs.json" trigger="loop" stroke="bold" state="hover-nodding" colors="primary:#ffffff,secondary:#b4b4b4" style="width:100px;height:100px">
                    </lord-icon>                
                </div>

                <div class="rounded-box">
                    <div class="right-box1">
                        <a href="../qlnhanvien/index.php" style="font-size: 15px; margin-top:20px;">NHÂN VIÊN</a>
                        <a style="font-size: 22px;"><?php echo $totalEmployees; ?></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ô số 2 -->
        <div class="col">
            <div class="rounded-box1">
                <div class="icon1">
                    <script src="https://cdn.lordicon.com/lordicon.js"></script>
                    <lord-icon src="https://cdn.lordicon.com/kndkiwmf.json" trigger="loop" stroke="bold" colors="primary:#ffffff,secondary:#ffc738" style="width:100px;height:100px">
                    </lord-icon>
                </div>

                <div class="rounded-box">
                    <div class="right-box1">
                        <a href="../qlluong/index.php" style="font-size: 15px; margin-top:20px;">LƯƠNG</a>
                        <a id="thangnay" style="font-size: 22px;">
                            <script>
                                var thangnay = new Date();
                                thangnay.setHours(thangnay.getHours() + 7);
                                var thang = String(thangnay.getMonth() + 1).padStart(2, '');
                                document.getElementById('thangnay').innerText += 'Tháng ' + thang;
                            </script>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ô số 3 -->
        <div class="col">
            <div class="rounded-box1">
                <div class="icon1">
                    <img src="../img/icon/icons8-calendar.gif" alt="Corruption" trigger="loop" stroke="bold" colors="primary:#ffffff,secondary:#ffc738" style="width:50px;height:50px" />
                </div>

                <div class="rounded-box">
                    <div class="right-box1">
                        <a href="../qllichlamviec/index.php" style="font-size: 15px; margin-top:20px;">LỊCH LÀM VIỆC</a>
                        <a id="ngayhomnay" style="font-size: 22px;">
                            <script>
                                var homnay = new Date();
                                // Chuyển múi giờ sang múi giờ Việt Nam (GMT+7)
                                homnay.setHours(homnay.getHours() + 7);
                                var ngay = String(homnay.getDate()).padStart(2, '0');
                                var thang = String(homnay.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0
                                var nam = homnay.getFullYear();
                                document.getElementById('ngayhomnay').innerText += ngay + '/' + thang + '/' + nam;
                            </script>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ô số 4 -->
        <div class="col">
            <div class="rounded-box1">
                <div class="icon1">
                    <lord-icon src="https://cdn.lordicon.com/qmsejndz.json" trigger="in" stroke="bold" state="morph-open" colors="primary:#ffffff,secondary:#eeaa66" style="width:100px;height:100px">
                    </lord-icon>     
                </div>

                <div class="rounded-box">
                    <div class="right-box1">
                        <a href="../qlcongtac/index.php" style="font-size: 15px; margin-top:20px;">LỊCH CÔNG TÁC</a>
                        <a style="font-size: 22px;"><?php echo $totalCT; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Ô số 5 -->
        <div class="col">
            <div class="rounded-box1">
                <div class="icon1">
                    <lord-icon src="https://cdn.lordicon.com/wzrwaorf.json" trigger="loop" colors="primary:#e4e4e4,secondary:#faf9d1" style="width:100px;height:100px">
                    </lord-icon>
                </div>

                <div class="rounded-box">
                    <div class="right-box1">
                        <a href="../qlnhom/index.php" style="font-size: 15px; margin-top:20px;">NHÓM</a>
                        <a style="font-size: 22px;">3</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ô số 6 -->
        <div class="col">
            <div class="rounded-box1">
                <div class="icon1">
                    <lord-icon src="https://cdn.lordicon.com/xcxzayqr.json" trigger="in" delay="50" stroke="bold" state="in-reveal" colors="primary:#ffffff,secondary:#faf9d1" style="width:100px;height:100px">
                    </lord-icon>                
                </div>

                <div class="rounded-box">
                    <div class="right-box1">
                        <a href="../qltaikhoan/index.php" style="font-size: 15px; margin-top:20px;">TÀI KHOẢN</a>
                        <a style="font-size: 22px;"><?php echo $totalTK; ?></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ô số 7 -->
        <div class="col">
            <div class="rounded-box1">
                <div class="icon1">
                    <img width="100" height="100" src="https://img.icons8.com/fluency/240/ms-excel.png" alt="ms-excel" />
                </div>

                <div class="rounded-box">
                    <div class="right-box1">
                        <a href="../qltaikhoan/index.php" style="font-size: 15px; margin-top:30px;">XUẤT DANH SÁCH NHÂN VIÊN</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="rounded-box1">
                <div class="icon1">
                    <img width="100" height="100" src="https://img.icons8.com/fluency/240/ms-excel.png" alt="ms-excel" />
                </div>

                <div class="rounded-box">
                    <div class="right-box1">
                        <a href="../qltaikhoan/index.php" style="font-size: 15px; margin-top:30px;">XUẤT DANH SÁCH LƯƠNG</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hàng số 2: Lương nhân viên của Trung tâm ngoại ngữ American English -->

    <!-- Hàng số 3: Lịch làm việc của Trung tâm ngoại ngữ American English -->

    <!-- Hàng số 4: Lịch công tác của Trung tâm ngoại ngữ American English -->

    <!-- Hàng số 5: Lịch làm việc của Trung tâm ngoại ngữ American English -->

    <!-- Hàng số 6: Lịch làm việc của Trung tâm ngoại ngữ American English -->

    <style>
        #pieChart {
            height: 100%;
            width: 100%;
        }
    </style>

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" href="../qlbangcap/index.php">
        <div class="container">
            <h1 class="h3 mb-0 text-gray-800">Thống kê danh sách</h1>
        </div>
    </nav>

<div class="container-fluid">
    <div class="row flex-row-reverse"> <!-- Thay đổi lớp thành flex-row-reverse -->
        <!-- Area Chart -->
       

        <!-- Bảng Chức vụ -->
        <div class="col-xl-3.05 col-lg-6 flex-column-reverse"> <!-- Thay đổi lớp thành flex-column-reverse -->
            <div class="card shadow mb-6">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã nhân viên</th>
                                        <th>Tên nhân viên</th>
                                        <th>Chức vụ</th>
                                        <th>Xem</th>
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
                                    <td><?php echo $nv["hotennv"]; ?></td>
                                    <td><?php echo $nv["tenchucvu"]; ?></td>							
                                    <td><a class="btn btn-info" href="index.php?action=chitiet&id=<?php echo $nv["id"]; ?>"><i class="align-middle fas fa-eye"></i></a></td>

                                </tr>
                            <?php
                            endforeach;
                            ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            
            </div>
            <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-5">
                <!-- Card Body -->
                <div class="card-body">
                    <canvas id="pieChart"></canvas>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã chức vụ</th>
                                    <th>Tên chức vụ</th>
                                    <th>Lương ngày</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stt=1;
                                foreach ($chucvu as $cv) :
                                ?>
                                        <tr>
                                            <td><?php echo $stt++; ?></td>
                                            <td><?php echo $cv["machucvu"]; ?></td>
                                            <td><?php echo $cv["tenchucvu"]; ?></td>
                                            <td><?php echo number_format($cv["luongngay"], 0, ',', '.'); ?></td>
                                        </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
            
        </div>
            </div>

            
</div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '../model/getdata.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var labels = [];
                    var values = [];
                    data.forEach(function(item) {
                        labels.push(item.tenchucvu);
                        values.push(item.soLuong);
                    });

                    // Vẽ biểu đồ khi dữ liệu đã được tải
                    drawPieChart(labels, values);
                }
            });
        });

        function drawPieChart(labels, values) {
            var ctx = document.getElementById('pieChart').getContext('2d');
            var total = values.reduce((acc, val) => acc + val, 0);
            var percentages = values.map(val => ((val / total) * 100).toFixed(2));
            var backgroundColors = [
                'rgba(255, 99, 132, 0.7)', // Đỏ
                'rgba(54, 162, 235, 0.7)', // Xanh dương
                'rgba(255, 205, 86, 0.7)', // Vàng
                'rgba(75, 192, 192, 0.7)', // Xanh lá cây
                'rgba(153, 102, 255, 0.7)', // Tím
                'rgba(255, 159, 64, 0.7)', // Cam
                'rgba(19, 216, 19, 0.7)', // Cam
                'rgba(242, 16, 16, 0.7)' // Cam
            ];

            var pieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: backgroundColors,
                        borderColor: '#ffffff',
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        datalabels: {
                            formatter: (value, ctx) => {
                                let percentage = percentages[ctx.dataIndex];
                                return percentage + "%"; // Thêm ký tự % vào giá trị phần trăm
                            },
                            color: '#fff',
                            display: {
                                // Hiển thị số phần trăm
                                display: true
                            }
                        }
                    },
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: 'Biểu đồ phân phối nhân sự theo chức vụ'
                    },
                    // Thêm sự kiện click để chuyển hướng
                    onClick: function(event, chartElement) {
                        if (chartElement.length > 0) {
                            var activeIndex = chartElement[0]._index;
                            var selectedLabel = labels[activeIndex];
                            // Chuyển hướng tới trang ../qlnhanvien/index.php
                            window.location.href = '../qlnhanvien/index.php?selectedLabel=' + selectedLabel;
                        }
                    }
                }
            });
        }
    </script>

</div>
<div style="margin-left:25px; margin-right:20px; margin-top:20px;">
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <div class="container">
            <h1 class="h3 mb-0 text-gray-800">Lương nhân viên tháng <?php echo date("m/Y"); ?></h1>
        </div>
    </nav>

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
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0; // Biến đếm
        if ($luong) {
            $stt = 1;
            foreach ($luong as $l) :
                if ($count < 20) { // Chỉ hiển thị tối đa 30 dòng
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
                    </tr>
                    <?php
                    $count++; // Tăng biến đếm sau mỗi lần hiển thị dòng
                } else {
                    break; // Nếu đã hiển thị đủ 30 dòng thì dừng vòng lặp
                }
            endforeach;
        }
        ?>
    </tbody>
</table>
			</div>
		</div>
	</div>
    </div>
<!-- /.container-fluid -->
<!-- End of Main Content -->
<?php include("../inc/footer.php"); ?>