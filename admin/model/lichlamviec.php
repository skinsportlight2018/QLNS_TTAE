<?php
class LICHLAMVIEC
{
    private $id;
    private $nhanvien_id;
    private $calamviec;
    private $thutrongtuan;

    public function getid()
    {
        return $this->id;
    }

    public function setid($value)
    {
        $this->id = $value;
    }

    public function getnhanvien_id()
    {
        return $this->nhanvien_id;
    }

    public function setnhanvien_id($value)
    {
        $this->nhanvien_id = $value;
    }

    public function getcalamviec()
    {
        return $this->calamviec;
    }

    public function setcalamviec($value)
    {
        $this->calamviec = $value;
    }

    public function getthutrongtuan()
    {
        return $this->thutrongtuan;
    }

    public function setthutrongtuan($value)
    {
        $this->thutrongtuan = $value;
    }

    public function laylichlamviec()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT llv.*, nv.hotennv FROM lichlamviec llv INNER JOIN nhanvien nv ON llv.nhanvien_id = nv.id ORDER BY id DESC";
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

    public function laylichlamviectheonhanvien($nhanvien_id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM lichlamviec WHERE nhanvien_id = :nhanvien_id";
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

    // Thêm mới
    public function themlichlamviec($nhanvien_id, $calamviec, $thutrongtuan)
    {
        $dbcon = DATABASE::connect();
        try {
            // Lấy số lượng bản ghi hiện tại trong bảng nhanvien
            $currentRowCount = $this->laySoLuongBanGhiHienTai();

            $sql = "INSERT INTO lichlamviec(nhanvien_id, calamviec, thutrongtuan) 
                    VALUES(:nhanvien_id, :calamviec, :thutrongtuan)";

            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(':nhanvien_id', $nhanvien_id);
            $cmd->bindValue(':calamviec', $calamviec);
            $cmd->bindValue(':thutrongtuan', $thutrongtuan);
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
        $sql = "SELECT COUNT(*) AS count FROM lichlamviec";
        $cmd = $dbcon->prepare($sql);
        $cmd->execute();
        $row = $cmd->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }

    // Xóa 
    public function xoalichlamviec($llv)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql_delete = "DELETE FROM lichlamviec WHERE id=:id";
            $cmd_delete = $dbcon->prepare($sql_delete);
            $cmd_delete->bindValue(":id", $llv->getid());
            $result = $cmd_delete->execute();

            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
