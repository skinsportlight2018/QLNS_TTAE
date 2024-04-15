<?php
class DANTOC
{
    private $id;
    private $tendantoc;

    public function getid()
    {
        return $this->id;
    }

    public function setid($value)
    {
        $this->id = $value;
    }

    public function gettendantoc()
    {
        return $this->tendantoc;
    }

    public function settendantoc($value)
    {
        $this->tendantoc = $value;
    }

    public function laydantoc()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM dantoc";
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

    public function laydantoctheoid($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM dantoc WHERE id=:id";
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

    public function themdantoc($dantoc)
    {
        $dbcon = DATABASE::connect();
        try {
            // Kiểm tra xem tên chuyên môn đã tồn tại chưa
            $sql_check_ten = "SELECT COUNT(*) AS count FROM dantoc WHERE tendantoc = :tendantoc";
            $cmd_check_ten = $dbcon->prepare($sql_check_ten);
            $cmd_check_ten->bindValue(":tendantoc", $dantoc->gettendantoc());
            $cmd_check_ten->execute();
            $row_ten = $cmd_check_ten->fetch(PDO::FETCH_ASSOC);
            $existing_count_ten = $row_ten['count'];

            if ($existing_count_ten > 0) {
                // Mã chuyên môn đã tồn tại, trả về thông báo lỗi
                return "Mã dân tộc đã tồn tại.";
            } else {
                // Lấy số lượng bản ghi hiện tại trong bảng chuyenmon
                $sql_count = "SELECT COUNT(*) AS count FROM dantoc";
                $cmd_count = $dbcon->prepare($sql_count);
                $cmd_count->execute();
                $row_count = $cmd_count->fetch(PDO::FETCH_ASSOC);
                $rowCount = $row_count['count'];

                // Tiến hành thêm mới với STT là số lượng bản ghi hiện tại + 1
                $sql_insert = "INSERT INTO dantoc(id, tendantoc) VALUES(:id, :tendantoc)";
                $cmd_insert = $dbcon->prepare($sql_insert);
                $cmd_insert->bindValue(":id", $rowCount + 1);
                $cmd_insert->bindValue(":tendantoc", $dantoc->gettendantoc());
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
    public function xoadantoc($dantoc)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql_delete = "DELETE FROM dantoc WHERE id=:id";
            $cmd_delete = $dbcon->prepare($sql_delete);
            $cmd_delete->bindValue(":id", $dantoc->getid());
            $result = $cmd_delete->execute();

            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật
    public function suadantoc($dantoc)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE dantoc SET tendantoc=:tendantoc WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tendantoc", $dantoc->gettendantoc());
            $cmd->bindValue(":id", $dantoc->getid());
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
?>