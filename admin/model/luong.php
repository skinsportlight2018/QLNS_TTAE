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
            $cmd_delete->bindValue(":id", $l->getid());
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
            // Lấy số lượng bản ghi hiện tại trong bảng nhanvien
            $currentRowCount = $this->laySoLuongBanGhiHienTai();
    
            $sql = "INSERT INTO luong(maluong, 
                                nhanvien_id,
                                ngaycong,
                                ngaychamcong)
                    VALUES(:maluong,
                            :nhanvien_id, 
                            :ngaycong, 
                            :ngaychamcong)";
    
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":maluong", $l->getmaluong());
            $cmd->bindValue(":nhanvien_id", $l->getnhanvien_id());
            $cmd->bindValue(":ngaycong", $l->getngaycong());
            $cmd->bindValue(":ngaychamcong", $l->getngaychamcong());
    
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    private function laySoLuongBanGhiHienTai()
    {
        $dbcon = DATABASE::connect();
        $sql = "SELECT COUNT(*) AS count FROM luong";
        $cmd = $dbcon->prepare($sql);
        $cmd->execute();
        $row = $cmd->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }
    
    public function layLuongTheoNgay($thang, $nam)
    {
        $dbcon = DATABASE::connect();
        try {
            // Tạo chuỗi ngày bắt đầu và kết thúc cho tháng được chỉ định
            $start_date = date("Y-m-01", strtotime("$nam-$thang"));
            $end_date = date("Y-m-t", strtotime("$nam-$thang")); // Lấy ngày cuối cùng của tháng

            $sql = "SELECT l.*, nv.hotennv, cv.tenchucvu
            FROM luong l 
            INNER JOIN nhanvien nv ON l.nhanvien_id = nv.id 
            INNER JOIN chucvu cv ON nv.chucvu_id = cv.id
            WHERE l.ngaychamcong BETWEEN :start_date AND :end_date";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":start_date", $start_date);
            $cmd->bindValue(":end_date", $end_date);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            error_log("Lỗi truy vấn: " . $e->getMessage());
            return null;
        }
    }
}
?>
