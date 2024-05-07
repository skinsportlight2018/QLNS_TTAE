<?php
include("../model/chucvu.php");
include("../model/database.php");
$chucvu = new CHUCVU();
$data = $chucvu->laySoLuongNhanVienTheoChucVu();
echo json_encode($data);
