<?php 
if(!isset($_SESSION["taikhoan"]))
    header("location:../index.php");

require("../model/database.php");
require("../model/taikhoan.php");

if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="macdinh"; 
}

$taikhoan = new TAIKHOAN();

switch($action){
    case "macdinh":   
        $taikhoan = $taikhoan->laydanhsachtaikhoan();   
		// sắp xếp
		if(isset($_GET["sort"])){
			$sort = $_GET["sort"];
			switch($sort){
                case 'ho':
					usort($taikhoan, function($a, $b){ return strcmp($b["ho"], $a["ho"]); });
					break;
                case 'ten':
                    usort($taikhoan, function($a, $b){ return strcmp($b["ten"], $a["ten"]); });
                    break;
				case 'email':
					usort($taikhoan, function($a, $b){ return strcmp($a["email"], $b["email"]); });
					break;
				case 'sdt':
					usort($taikhoan, function($a, $b){ return strcmp($b["sdt"], $a["sdt"]); });
					break;				
				case 'quyen':
					usort($taikhoan, function($a, $b){ return $a["quyen"] - $b["quyen"]; });
					break;
				default:
					ksort($taikhoan);
					break;
			}
		}
        include("main.php");
        break;
    case "khoa":   
        $matk = $_GET["matk"];
        $trangthai = $_GET["trangthai"];
        if(!$taikhoan->doitrangthai($matk, $trangthai)){
            $tb = "Đã đổi trạng thái!";
        }
        $taikhoan = $taikhoan->laydanhsachtaikhoan();     
        include("main.php");
        break;

    case "xlthem":
        $ho = $_POST["txtho"];
        $ten = $_POST["txtten"];
        $email = $_POST["txtemail"];
        $matkhau = $_POST["txtmatkhau"];
        $sdt = $_POST["txtsdt"];
        $quyen = $_POST["optquyen"];
        if($taikhoan->laythongtintaikhoan($email)){   // có thể kiểm tra thêm số đt không trùng
            $tb = "Email này đã được cấp tài khoản!";
        }
        else{
            if(!$taikhoan->themtaikhoan($ho,$ten,$email,$matkhau,$sdt,$quyen)){
                $tb = "Không thêm được!";
            }
        }
        $taikhoan = $taikhoan->laydanhsachtaikhoan();
        include("main.php");        
        break;
    
    default:
        break;
}
?>
