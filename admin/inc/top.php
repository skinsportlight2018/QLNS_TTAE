<!-- Content Wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.lordicon.com/lordicon.js"></script>


<head>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../inc/css/timkiem.css">


</head>

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" name="search" id="search" placeholder="Tìm kiếm nhân viên..." class="form-control" autocomplete="off" />
                    <div class="input-group-append">
                        <!-- Thay thế nút tìm kiếm bằng lord-icon -->
                        <div class="search-button">
                            <lord-icon src="https://cdn.lordicon.com/unukghxb.json" trigger="loop" stroke="bold" state="morph-check" colors="primary:#ffffff,secondary:#d1f3fa" style="width:30px;height:30px" loop-speed="0.1">
                            </lord-icon>
                        </div>
                    </div>
                </div>
            </div>

            <div class="search-results-container">
                <div id="searchResultsContainer"></div>
            </div>

            <script>
                var searchKeyword = ''; // Biến lưu từ khóa tìm kiếm
                var searchInputWidth = 0;

                $(document).ready(function() {
                    adjustSearchInputSize();

                    $('#search').on('input', function() {
                        searchKeyword = $(this).val().trim();
                        if (searchKeyword !== '') {
                            $.getJSON('../qlnhanvien/index.php?action=timkiem&search=' + searchKeyword, function(data) {
                                displayResults(data);
                                adjustResultsContainerSize();
                            });
                        }else {
                            $('#searchResultsContainer').empty(); // Xóa kết quả hiển thị khi không có từ khóa tìm kiếm
                        }
                        
                    });

                    $(window).resize(function() {
                        adjustSearchInputSize();
                    });

                    function adjustSearchInputSize() {
                        searchInputWidth = $('#search').outerWidth();
                    }

                    function displayResults(data) {
                        var resultsContainer = $('#searchResultsContainer');
                        resultsContainer.empty();
                        if (data.length > 0) {
                            var resultList = $('<ul class="list-group"></ul>');
                            $.each(data, function(index, employee) {
                                var listItem = $('<li class="list-group-item link-class"></li>');
                                var imageElement = $('<img src="../img/Avatar/' + employee.hinhanh + '" height="40" width="40" class="img-thumbnail avatar" />');
                                var textElement = $('<span class="employee-info">' + employee.manv + ' - ' + employee.hotennv + '</span>');

                                listItem.mouseup(function(event) {
                                    event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                                    window.location.href = '../qlnhanvien/index.php?action=chitiet&id=' + employee.id;
                                });

                                // Thêm sự kiện mouseenter để thêm lớp hovered-item
                                listItem.mouseenter(function() {
                                    $(this).addClass('hover-effect');
                                });

                                // Thêm sự kiện mouseleave để xóa lớp hovered-item
                                listItem.mouseleave(function() {
                                    $(this).removeClass('hover-effect');
                                });

                                listItem.append(imageElement);
                                listItem.append(textElement);
                                resultList.append(listItem);
                            });
                            resultsContainer.append(resultList);
                        } else {
                            resultsContainer.html('<p class="text-muted no-results">Không tìm thấy kết quả cho "' + searchKeyword + '"</p>');
                        }
                    }

                    function adjustResultsContainerSize() {
                        var searchInputHeight = $('#search').outerHeight();
                        var resultsContainer = $('#searchResultsContainer');
                        var topOffset = $('#search').offset().top + searchInputHeight;
                        var leftOffset = $('#search').offset().left; // Lấy vị trí bên trái của thanh tìm kiếm

                        // Điều chỉnh vị trí của container kết quả
                        resultsContainer.css('top', topOffset + 'px');
                        resultsContainer.css('left', leftOffset + 'px'); // Đặt vị trí bên trái của container kết quả
                        resultsContainer.css('transform', 'translateX(-62%)'); // Di chuyển container về bên trái
                        resultsContainer.css('width', searchInputWidth + 'px');
                    }

                });
            </script>



            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Nhập thông tin cần tìm..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">3+</span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Alerts Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 12, 2019</div>
                                <span class="font-weight-bold">A new monthly report is ready to download!</span>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-success">
                                    <i class="fas fa-donate text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 7, 2019</div>
                                $290.29 has been deposited into your account!
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 2, 2019</div>
                                Spending Alert: We've noticed unusually high spending for your account.
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>

                <!-- Nav Item - Messages -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter">7</span>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Message Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img src="../img/undraw_profile_1.svg" alt="...">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div class="font-weight-bold">
                                <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                    problem I've been having.</div>
                                <div class="small text-gray-500">Emily Fowler · 58m</div>
                            </div>
                        </a>

                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                    told me that people say this to all dogs, even if they aren't good...</div>
                                <div class="small text-gray-500">Chicken the Dog · 2w</div>
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow" style="color:#2C3D57">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-3 d-none d-lg-inline text-gray-600 small"> <?php if (isset($_SESSION["taikhoan"])) echo $_SESSION["taikhoan"]["ten"]; ?></span>
                        <?php if (isset($_SESSION["taikhoan"]["hinhanh"]) && $_SESSION["taikhoan"]["hinhanh"] != NULL) : ?>
                            <img class="img-profile rounded-circle" src="../img/Avatar/<?php echo $_SESSION["taikhoan"]["hinhanh"]; ?>" />
                        <?php else : ?>
                            <img class="img-profile rounded-circle" />
                        <?php endif; ?>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="../kttaikhoan/index.php?action=hoso">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-primary"></i>
                            Thông tin
                        </a>
                        <a class="dropdown-item" href="../kttaikhoan/change_password.php">
                            <i class="fas fa-lock fa-sm fa-fw mr-2 text-warning"></i>
                            Đổi mật khẩu
                        </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                            Đăng xuất
                        </a>

                    </div>
                </li>

                <!-- Nav Item - Messages -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                        <!-- Nội dung của dropdown menu messages -->
                    </div>


                    <!-- Logout Modal-->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Bạn có chắn chắn muốn đăng xuất không?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Chọn "Đăng xuất" nếu bạn muốn đăng nhập tài khoản khác.</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                                    <a class="btn btn-primary" href="../kttaikhoan/index.php?action=dangxuat">Đăng xuất</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>


            </ul>
        </nav>

        <!-- End of Topbar -->