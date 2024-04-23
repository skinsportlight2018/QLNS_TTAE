<?php 

require("../model/database.php");
require("../model/taikhoan.php");
require("../model/nhanvien.php");

require("../model/quoctich.php");
require("../model/bangcap.php");
require("../model/tongiao.php");
require("../model/loainv.php");
require("../model/trinhdo.php");
require("../model/chuyenmon.php");
require("../model/chucvu.php");
require("../model/dantoc.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Biến $isLogin cho biết người dùng đăng nhập chưa
$isLogin = isset($_SESSION["taikhoan"]);

// Xét xem có thao tác nào được chọn
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
elseif($isLogin == FALSE){  // chưa đăng nhập
    $action="dangnhap";
}
else{   // mặc định
    $action="macdinh";
}

$tk = new TAIKHOAN();
$nvien = new NHANVIEN();

$qt = new QUOCTICH();
$tg = new TONGIAO();
$dt = new DANTOC();
$lnv = new LOAINV();
$td = new TRINHDO();
$cm = new CHUYENMON();
$bc = new BANGCAP();
$cv = new CHUCVU();

switch($action){
    case "macdinh":

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

        include("main.php");
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

                include("../qlnhanvien/chitietnv.php");
            } else {
                $nhanvien = $nvien->laynv();
                include("main.php");
            }
            break;
            
    case "dangnhap":
        include("login.php");
        break;

    case "xldangnhap":
        $email = $_REQUEST["txtemail"];
        $matkhau = $_REQUEST["txtmatkhau"];

        if($tk->kiemtrataikhoanhople($email,$matkhau)==TRUE){
            $_SESSION["taikhoan"] = $tk->laythongtintaikhoan($email); // đặt biến session
            include("main.php");
        }
        else{
            include("login.php");
        }
        break;

    case "dangxuat":
        unset($_SESSION["taikhoan"]);  // hủy biến session
        //include("login.php");         // hiển thị trang login
        header("location:../kttaikhoan/login.php");     // hoặc chuyển hướng ra bên ngoài (trang dành cho khách)
        break;  

    case "hoso":               
        include("hoso.php");
        break; 

    case "xlhoso":
        $id = $_POST["txtid"];
        $ho = $_POST["txtho"];
        $ten = $_POST["txtten"];
        $hinhanh = $_POST["txthinhanh"];
        $email = $_POST["txtemail"]; 
        $sdt = $_POST["txtsdt"];       

        if($_FILES["fhinh"]["name"] != null){
            $hinhanh = basename($_FILES["fhinh"]["name"]);
            $duongdan = "../img/Avatar/" . $hinhanh;
            move_uploaded_file($_FILES["fhinh"]["tmp_name"], $duongdan);
        }
        
        $tk->capnhattaikhoan($id,$ho,$ten,$hinhanh,$email,$sdt);

        $_SESSION["taikhoan"] = $tk->laythongtintaikhoan($email);
        include("hoso.php");        
        break;
       
    case "matkhau":
        include("change_password.php");
        break;
    
    case "doimatkhau":
        if ($isLogin && isset($_POST["txtmatkhaumoi"])) {
            $email = $_SESSION["taikhoan"]["email"];
            $result = $tk->doimatkhau($email, $_POST["txtmatkhaumoi"]);
            if ($result) {
                include("change_password.php"); // Hiển thị form đổi mật khẩu với thông báo thành công
            } else {
                include("main.php"); // Hoặc include trang main nếu có lỗi xảy ra
            }
        } else {
            include("change_password.php");
        }
        break; 
        
    default:
        break;
}
?>
