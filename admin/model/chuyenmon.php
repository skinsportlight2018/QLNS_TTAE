<?php
class CHUYENMON
{
    private $id;
    private $machuyenmon;
    private $tenchuyenmon;
    private $ghichu;

    public function getid()
    {
        return $this->id;
    }

    public function setid($value)
    {
        $this->id = $value;
    }

    public function getmachuyenmon()
    {
        return $this->machuyenmon;
    }

    public function setmachuyenmon($value)
    {
        $this->machuyenmon = $value;
    }

    public function gettenchuyenmon()
    {
        return $this->tenchuyenmon;
    }

    public function settenchuyenmon($value)
    {
        $this->tenchuyenmon = $value;
    }

    public function getghichu()
    {
        return $this->ghichu;
    }

    public function setghichu($value)
    {
        $this->ghichu = $value;
    }

    public function laychuyenmon()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM chuyenmon";
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

    public function laychuyenmontheoid($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM chuyenmon WHERE id=:id";
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

    public function themchuyenmon($chuyenmon)
    {
        $dbcon = DATABASE::connect();
        try {
            // Kiểm tra xem mã chuyên môn đã tồn tại chưa
            $sql_check_ma = "SELECT COUNT(*) AS count FROM chuyenmon WHERE machuyenmon = :machuyenmon";
            $cmd_check_ma = $dbcon->prepare($sql_check_ma);
            $cmd_check_ma->bindValue(":machuyenmon", $chuyenmon->getmachuyenmon());
            $cmd_check_ma->execute();
            $row_ma = $cmd_check_ma->fetch(PDO::FETCH_ASSOC);
            $existing_count_ma = $row_ma['count'];

            // Kiểm tra xem tên chuyên môn đã tồn tại chưa
            $sql_check_ten = "SELECT COUNT(*) AS count FROM chuyenmon WHERE tenchuyenmon = :tenchuyenmon";
            $cmd_check_ten = $dbcon->prepare($sql_check_ten);
            $cmd_check_ten->bindValue(":tenchuyenmon", $chuyenmon->gettenchuyenmon());
            $cmd_check_ten->execute();
            $row_ten = $cmd_check_ten->fetch(PDO::FETCH_ASSOC);
            $existing_count_ten = $row_ten['count'];

            if ($existing_count_ma > 0) {
                // Mã chuyên môn đã tồn tại, trả về thông báo lỗi
                return "Mã chuyên môn đã tồn tại.";
            } elseif ($existing_count_ten > 0) {
                // Tên chuyên môn đã tồn tại, trả về thông báo lỗi
                return "Tên chuyên môn đã tồn tại.";
            } else {
                // Lấy số lượng bản ghi hiện tại trong bảng chuyenmon
                $sql_count = "SELECT COUNT(*) AS count FROM chuyenmon";
                $cmd_count = $dbcon->prepare($sql_count);
                $cmd_count->execute();
                $row_count = $cmd_count->fetch(PDO::FETCH_ASSOC);
                $rowCount = $row_count['count'];

                // Tiến hành thêm mới với STT là số lượng bản ghi hiện tại + 1
                $sql_insert = "INSERT INTO chuyenmon(id, machuyenmon, tenchuyenmon) VALUES(:id, :machuyenmon, :tenchuyenmon)";
                $cmd_insert = $dbcon->prepare($sql_insert);
                $cmd_insert->bindValue(":id", $rowCount + 1);
                $cmd_insert->bindValue(":machuyenmon", $chuyenmon->getmachuyenmon());
                $cmd_insert->bindValue(":tenchuyenmon", $chuyenmon->gettenchuyenmon());
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
    public function xoachuyenmon($chuyenmon)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql_delete = "DELETE FROM chuyenmon WHERE id=:id";
            $cmd_delete = $dbcon->prepare($sql_delete);
            $cmd_delete->bindValue(":id", $chuyenmon->getid());
            $result = $cmd_delete->execute();

            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật
    public function suachuyenmon($chuyenmon)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE chuyenmon SET machuyenmon=:machuyenmon, tenchuyenmon=:tenchuyenmon WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":machuyenmon", $chuyenmon->getmachuyenmon()); // Sửa đổi để lấy giá trị của machuyenmon
            $cmd->bindValue(":tenchuyenmon", $chuyenmon->gettenchuyenmon());
            $cmd->bindValue(":id", $chuyenmon->getid());
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