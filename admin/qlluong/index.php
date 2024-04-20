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

require("../model/luong.php");
require("../model/tinhluong.php");
require("../model/chamcong.php");

// Xét xem có thao tác nào được chọn
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "xem";
}

$l = new LUONG();
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

$tinhLuong = new TinhLuong();
$cc = new CHAMCONG();
$chamcong = $cc->laychamcong();


switch ($action) {
    case "xem":
        $luong = $l->layluong();

        $currentMonth = date('n');
        $currentYear = date('Y');
        // Lấy dữ liệu bảng chấm công trong tháng này
        if ($nvien) {
            $nhanvien = $nvien->laynv();
        }
        // Kiểm tra nếu $nhanvien và $chamcong không null trước khi sử dụng
        if ($nhanvien && $chamcong) {
            $tongCongNhanVien = array();
            foreach ($nhanvien as $nv) {
                $tongCong = $cc->tongcongNhanVien($nv['id'], $currentMonth, $currentYear);
                $tongCongNhanVien[$nv['id']] = $tongCong;
            }
            include("main.php");
        } else {
            // Xử lý trường hợp không có dữ liệu trả về từ DB
            echo "Không có dữ liệu nhân viên hoặc chấm công.";
        }
        break;

    case "xoa":
        $_SESSION['delete_message'] = "Xác nhận xóa?";
        header("Location: index.php?action=xem");
        exit();
        break;

    case "confirm_delete":
        $lxoa = new LUONG();
        $lxoa->setid($_GET["id"]);
        $result = $l->xoaluong($lxoa);
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
            $nhanvien_id = $_GET['id'];
            $c = $cv->laychucvutheoid($_GET["id"]);

            $chi_tiet_luong = $l->layluongtheonv($nhanvien_id);

            //chucvu_id -> tenchucvu
            $chucvu = $cv->laychucvutheoid($nv["chucvu_id"]);
            $nv["tenchucvu"] = $chucvu["tenchucvu"];
            $nv["luongngay"] = $chucvu["luongngay"];

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

            include("chitietluong.php");
        } else {
            $nhanvien = $nvien->laynv();
            $luong = $lg->layluong();
            include("main.php");
        }
        break;
    case "timkiem":
        if (isset($_GET["thang"]) && isset($_GET["nam"])) {
            $thang = $_GET["thang"];
            $nam = $_GET["nam"];
            $luong = $l->layLuongTheoNgay($thang, $nam);
            include("main.php");
        }
        break;

    case "them":
        $luong = $l->layluong();
        $nhanvien = $nvien->laynv();
        $chucvu = $cv->laychucvu();

        include("themluong.php");
        break;

    case "xulythem":
        $tinhLuong = new TinhLuong();
        $error = array();
        $success = array();
        $tamUngChoPhep = 0;

        $maluong = $_POST['maluong'];
        $manhanvien = $_POST['manhanvien'];
        $soNgayCong = $_POST['soNgayCong'];
        $tamUng = $_POST['tamUng'];
        $moTa = $_POST['moTa'];
        $ngayTinhLuong = $_POST['ngayTinhLuong'];

        $error = $tinhLuong->tinhLuongNhanVien($maluong, $manhanvien, $soNgayCong, $tamUng, $moTa, $ngayTinhLuong);

        if (empty($error)) {
            $lmoi = new LUONG();
            $result = $l->themluong($lmoi);

            // Kiểm tra kết quả thêm lương
            if ($result === true) {
                $_SESSION['success_message'] = "Thêm lương mới thành công!";
                header("Location: ../qlluong/index.php");
                exit();
            } else {
                $_SESSION['error_message'] = "Đã xảy ra lỗi khi thêm lương mới!";
                header("Location: ../qlluong/themluong.php");
                exit();
            }
        } else {
            $_SESSION['error_message'] = "Đã xảy ra lỗi khi tính lương!";
            header("Location: ../qlluong/themluong.php");
            exit();
        }
        break;
    default:
        break;
}
