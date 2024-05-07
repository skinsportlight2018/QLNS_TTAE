<?php
require_once '../model/database.php';

class TinhLuong
{
    public function layDanhSachNhanVien()
    {
        $sql = "SELECT id, manv, hotennv FROM nhanvien WHERE trangthai <> 0";
        $nv = DATABASE::execute_query($sql);
        $arrNV = array();
        foreach ($nv as $rowNV) {
            $arrNV[] = $rowNV;
        }
        return $arrNV;
    }

    public function tinhLuongNhanVien($maluong, $manhanvien, $soNgayCong, $tamUng, $moTa, $ngayTinhLuong)
    {
        $luongThang = 0;
        $tongKhoanTru = 0;
        $tamUngChoPhep = 0;
        $thucLanh = 0;
        $error = array();

        if (empty($error)) {
            $luongNgayQuery = "SELECT luongngay FROM nhanvien nv, chucvu cv WHERE nv.chucvu_id = cv.id AND nv.id = $manhanvien";
            $luongNgayResult = DATABASE::execute_query($luongNgayQuery);
            $rowLuongNgay = $luongNgayResult->fetch(PDO::FETCH_ASSOC);
            $getLuongNgay = $rowLuongNgay['luongngay'];

            if ($soNgayCong < 23) {
                $luongThang = $soNgayCong * $getLuongNgay;
                $tinhPhuCap = 0;
            }

            if ($soNgayCong >= 23 && $soNgayCong <= 31) {
                $tinhPhuCap = 50000;
                $luongThang = ($soNgayCong * $getLuongNgay) + $tinhPhuCap;
            }

            $baoHiemXaHoi = $luongThang * (8 / 100);
            $baoHiemYTe = $luongThang * (2.5 / 100);
            $tongKhoanTru = $baoHiemXaHoi + $baoHiemYTe;

            if ((1 / 3 * $luongThang) <= $tamUng) {
                $tamUngChoPhep = 1 / 3 * $luongThang;
                return "Tạm ứng không được vượt quá 1/3 lương tháng ($tamUngChoPhep)";
            }

            $thucLanh = $luongThang - $tongKhoanTru - $tamUng;

            $insert = "INSERT INTO luong(maluong, nhanvien_id, luongthang, phucap, ngaycong, khoannop, tamung, thuclanh, ngaychamcong, ghichu) 
                        VALUES('$maluong', $manhanvien, $luongThang, $tinhPhuCap, $soNgayCong, $tongKhoanTru, $tamUng, $thucLanh, '$ngayTinhLuong', '$moTa')";
            $result = DATABASE::execute_query($insert);
        }

        return $error;
    }
}
