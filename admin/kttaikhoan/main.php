<?php
include("../inc/sidebar.php");
include("../inc/top.php");

$conn = mysqli_connect("localhost", "root", "", "qlns_ttae");
if (!$conn) {
    die("Kết nối không thành công: " . mysqli_connect_error());
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

<link rel="stylesheet" href="../css/main2.css">
<!-- Hàng số 1 -->
<div class="container-fluid">

    <!-- Phần button quản lý -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" href="../qlbangcap/index.php">
        <div class="container">
            <h1 class="h3 mb-0 text-gray-800">Bảng điều khiển</h1>
        </div>
    </nav>
    <div class="row">
        <!-- Ô số 1 -->
        <div class="col">
            <div class="rounded-box1">
                <div class="icon1">
                    <i class="bi bi-person-fill"></i>
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
                    <i class="bi bi-cash-coin"></i>
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
                    <i class="bi bi-calendar"></i>
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
                    <i class="bi bi-person-bounding-box"></i>
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
                    <i class="bi bi-people-fill"></i>
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
                    <i class="bi bi-gear-fill"></i>
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
                    <i class="bi bi-file-earmark-fill"></i>
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
                    <i class="bi bi-file-earmark-fill"></i>
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
        /* Đặt chiều cao của canvas trong biểu đồ */
        #pieChart {
            height: 100%;
            width: 200%;
        }
    </style>

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-7 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <canvas id="pieChart"></canvas>

                </div>
            </div>
        </div>

        <div class="col-xl-3.05 col-lg-4">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <div id="calendar"></div>
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

    <!-- Thêm CSS của FullCalendar -->
    <link href="https://unpkg.com/fullcalendar@5.10.0/main.min.css" rel="stylesheet">
    <!-- Thêm JavaScript của FullCalendar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://unpkg.com/fullcalendar@5.10.0/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                selectable: true, // Cho phép người dùng chọn ngày
                initialView: 'dayGridMonth', // Chế độ xem ban đầu là tháng
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [ // Danh sách sự kiện mẫu
                    {
                        title: 'Meeting',
                        start: '2024-04-01T10:00:00',
                        end: '2024-04-01T12:00:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2024-04-10',
                        end: '2024-04-11'
                    }
                    // Thêm các sự kiện khác tại đây...
                ],
                select: function(info) {
                    // Xử lý sự kiện khi người dùng chọn một ngày trên lịch
                    alert('Selected date: ' + info.startStr);
                    // Thêm các thông báo hoặc xử lý khác tại đây...
                }
            });

            calendar.render(); // Hiển thị lịch
        });
    </script>



</div>
<!-- /.container-fluid -->
<!-- End of Main Content -->
<?php include("../inc/footer.php"); ?>