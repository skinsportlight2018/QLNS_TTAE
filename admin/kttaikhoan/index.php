<?php 

require("../model/database.php");
require("../model/taikhoan.php");
require("../model/nhanvien.php");

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


switch($action){
    case "macdinh":         
        include("main.php");
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
        include("main.php");        
        break;
       
    case "matkhau":               
        include("changepass.php");
        break; 

    case "doimatkhau":
         if (isset($_POST["txtemail"]) && isset($_POST["txtmatkhaumoi"]) )
            $tk->doimatkhau($_POST["txtemail"],$_POST["txtmatkhaumoi"]);
        include("main.php");
        break; 
    default:
        break;
}
?>
