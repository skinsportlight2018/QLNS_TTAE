<?php
class LOAINV
{
    private $id;
    private $maloainv;
    private $tenloainv;

    public function getid()
    {
        return $this->id;
    }

    public function setid($value)
    {
        $this->id = $value;
    }

    public function getmaloainv()
    {
        return $this->maloainv;
    }

    public function setmaloainv($value)
    {
        $this->maloainv = $value;
    }

    public function gettenloainv()
    {
        return $this->tenloainv;
    }

    public function settenloainv($value)
    {
        $this->tenloainv = $value;
    }

    public function layloainv()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM loai_nv";
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

    public function layloainvtheoid($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM loai_nv WHERE id=:id";
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

    public function themloainv($loainv)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql_check_ma = "SELECT COUNT(*) AS count FROM loai_nv WHERE maloainv = :maloainv";
            $cmd_check_ma = $dbcon->prepare($sql_check_ma);
            $cmd_check_ma->bindValue(":maloainv", $loainv->getmaloainv());
            $cmd_check_ma->execute();
            $row_ma = $cmd_check_ma->fetch(PDO::FETCH_ASSOC);
            $existing_count_ma = $row_ma['count'];

            $sql_check_ten = "SELECT COUNT(*) AS count FROM loai_nv WHERE tenloainv = :tenloainv";
            $cmd_check_ten = $dbcon->prepare($sql_check_ten);
            $cmd_check_ten->bindValue(":tenloainv", $loainv->gettenloainv());
            $cmd_check_ten->execute();
            $row_ten = $cmd_check_ten->fetch(PDO::FETCH_ASSOC);
            $existing_count_ten = $row_ten['count'];

            if ($existing_count_ma > 0) {
                return "Mã loại nhân viên đã tồn tại.";
            } elseif ($existing_count_ten > 0) {
                return "Tên loại nhân viên đã tồn tại.";
            } else {
                $sql_count = "SELECT COUNT(*) AS count FROM loai_nv";
                $cmd_count = $dbcon->prepare($sql_count);
                $cmd_count->execute();
                $row_count = $cmd_count->fetch(PDO::FETCH_ASSOC);
                $rowCount = $row_count['count'];

                $sql_insert = "INSERT INTO loai_nv(id, maloainv, tenloainv) VALUES(:id, :maloainv, :tenloainv)";
                $cmd_insert = $dbcon->prepare($sql_insert);
                $cmd_insert->bindValue(":id", $rowCount + 1);
                $cmd_insert->bindValue(":maloainv", $loainv->getmaloainv());
                $cmd_insert->bindValue(":tenloainv", $loainv->gettenloainv());
                $result = $cmd_insert->execute();

                return $result;
            }
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Xóa 
    public function xoaloainv($loainv)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql_delete = "DELETE FROM loai_nv WHERE id=:id";
            $cmd_delete = $dbcon->prepare($sql_delete);
            $cmd_delete->bindValue(":id", $loainv->getid());
            $result = $cmd_delete->execute();

            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật
    public function sualoainv($loainv)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE loai_nv SET maloainv=:maloainv, tenloainv=:tenloainv WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":maloainv", $loainv->getmaloainv()); // Sửa đổi để lấy giá trị của machuyenmon
            $cmd->bindValue(":tenloainv", $loainv->gettenloainv());
            $cmd->bindValue(":id", $loainv->getid());
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
