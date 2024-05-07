<?php
class NHANVIEN
{

    // khai báo các thuộc tính
    private $id;
    private $manv;
    private $hotennv;
    private $hinhanh;
    private $sdt;
    private $gioitinh;
    private $ngaysinh;
    private $noisinh;
    private $cccd;
    private $noicap_cccd;
    private $ngaycap_cccd;
    private $quequan;
    private $quoctich_id;
    private $tongiao_id;
    private $dantoc_id;
    private $tamtru;
    private $loai_nv_id;
    private $trinhdo_id;
    private $chuyenmon_id;
    private $bangcap_id;
    private $chucvu_id;
    private $trangthai;

    public function getid()
    {
        return $this->id;
    }
    public function setid($value)
    {
        $this->id = $value;
    }

    public function getmanv()
    {
        return $this->manv;
    }
    public function setmanv($value)
    {
        $this->manv = $value;
    }

    public function gethotennv()
    {
        return $this->hotennv;
    }
    public function sethotennv($value)
    {
        $this->hotennv = $value;
    }

    public function getsdt()
    {
        return $this->sdt;
    }
    public function setsdt($value)
    {
        $this->sdt = $value;
    }

    public function getgioitinh()
    {
        return $this->gioitinh;
    }
    public function setgioitinh($value)
    {
        $this->gioitinh = $value;
    }

    public function getngaysinh()
    {
        return $this->ngaysinh;
    }
    public function setngaysinh($value)
    {
        $this->ngaysinh = $value;
    }

    public function getnoisinh()
    {
        return $this->noisinh;
    }
    public function setnoisinh($value)
    {
        $this->noisinh = $value;
    }

    public function getcccd()
    {
        return $this->cccd;
    }
    public function setcccd($value)
    {
        $this->cccd = $value;
    }

    public function gethinhanh()
    {
        return $this->hinhanh;
    }
    public function sethinhanh($value)
    {
        $this->hinhanh = $value;
    }

    public function getnoicap_cccd()
    {
        return $this->noicap_cccd;
    }
    public function setnoicap_cccd($value)
    {
        $this->noicap_cccd = $value;
    }

    public function getngaycap_cccd()
    {
        return $this->ngaycap_cccd;
    }
    public function setngaycap_cccd($value)
    {
        $this->ngaycap_cccd = $value;
    }

    public function getquequan()
    {
        return $this->quequan;
    }
    public function setquequan($value)
    {
        $this->quequan = $value;
    }

    public function getquoctich_id()
    {
        return $this->quoctich_id;
    }
    public function setquoctich_id($value)
    {
        $this->quoctich_id = $value;
    }

    public function gettongiao_id()
    {
        return $this->tongiao_id;
    }
    public function settongiao_id($value)
    {
        $this->tongiao_id = $value;
    }

    public function getdantoc_id()
    {
        return $this->dantoc_id;
    }
    public function setdantoc_id($value)
    {
        $this->dantoc_id = $value;
    }

    public function gettamtru()
    {
        return $this->tamtru;
    }
    public function settamtru($value)
    {
        $this->tamtru = $value;
    }

    public function getloai_nv_id()
    {
        return $this->loai_nv_id;
    }
    public function setloai_nv_id($value)
    {
        $this->loai_nv_id = $value;
    }

    public function gettrinhdo_id()
    {
        return $this->trinhdo_id;
    }
    public function settrinhdo_id($value)
    {
        $this->trinhdo_id = $value;
    }

    public function getchuyenmon_id()
    {
        return $this->chuyenmon_id;
    }
    public function setchuyenmon_id($value)
    {
        $this->chuyenmon_id = $value;
    }

    public function getbangcap_id()
    {
        return $this->bangcap_id;
    }
    public function setbangcap_id($value)
    {
        $this->bangcap_id = $value;
    }

    public function getchucvu_id()
    {
        return $this->chucvu_id;
    }
    public function setchucvu_id($value)
    {
        $this->chucvu_id = $value;
    }

    public function gettrangthai()
    {
        return $this->trangthai;
    }
    public function settrangthai($value)
    {
        $this->trangthai = $value;
    }

    // Lấy ds sách
    public function laynv()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT n.*, cv.tenchucvu FROM nhanvien n INNER JOIN chucvu cv ON n.chucvu_id = cv.id ORDER BY id DESC";
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

    public function laynvtheoquoctich($quoctich_id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM nhanvien WHERE quoctich_id = :quoctich_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":quoctich_id", $quoctich_id, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            error_log("Lỗi truy vấn: " . $e->getMessage());
            return null;
        }
    }

    public function laynvtheotongiao($tongiao_id)
    {
        $dbcon = DATABASE::connect();

        try {
            $sql = "SELECT * FROM nhanvien WHERE tongiao_id = :tongiao_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tongiao_id", $tongiao_id, PDO::PARAM_INT);
            $cmd->execute();

            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);

            if (empty($result)) {
                return null;
            }

            return $result;
        } catch (PDOException $e) {
            error_log("Lỗi truy vấn: " . $e->getMessage());
            return null;
        }
    }

    public function laynvtheodantoc($dantoc_id)
    {
        $dbcon = DATABASE::connect();

        try {
            $sql = "SELECT * FROM nhanvien WHERE dantoc_id = :dantoc_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":dantoc_id", $dantoc_id, PDO::PARAM_INT);
            $cmd->execute();

            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);

            if (empty($result)) {
                return null;
            }

            return $result;
        } catch (PDOException $e) {
            error_log("Lỗi truy vấn: " . $e->getMessage());
            return null;
        }
    }

    public function laynvtheoloainv($loai_nv_id)
    {
        $dbcon = DATABASE::connect();

        try {
            $sql = "SELECT * FROM nhanvien WHERE loai_nv_id = :loai_nv_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":loai_nv_id", $loai_nv_id, PDO::PARAM_INT);
            $cmd->execute();

            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);

            if (empty($result)) {
                return null;
            }

            return $result;
        } catch (PDOException $e) {
            error_log("Lỗi truy vấn: " . $e->getMessage());
            return null;
        }
    }

    public function laynvtheotrinhdo($trinhdo_id)
    {
        $dbcon = DATABASE::connect();

        try {
            $sql = "SELECT * FROM nhanvien WHERE trinhdo_id = :trinhdo_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":trinhdo_id", $trinhdo_id, PDO::PARAM_INT);
            $cmd->execute();

            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);

            if (empty($result)) {
                return null;
            }

            return $result;
        } catch (PDOException $e) {
            error_log("Lỗi truy vấn: " . $e->getMessage());
            return null;
        }
    }

    public function laynvtheochuyenmon($chuyenmon_id)
    {
        $dbcon = DATABASE::connect();

        try {
            $sql = "SELECT * FROM nhanvien WHERE chuyenmon_id = :chuyenmon_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":chuyenmon_id", $chuyenmon_id, PDO::PARAM_INT);
            $cmd->execute();

            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);

            if (empty($result)) {
                return null;
            }

            return $result;
        } catch (PDOException $e) {
            error_log("Lỗi truy vấn: " . $e->getMessage());
            return null;
        }
    }

    public function laynvtheobangcap($bangcap_id)
    {
        $dbcon = DATABASE::connect();

        try {
            $sql = "SELECT * FROM nhanvien WHERE bangcap_id = :bangcap_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":bangcap_id", $bangcap_id, PDO::PARAM_INT);
            $cmd->execute();

            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);

            if (empty($result)) {
                return null;
            }

            return $result;
        } catch (PDOException $e) {
            error_log("Lỗi truy vấn: " . $e->getMessage());
            return null;
        }
    }

    public function laynvtheochucvu($chucvu_id)
    {
        $dbcon = DATABASE::connect();

        try {
            $sql = "SELECT * FROM nhanvien WHERE chucvu_id = :chucvu_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":chucvu_id", $chucvu_id, PDO::PARAM_INT);
            $cmd->execute();

            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);

            if (empty($result)) {
                return null;
            }

            return $result;
        } catch (PDOException $e) {
            error_log("Lỗi truy vấn: " . $e->getMessage());
            return null;
        }
    }

    public function laynvtheoid($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM nhanvien WHERE id=:id";
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

    public function laynvtheomanv($manv)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM nhanvien WHERE manv=:manv";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":manv", $manv);
            $cmd->execute();
            $result = $cmd->fetch();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Thêm mới
    public function themnhanvien($nv)
    {
        $dbcon = DATABASE::connect();
        try {
            if ($this->kiemTraSDTTonTai($nv->getsdt())) {
                return "Số điện thoại đã tồn tại.";
            }
            if ($this->kiemTraCCCDTonTai($nv->getcccd())) {
                return "Căn cước công dân đã tồn tại.";
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

    private function kiemTraSDTTonTai($sdt)
    {
        $dbcon = DATABASE::connect();
        $sql = "SELECT COUNT(*) AS count FROM nhanvien WHERE sdt = :sdt";
        $cmd = $dbcon->prepare($sql);
        $cmd->bindValue(":sdt", $sdt);
        $cmd->execute();
        $row = $cmd->fetch(PDO::FETCH_ASSOC);
        $existing_count = $row['count'];
        return $existing_count > 0;
    }

    private function kiemTraCCCDTonTai($cccd)
    {
        $dbcon = DATABASE::connect();
        $sql = "SELECT COUNT(*) AS count FROM nhanvien WHERE cccd = :cccd";
        $cmd = $dbcon->prepare($sql);
        $cmd->bindValue(":cccd", $cccd);
        $cmd->execute();
        $row = $cmd->fetch(PDO::FETCH_ASSOC);
        $existing_count = $row['count'];
        return $existing_count > 0;
    }

    private function kiemTraSDTTonTaiSua($sdt, $currentId)
    {
        $dbcon = DATABASE::connect();
        $sql = "SELECT COUNT(*) AS count FROM nhanvien WHERE sdt = :sdt AND id != :currentId";
        $cmd = $dbcon->prepare($sql);
        $cmd->bindValue(":sdt", $sdt);
        $cmd->bindValue(":currentId", $currentId);
        $cmd->execute();
        $row = $cmd->fetch(PDO::FETCH_ASSOC);
        $existing_count = $row['count'];
        return $existing_count > 0;
    }

    private function kiemTraCCCDTonTaiSua($cccd, $currentId)
    {
        $dbcon = DATABASE::connect();
        $sql = "SELECT COUNT(*) AS count FROM nhanvien WHERE cccd = :cccd AND id != :currentId";
        $cmd = $dbcon->prepare($sql);
        $cmd->bindValue(":cccd", $cccd);
        $cmd->bindValue(":currentId", $currentId);
        $cmd->execute();
        $row = $cmd->fetch(PDO::FETCH_ASSOC);
        $existing_count = $row['count'];
        return $existing_count > 0;
    }

    private function laySoLuongBanGhiHienTai()
    {
        $dbcon = DATABASE::connect();
        $sql = "SELECT COUNT(*) AS count FROM nhanvien";
        $cmd = $dbcon->prepare($sql);
        $cmd->execute();
        $row = $cmd->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }

    // Xóa 
    public function xoanv($nv)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql_delete = "DELETE FROM nhanvien WHERE id=:id";
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

    // Cập nhật 
    public function suanv($nv)
    {
        $dbcon = DATABASE::connect();
        try {
            $currentRowCount = $this->laySoLuongBanGhiHienTai();

            $sql = "UPDATE nhanvien SET manv=:manv,
                                            hotennv=:hotennv,
                                            hinhanh=:hinhanh,
                                            sdt=:sdt,
                                            gioitinh=:gioitinh,
                                            ngaysinh=:ngaysinh,
                                            noisinh=:noisinh,
                                            cccd=:cccd,
                                            noicap_cccd=:noicap_cccd,
                                            ngaycap_cccd=:ngaycap_cccd,
                                            quequan=:quequan,
                                            quoctich_id=:quoctich_id,
                                            tongiao_id=:tongiao_id,
                                            dantoc_id=:dantoc_id,
                                            tamtru=:tamtru,
                                            loai_nv_id=:loai_nv_id,
                                            trinhdo_id=:trinhdo_id,
                                            chuyenmon_id=:chuyenmon_id,
                                            bangcap_id=:bangcap_id,
                                            chucvu_id=:chucvu_id,
                                            trangthai=:trangthai
                                            WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":manv", $nv->getmanv());
            $cmd->bindValue(":hotennv", $nv->gethotennv());
            $cmd->bindValue(":sdt", $nv->getsdt());
            $cmd->bindValue(":hinhanh", $nv->gethinhanh());
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
            $cmd->bindValue(":trangthai", $nv->gettrangthai());
            $cmd->bindValue(":id", $nv->getid());

            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function layDanhSachNhanVien()
    {
        $result = $this->laynv();
        $data = array();
        foreach ($result as $nv) {

            $employeeData = array(
                "id" => $nv["id"],
                "manv" => $nv["manv"],
                "hotennv" => $nv["hotennv"],
                "hinhanh" => "../../img/Avatar/" . $nv["hinhanh"]

            );
            $data[] = $employeeData;
        }
        return json_encode($data);
    }
}
