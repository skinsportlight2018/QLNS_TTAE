<?php
// Kiểm tra session đã được khởi tạo hay chưa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["taikhoan"])) {
    header("location:../index.php");
}

require("../model/database.php");
require("../model/quoctich.php");

// Xác định hành động được yêu cầu
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    // Mặc định là xem danh sách
    $action = "xem";
}

$qt = new QUOCTICH();
$idsua = 0;

switch ($action) {
    case "xem":
        $quoctich = $qt->layquoctich();
        include("main.php");
        break;
    case "sua":
        // Hiển thị form sửa
        $idsua = $_GET["id"];
        $quoctich = $qt->layquoctich();
        include("main.php");
        break;
    case "capnhat":
        // Xử lý cập nhật chuyên môn
        $qtmoi = new QUOCTICH();
        $qtmoi->setid($_POST["id"]);
        $qtmoi->settenquoctich($_POST["tenquoctich"]);

        // Thực hiện cập nhật
        $result = $qt->suaquoctich($qtmoi);
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
        $qtmoi = new QUOCTICH();
        $qtmoi->settenquoctich($_POST["tenquoctich"]);
        $qtmoi->setid($_POST["id"]);

        // Thực hiện thêm mới
        $result = $qt->themquoctich($qtmoi);

        if ($result === true) {
            $_SESSION['success_message'] = "Thêm mới thành công!";
            echo '<script>showSuccessMessage("Thêm mới thành công!"); setTimeout(function(){ window.location.href = "index.php?action=xem"; }, 1500);</script>'; // đoạn mã JavaScript này để trễ chuyển hướng
            exit();
        } elseif ($result === "Tên quốc tịch đã tồn tại.") {
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
        $qtxoa = new QUOCTICH();
        $qtxoa->setid($_GET["id"]);
        $result = $qt->xoaquoctich($qtxoa);
        if ($result) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false]);
        }
        exit();
        break;
}
