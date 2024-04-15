<?php
// Kiểm tra session đã được khởi tạo hay chưa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["taikhoan"])) {
    header("location:../index.php");
}

require("../model/database.php");
require("../model/bangcap.php");

// Xác định hành động được yêu cầu
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    // Mặc định là xem danh sách
    $action = "xem";
}

$bc = new BANGCAP();
$idsua = 0;

switch ($action) {
    case "xem":
        $bangcap = $bc->laybangcap();
        include("main.php");
        break;
    case "sua":
        // Hiển thị form sửa
        $idsua = $_GET["id"];
        $bangcap = $bc->laybangcap();
        include("main.php");
        break;
    case "capnhat":
        // Xử lý cập nhật chuyên môn
        $bcmoi = new BANGCAP();
        $bcmoi->setid($_POST["id"]);
        $bcmoi->settenbangcap($_POST["tenbangcap"]);
        $bcmoi->setmabangcap($_POST["mabangcap"]);

        // Thực hiện cập nhật
        $result = $bc->suabangcap($bcmoi);
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
        $bcmoi = new BANGCAP();
        $bcmoi->settenbangcap($_POST["tenbangcap"]);
        $bcmoi->setmabangcap($_POST["mabangcap"]);
        $bcmoi->setid($_POST["id"]);

        // Thực hiện thêm mới
        $result = $bc->thembangcap($bcmoi);

        if ($result === true) {
            $_SESSION['success_message'] = "Thêm mới thành công!";
            echo '<script>showSuccessMessage("Thêm mới thành công!"); setTimeout(function(){ window.location.href = "index.php?action=xem"; }, 1500);</script>'; // đoạn mã JavaScript này để trễ chuyển hướng
            exit();
        } elseif ($result === "Mã bằng cấp đã tồn tại." || $result === "Tên bằng cấp  đã tồn tại.") {
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
        $bcxoa = new BANGCAP();
        $bcxoa->setid($_GET["id"]);
        $result = $bc->xoabangcap($bcxoa);
        if ($result) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false]);
        }
        exit();
        break;
}
