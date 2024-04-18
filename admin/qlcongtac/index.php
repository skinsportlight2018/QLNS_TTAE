<?php
// Kiểm tra session đã được khởi tạo hay chưa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["taikhoan"])) {
    header("location:../index.php");
}

require("../model/nhanvien.php");
require("../model/database.php");
require("../model/congtac.php");

// Xét xem có thao tác nào được chọn
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "xem";
}

$nv = new NHANVIEN();
$ct = new CONGTAC();
$result = false; 

switch ($action) {
    case "xem":
        $congtac = $ct->laycongtac();
        include("main.php");
        break;

    case "them":
        $nhanvien = $nv->laynv();
        include("themcongtac.php");
        break;

    case "xulythem":
        // xử lý thêm
        $ctmoi = new CONGTAC();
        $ctmoi->setmacongtac($_POST["txtmacongtac"]);
        $ctmoi->setnhanvien_id($_POST["opttennhanvien"]);
        $ctmoi->setngaybd($_POST["txtngaybd"]);
        $ctmoi->setngaykt($_POST["txtngaykt"]);
        $ctmoi->setdiadiem($_POST["txtdiadiem"]);
        $ctmoi->setnhiemvu_congtac($_POST["txtnhiemvu_congtac"]);
        $ctmoi->setghichu($_POST["txtghichu"]);
        // Thực hiện thêm mới
        $result = $ct->themcongtac($ctmoi);

        if ($result === true) {
            $_SESSION['success_message'] = "Thêm công tác mới thành công!";
            echo '<script>showSuccessMessage("Thêm công tác mới thành công!"); setTimeout(function(){ window.location.href = "../qlnhanvien/index.php"; }, 1500);</script>'; // đoạn mã JavaScript này để trễ chuyển hướng
            header("Location: ../qlcongtac/index.php");
            exit();
            break;
        } elseif ($result === "Mã công tác đã tồn tại." ) {
            $_SESSION['error_message'] = $result;
            echo '<script>showErrorMessage("' . $result . '")setTimeout(function(){ window.location.href = "index.php?action=xem"; }, 1500);</script>';
            header("Location: ../qlcongtac/index.php");
            exit();
            break;
        } else {
            $_SESSION['error_message'] = "Đã xảy ra lỗi khi thêm!";
            echo '<script>showErrorMessage("Đã xảy ra lỗi khi thêm!")setTimeout(function(){ window.location.href = "index.php?action=xem"; }, 1500);</script>';
            header("Location: ../qlcongtac/themcongtac.php");
            exit();
            break;
        }      
        exit();
        break;
        
    case "xoa":
        // Chỉ cần hiển thị thông báo xóa ở đây, xác nhận xóa sẽ được gọi từ file message.js
        $_SESSION['delete_message'] = "Bạn xác nhận xóa công tác này không?";
        header("Location: index.php?action=xem");
        exit();
        break;

    case "confirm_delete":
        // Xác nhận xóa chuyên môn
        $ctxoa = new CONGTAC();
        $ctxoa->setid($_GET["id"]);
        $result = $ct->xoacongtac($ctxoa);
        if ($result) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false]);
        }
        exit();
        break;

    case "sua":
        if (isset($_GET["id"])) {
            $c = $ct->laycongtactheoid($_GET["id"]);
            $nhanvien = $nv->laynv();   
            include("suacongtac.php");
        } else {
            $congtac = $ct->laycongtac();
            include("main.php");
        }
        break;

    case "xulysua":
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $ctmoi = new CONGTAC();
        $ctmoi->setid($_POST["txtid"]);
        $ctmoi->setmacongtac($_POST["txtmacongtac"]);
        $ctmoi->setnhanvien_id($_POST["opttennhanvien"]);
        $ctmoi->setngaybd($_POST["txtngaybd"]);
        $ctmoi->setngaykt($_POST["txtngaykt"]);
        $ctmoi->setdiadiem($_POST["txtdiadiem"]);
        $ctmoi->setnhiemvu_congtac($_POST["txtnhiemvu_congtac"]);
        $ctmoi->setghichu($_POST["txtghichu"]);

         // Thực hiện thêm mới
        $result = $ct->suacongtac($ctmoi);

        if ($result === true) {
            $_SESSION['success_message'] = "Sửa công tác thành công!";
            echo '<script>showSuccessMessage("Sửa công tác thành công!"); setTimeout(function(){ window.location.href = "../qlnhanvien/index.php"; }, 1500);</script>'; // đoạn mã JavaScript này để trễ chuyển hướng
            header("Location: ../qlcongtac/index.php");
            exit();
            break;
        } elseif ($result === "Mã công tác đã tồn tại." ) {
            $_SESSION['error_message'] = $result;
            echo '<script>showErrorMessage("' . $result . '")setTimeout(function(){ window.location.href = "index.php?action=xem"; }, 1500);</script>';
            header("Location: ../qlcongtac/suacongtac.php");
            exit();
            break;
        } else {
            $_SESSION['error_message'] = "Đã xảy ra lỗi khi Sửa!";
            echo '<script>showErrorMessage("Đã xảy ra lỗi khi Sửa!")setTimeout(function(){ window.location.href = "index.php?action=xem"; }, 1500);</script>';
            header("Location: ../qlcongtac/suacongtac.php");
            exit();
            break;
        }      
        exit();

    default:
        break;
}
