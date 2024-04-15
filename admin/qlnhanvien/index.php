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
require("../model/quoctich.php");
require("../model/bangcap.php");
require("../model/tongiao.php");
require("../model/loainv.php");
require("../model/trinhdo.php");
require("../model/chuyenmon.php");
require("../model/chucvu.php");
require("../model/dantoc.php");

// Xét xem có thao tác nào được chọn
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "xem";
}

$nvien = new NHANVIEN();
$qt = new QUOCTICH();
$tg = new TONGIAO();
$dt = new DANTOC();
$lnv = new LOAINV();
$td = new TRINHDO();
$cm = new CHUYENMON();
$bc = new BANGCAP();
$cv = new CHUCVU();
$result = false; 

switch ($action) {
    case "xem":
        $nhanvien = $nvien->laynv();
        $anh_nhanvien = array();
        include("main.php");
        break;

    case "them":
        $quoctich = $qt->layquoctich();
        $tongiao = $tg->laytongiao();
        $dantoc = $dt->laydantoc();
        $loainhanvien = $lnv->layloainv();
        $trinhdo = $td->laytrinhdo();
        $chuyenmon = $cm->laychuyenmon();
        $bangcap = $bc->laybangcap();
        $chucvu = $cv->laychucvu();
        include("themnv.php");
        break;

    case "xulythem":
        $hinhanh = "" . basename($_FILES["filehinhanh"]["name"]); // đường dẫn ảnh lưu trong db
        $duongdan = "../../" . $hinhanh; // nơi lưu file upload (đường dẫn tính theo vị trí hiện hành)

        // xử lý thêm
        $nvmoi = new NHANVIEN();
        $nvmoi->setmanv($_POST["txtmanv"]);
        $nvmoi->sethotennv($_POST["txthotennv"]);
        $nvmoi->setloai_nv_id($_POST["optloainv"]);
        $nvmoi->setquoctich_id($_POST["optquoctich"]);
        $nvmoi->settongiao_id($_POST["opttongiao"]);
        $nvmoi->setdantoc_id($_POST["optdantoc"]);
        $nvmoi->settrinhdo_id($_POST["opttrinhdo"]);
        $nvmoi->setchuyenmon_id($_POST["optchuyenmon"]);
        $nvmoi->setbangcap_id($_POST["optbangcap"]);
        $nvmoi->setchucvu_id($_POST["optchucvu"]);
        $nvmoi->setsdt($_POST["txtsdt"]);
        $nvmoi->setgioitinh($_POST["optgioitinh"]);
        $nvmoi->setngaysinh($_POST["txtngaysinh"]);
        $nvmoi->setnoisinh($_POST["txtnoisinh"]);
        $nvmoi->setcccd($_POST["txtcccd"]);
        $nvmoi->setnoicap_cccd($_POST["txtnoicapcccd"]);
        $nvmoi->setngaycap_cccd($_POST["txtngaycapcccd"]);
        $nvmoi->setquequan($_POST["txtquequan"]);
        $nvmoi->settamtru($_POST["txttamtru"]);
        $nvmoi->settrangthai($_POST["opttrangthai"]);
        $nvmoi->sethinhanh($hinhanh);

        // Thực hiện thêm mới
        $result = $nvien->themnhanvien($nvmoi);

        if ($result === true) {
            $_SESSION['success_message'] = "Thêm thành công!";
            echo '<script>showSuccessMessage("Thêm thành công!"); setTimeout(function(){ window.location.href = "../qlnhanvien/index.php"; }, 1500);</script>'; // đoạn mã JavaScript này để trễ chuyển hướng
            header("Location: ../qlnhanvien/index.php");
            exit();
            break;
        } elseif ($result === "Mã nhân viên đã tồn tại." 
                || $result === "Số điện thoại đã tồn tại." 
                || $result === "Số CCCD đã tồn tại." ) {
            $_SESSION['error_message'] = $result;
            echo '<script>showErrorMessage("' . $result . '")setTimeout(function(){ window.location.href = "index.php?action=xem"; }, 1500);</script>';
            header("Location: ../qlnhanvien/themnv.php");
            exit();
            break;
        } else {
            $_SESSION['error_message'] = "Đã xảy ra lỗi khi thêm!";
            echo '<script>showErrorMessage("Đã xảy ra lỗi khi thêm!")setTimeout(function(){ window.location.href = "index.php?action=xem"; }, 1500);</script>';
            header("Location: ../qlnhanvien/themnv.php");
            exit();
            break;
        }      
        exit();
        break;
        
    case "xoa":
        // Chỉ cần hiển thị thông báo xóa ở đây, xác nhận xóa sẽ được gọi từ file message.js
        $_SESSION['delete_message'] = "Xác nhận xóa?";
        header("Location: index.php?action=xem");
        exit();
        break;

    case "confirm_delete":
        // Xác nhận xóa chuyên môn
        $nvxoa = new NHANVIEN();
        $nvxoa->setid($_GET["id"]);
        $result = $nvien->xoanv($nvxoa);
        if ($result) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false]);
        }
        exit();
        break;

    case "chitiet":
        if (isset($_GET["id"])) {
            $nv = $nvien->laynvtheoid($_GET["id"]);
            
            //chucvu_id -> tenchucvu
            $chucvu = $cv->laychucvutheoid($nv["chucvu_id"]);
            $nv["tenchucvu"] = $chucvu["tenchucvu"];

            //loai_nv_id -> tenloainv
            $loai_nv = $lnv->layloainvtheoid($nv["loai_nv_id"]);
            $nv["tenloainv"] = $loai_nv["tenloainv"];

            //quoctich_id -> tenquoctich
            $quoctich = $qt->layquoctichtheoid($nv["quoctich_id"]);
            $nv["tenquoctich"] = $quoctich["tenquoctich"];

            //dantoc_id -> tendantoc
            $dantoc = $dt->laydantoctheoid($nv["dantoc_id"]);
            $nv["tendantoc"] = $dantoc["tendantoc"];

            //tongiao_id -> tentongiao
            $tongiao = $tg->laytongiaotheoid($nv["tongiao_id"]);
            $nv["tentongiao"] = $tongiao["tentongiao"];

            //trinhdo_id -> tentrinhdo
            $trinhdo = $td->laytrinhdotheoid($nv["trinhdo_id"]);
            $nv["tentrinhdo"] = $trinhdo["tentrinhdo"];

            //chuyenmon_id -> tenchuyenmon
            $chuyenmon = $cm->laychuyenmontheoid($nv["chuyenmon_id"]);
            $nv["tenchuyenmon"] = $chuyenmon["tenchuyenmon"];

            //bangcap_id -> tenbangcap
            $bangcap = $bc->laybangcaptheoid($nv["bangcap_id"]);
            $nv["tenbangcap"] = $bangcap["tenbangcap"];

            include("chitietnv.php");
        } else {
            $nhanvien = $nvien->laynv();
            include("main.php");
        }
        break;

    case "sua":
        if (isset($_GET["id"])) {
            $nv = $nvien->laynvtheoid($_GET["id"]);
            $quoctich = $qt->layquoctich();
            $tongiao = $tg->laytongiao();
            $dantoc = $dt->laydantoc();
            $loainv = $lnv->layloainv();
            $trinhdo = $td->laytrinhdo();
            $chuyenmon = $cm->laychuyenmon();
            $bangcap = $bc->laybangcap();
            $chucvu = $cv->laychucvu();
            include("suanv.php");
        } else {
            $nhanvien = $nvien->laynv();
            include("main.php");
        }
        break;

    case "xulysua":
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $nvm = new NHANVIEN();
        $nvm->setid($_POST["txtid"]);
        $nvm->setquoctich_id($_POST["optquoctich"]);
        $nvm->settongiao_id($_POST["opttongiao"]);
        $nvm->setdantoc_id($_POST["optdantoc"]);
        $nvm->setloai_nv_id($_POST["optloainv"]);
        $nvm->settrinhdo_id($_POST["opttrinhdo"]);
        $nvm->setchuyenmon_id($_POST["optchuyenmon"]);
        $nvm->setbangcap_id($_POST["optbangcap"]);
        $nvm->setchucvu_id($_POST["optchucvu"]);
        $nvm->setmanv($_POST["txtmanv"]);
        $nvm->sethotennv($_POST["txthotennv"]);
        $nvm->setsdt($_POST["txtsdt"]);
        $nvm->setgioitinh($_POST["optgioitinh"]);
        $nvm->setngaysinh($_POST["txtngaysinh"]);
        $nvm->setnoisinh($_POST["txtnoisinh"]);
        $nvm->setcccd($_POST["txtcccd"]);
        $nvm->setnoicap_cccd($_POST["txtnoicapcccd"]);
        $nvm->setngaycap_cccd($_POST["txtngaycapcccd"]);
        $nvm->setquequan($_POST["txtquequan"]);
        $nvm->settamtru($_POST["txttamtru"]);
        $nvm->settrangthai($_POST["opttrangthai"]);
        $nvm->sethinhanh($_POST["txthinhcu"]);

        // upload file mới (nếu có)
        if ($_FILES["filehinhanh"]["name"] != "") {
            // xử lý file upload -- Cần bổ sung kiểm tra: dung lượng, kiểu file, ...
            $hinhanh = "" . basename($_FILES["filehinhanh"]["name"]);
            $nvm->sethinhanh($hinhanh);
            $duongdan = "../../" . $hinhanh;
            move_uploaded_file($_FILES["filehinhanh"]["tmp_name"], $duongdan);
        }

         // Thực hiện thêm mới
        $result = $nvien->suanv($nvm);

        if ($result === true) {
            $_SESSION['success_message'] = "Sửa thành công!";
            echo '<script>showSuccessMessage("Sửa thành công!"); setTimeout(function(){ window.location.href = "../qlnhanvien/index.php"; }, 1500);</script>'; // đoạn mã JavaScript này để trễ chuyển hướng
            header("Location: ../qlnhanvien/index.php");
            exit();
            break;
        } elseif ($result === "Mã nhân viên đã tồn tại." 
                || $result === "Số điện thoại đã tồn tại." 
                || $result === "Số CCCD đã tồn tại." ) {
            $_SESSION['error_message'] = $result;
            echo '<script>showErrorMessage("' . $result . '")setTimeout(function(){ window.location.href = "index.php?action=xem"; }, 1500);</script>';
            header("Location: ../qlnhanvien/suanv.php");
            exit();
            break;
        } else {
            $_SESSION['error_message'] = "Đã xảy ra lỗi khi Sửa!";
            echo '<script>showErrorMessage("Đã xảy ra lỗi khi Sửa!")setTimeout(function(){ window.location.href = "index.php?action=xem"; }, 1500);</script>';
            header("Location: ../qlnhanvien/suanv.php");
            exit();
            break;
        }      
        exit();

    default:
        break;
}
