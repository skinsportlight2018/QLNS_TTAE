<?php
class LUONG
{
    // khai báo các thuộc tính
    private $id;
    private $maluong;
    private $nhanvien_id;
    private $luongthang;
    private $ngaycong;
    private $phucap;
    private $khoannop;
    private $tamung;
    private $thuclanh;
    private $ngaychamcong;
    private $ghichu;

    public function getid()
    {
        return $this->id;
    }
    public function setid($value)
    {
        $this->id = $value;
    }

    public function getmaluong()
    {
        return $this->maluong;
    }
    public function setmaluong($value)
    {
        $this->maluong = $value;
    }

    public function getnhanvien_id()
    {
        return $this->nhanvien_id;
    }
    public function setnhanvien_id($value)
    {
        $this->nhanvien_id = $value;
    }

    public function getluongthang()
    {
        return $this->luongthang;
    }
    public function setluongthang($value)
    {
        $this->luongthang = $value;
    }

    public function getngaycong()
    {
        return $this->ngaycong;
    }
    public function setngaycong($value)
    {
        $this->ngaycong = $value;
    }

    public function getphucap()
    {
        return $this->phucap;
    }
    public function setphucap($value)
    {
        $this->phucap = $value;
    }

    public function getkhoannop()
    {
        return $this->khoannop;
    }
    public function setkhoannop($value)
    {
        $this->khoannop = $value;
    }

    public function gettamung()
    {
        return $this->tamung;
    }
    public function settamung($value)
    {
        $this->tamung = $value;
    }

    public function getthuclanh()
    {
        return $this->thuclanh;
    }
    public function setthuclanh($value)
    {
        $this->thuclanh = $value;
    }

    public function getngaychamcong()
    {
        return $this->ngaychamcong;
    }
    public function setngaychamcong($value)
    {
        $this->ngaychamcong = $value;
    }
    public function getghichu()
    {
        return $this->ghichu;
    }
    public function setghichu($value)
    {
        $this->ghichu = $value;
    }

    public function layluong()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT l.*, nv.hotennv, cv.tenchucvu
            FROM luong l 
            INNER JOIN nhanvien nv ON l.nhanvien_id = nv.id 
            INNER JOIN chucvu cv ON nv.chucvu_id = cv.id
            ORDER BY l.id DESC";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function layluongtheonv($nhanvien_id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM luong WHERE nhanvien_id = :nhanvien_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":nhanvien_id", $nhanvien_id, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            error_log("Lỗi truy vấn: " . $e->getMessage());
            return null;
        }
    }

    public function layluongtheoid($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM luong WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $result = $cmd->fetch();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Xóa 
    public function xoaluong($l)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql_delete = "DELETE FROM luong WHERE id=:id";
            $cmd_delete = $dbcon->prepare($sql_delete);
            $cmd_delete->bindValue(":id", $nv->getid());
            $result = $cmd_delete->execute();

            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function themluong($l)
    {
        $dbcon = DATABASE::connect();
        try {
            if ($this->kiemTraMaLuongTonTai($l->getmaluong())) 
            {
                return "Mã lương đã tồn tại.";
            }
    
            // Lấy số lượng bản ghi hiện tại trong bảng nhanvien
            $currentRowCount = $this->laySoLuongBanGhiHienTai();
    
            $sql = "INSERT INTO nhanvien(manv, hotennv, hinhanh, sdt, gioitinh, ngaysinh, noisinh, cccd, noicap_cccd, ngaycap_cccd, quequan, quoctich_id, tongiao_id, dantoc_id, tamtru, loai_nv_id, trinhdo_id, chuyenmon_id, bangcap_id, chucvu_id, trangthai) 
                    VALUES(:manv, :hotennv, :hinhanh, :sdt, :gioitinh, :ngaysinh, :noisinh, :cccd, :noicap_cccd, :ngaycap_cccd, :quequan, :quoctich_id, :tongiao_id, :dantoc_id, :tamtru, :loai_nv_id, :trinhdo_id, :chuyenmon_id, :bangcap_id, :chucvu_id, :trangthai)";
    
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":manv", $nv->getmanv());
            $cmd->bindValue(":hotennv", $nv->gethotennv());
            $cmd->bindValue(":sdt", $nv->getsdt());
            $cmd->bindValue(":gioitinh", $nv->getgioitinh());
            $cmd->bindValue(":ngaysinh", $nv->getngaysinh());
            $cmd->bindValue(":noisinh", $nv->getnoisinh());
            $cmd->bindValue(":cccd", $nv->getcccd());
            $cmd->bindValue(":noicap_cccd", $nv->getnoicap_cccd());
            $cmd->bindValue(":ngaycap_cccd", $nv->getngaycap_cccd());
            $cmd->bindValue(":quequan", $nv->getquequan());
            $cmd->bindValue(":quoctich_id", $nv->getquoctich_id());
            $cmd->bindValue(":tongiao_id", $nv->gettongiao_id());
            $cmd->bindValue(":dantoc_id", $nv->getdantoc_id());
            $cmd->bindValue(":tamtru", $nv->gettamtru());
            $cmd->bindValue(":loai_nv_id", $nv->getloai_nv_id());
            $cmd->bindValue(":trinhdo_id", $nv->gettrinhdo_id());
            $cmd->bindValue(":chuyenmon_id", $nv->getchuyenmon_id());
            $cmd->bindValue(":bangcap_id", $nv->getbangcap_id());
            $cmd->bindValue(":chucvu_id", $nv->getchucvu_id());
            $cmd->bindValue(":hinhanh", $nv->gethinhanh());
            $cmd->bindValue(":trangthai", $nv->gettrangthai());
    
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    private function kiemTraMaLuongVienTonTai($maluong)
    {
        $dbcon = DATABASE::connect();
        $sql = "SELECT COUNT(*) AS count FROM luong WHERE maluong = :maluong";
        $cmd = $dbcon->prepare($sql);
        $cmd->bindValue(":maluong", $maluong);
        $cmd->execute();
        $row = $cmd->fetch(PDO::FETCH_ASSOC);
        $existing_count = $row['count'];
        return $existing_count > 0;
    }
}
?>