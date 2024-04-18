<?php
// Kiểm tra session đã được khởi tạo hay chưa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["taikhoan"])) {
    header("location:../index.php");
}

require("../model/database.php");
require("../model/chuyenmon.php");

// Xác định hành động được yêu cầu
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    // Mặc định là xem danh sách
    $action = "xem";
}

$cm = new CHUYENMON();
$idsua = 0;

switch ($action) {
    case "xem":
        $chuyenmon = $cm->laychuyenmon();
        include("main.php");
        break;
    case "sua":
        // Hiển thị form sửa
        $idsua = $_GET["id"];
        $chuyenmon = $cm->laychuyenmon();
        include("main.php");
        break;
    case "capnhat":
        // Xử lý cập nhật chuyên môn
        $cmmoi = new CHUYENMON();
        $cmmoi->setid($_POST["id"]);
        $cmmoi->settenchuyenmon($_POST["tenchuyenmon"]);
        $cmmoi->setmachuyenmon($_POST["machuyenmon"]);

        // Thực hiện cập nhật
        $result = $cm->suachuyenmon($cmmoi);
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
        $cmmoi = new CHUYENMON();
        $cmmoi->settenchuyenmon($_POST["tenchuyenmon"]);
        $cmmoi->setmachuyenmon($_POST["machuyenmon"]);
        $cmmoi->setid($_POST["id"]);

        // Thực hiện thêm mới
        $result = $cm->themchuyenmon($cmmoi);

        if ($result === true) {
            $_SESSION['success_message'] = "Thêm mới thành công!";
            echo '<script>showSuccessMessage("Thêm mới thành công!"); setTimeout(function(){ window.location.href = "index.php?action=xem"; }, 1500);</script>'; // đoạn mã JavaScript này để trễ chuyển hướng
            exit();
        } elseif ($result === "Mã chuyên môn đã tồn tại." || $result === "Tên chuyên môn đã tồn tại.") {
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
        $cmxoa = new CHUYENMON();
        $cmxoa->setid($_GET["id"]);
        $result = $cm->xoachuyenmon($cmxoa);
        if ($result) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false]);
        }
        exit();
        break;
}
