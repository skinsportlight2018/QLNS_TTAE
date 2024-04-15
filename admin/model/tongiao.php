<?php
class TONGIAO
{
    private $id;
    private $tentongiao;

    public function getid()
    {
        return $this->id;
    }

    public function setid($value)
    {
        $this->id = $value;
    }

    public function gettentongiao()
    {
        return $this->tentongiao;
    }

    public function settentongiao($value)
    {
        $this->tentongiao = $value;
    }

    public function laytongiao()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM tongiao";
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

    public function laytongiaotheoid($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM tongiao WHERE id=:id";
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

    public function themtongiao($tongiao)
    {
        $dbcon = DATABASE::connect();
        try {
            // Kiểm tra xem tên chuyên môn đã tồn tại chưa
            $sql_check_ten = "SELECT COUNT(*) AS count FROM tongiao WHERE tentongiao = :tentongiao";
            $cmd_check_ten = $dbcon->prepare($sql_check_ten);
            $cmd_check_ten->bindValue(":tentongiao", $tongiao->gettentongiao());
            $cmd_check_ten->execute();
            $row_ten = $cmd_check_ten->fetch(PDO::FETCH_ASSOC);
            $existing_count_ten = $row_ten['count'];

            if ($existing_count_ten > 0) {
                // Mã chuyên môn đã tồn tại, trả về thông báo lỗi
                return "Mã tôn giáo đã tồn tại.";
            } else {
                // Lấy số lượng bản ghi hiện tại trong bảng chuyenmon
                $sql_count = "SELECT COUNT(*) AS count FROM tongiao";
                $cmd_count = $dbcon->prepare($sql_count);
                $cmd_count->execute();
                $row_count = $cmd_count->fetch(PDO::FETCH_ASSOC);
                $rowCount = $row_count['count'];

                // Tiến hành thêm mới với STT là số lượng bản ghi hiện tại + 1
                $sql_insert = "INSERT INTO tongiao(id, tentongiao) VALUES(:id, :tentongiao)";
                $cmd_insert = $dbcon->prepare($sql_insert);
                $cmd_insert->bindValue(":id", $rowCount + 1);
                $cmd_insert->bindValue(":tentongiao", $tongiao->gettentongiao());
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
    public function xoatongiao($tongiao)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql_delete = "DELETE FROM tongiao WHERE id=:id";
            $cmd_delete = $dbcon->prepare($sql_delete);
            $cmd_delete->bindValue(":id", $tongiao->getid());
            $result = $cmd_delete->execute();

            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật
    public function suatongiao($tongiao)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE tongiao SET tentongiao=:tentongiao WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tentongiao", $tongiao->gettentongiao());
            $cmd->bindValue(":id", $tongiao->getid());
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
