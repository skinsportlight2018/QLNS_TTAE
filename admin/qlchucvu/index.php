<?php
// Kiểm tra session đã được khởi tạo hay chưa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["taikhoan"])) {
    header("location:../index.php");
}

require("../model/database.php");
require("../model/chucvu.php");

// Xác định hành động được yêu cầu
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    // Mặc định là xem danh sách
    $action = "xem";
}

$cv = new CHUCVU();
$idsua = 0;

switch ($action) {
    case "xem":
        $chucvu = $cv->laychucvu();
        include("main.php");
        break;
    case "sua":
        // Hiển thị form sửa
        $idsua = $_GET["id"];
        $chucvu = $cv->laychucvu();
        include("main.php");
        break;
    case "capnhat":
        // Xử lý cập nhật chuyên môn
        $cvmoi = new CHUCVU();
        $cvmoi->setid($_POST["id"]);
        $cvmoi->setluongngay($_POST["luongngay"]);
        $cvmoi->settenchucvu($_POST["tenchucvu"]);
        $cvmoi->setmachucvu($_POST["machucvu"]);
        // Thực hiện cập nhật
        $result = $cv->suachucvu($cvmoi);
        if ($result) {
            $_SESSION['success_message'] = "Cập nhật thành công!";
        } else {
            $_SESSION['error_message'] = "Cập nhật thất bại!";
        }
        header("Location: index.php?action=xem");
        exit();
        break;

    case "them":
        // Xử lý thêm mới chuyên môn
        $cvmoi = new CHUCVU();
        $cvmoi->setluongngay($_POST["luongngay"]);
        $cvmoi->settenchucvu($_POST["tenchucvu"]);
        $cvmoi->setmachucvu($_POST["machucvu"]);
        $cvmoi->setid($_POST["id"]);

        // Thực hiện thêm mới
        $result = $cv->themchucvu($cvmoi);

        if ($result === true) {
            $_SESSION['success_message'] = "Thêm mới thành công!";
            echo '<script>showSuccessMessage("Thêm mới thành công!"); setTimeout(function(){ window.location.href = "index.php?action=xem"; }, 1500);</script>'; // đoạn mã JavaScript này để trễ chuyển hướng
            exit();
        } elseif ($result === "Mã chức vụ đã tồn tại." || $result === "Tên chức vụ đã tồn tại.") {
            $_SESSION['error_message'] = $result;
            echo '<script>showErrorMessage("' . $result . '")setTimeout(function(){ window.location.href = "index.php?action=xem"; }, 1500);</script>';
            exit();
        } else {
            $_SESSION['error_message'] = "Đã xảy ra lỗi khi thêm mới!";
            echo '<script>showErrorMessage("Đã xảy ra lỗi khi thêm mới!")setTimeout(function(){ window.location.href = "index.php?action=xem"; }, 1500);</script>';
            exit();
        }


        break;
    case "xoa":
        // Chỉ cần hiển thị thông báo xóa ở đây, xác nhận xóa sẽ được gọi từ file message.js
        $_SESSION['delete_message'] = "Xác nhận xóa?";
        header("Location: index.php?action=xem");
        exit();
        break;

    case "confirm_delete":
        // Xác nhận xóa chuyên môn
        $cvxoa = new CHUCVU();
        $cvxoa->setid($_GET["id"]);
        $result = $cv->xoachucvu($cvxoa);
        if ($result) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false]);
        }
        exit();
        break;
}
