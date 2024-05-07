<?php
class TRINHDO
{
    private $id;
    private $matrinhdo;
    private $tentrinhdo;

    public function getid()
    {
        return $this->id;
    }

    public function setid($value)
    {
        $this->id = $value;
    }

    public function getmatrinhdo()
    {
        return $this->matrinhdo;
    }

    public function setmatrinhdo($value)
    {
        $this->matrinhdo = $value;
    }

    public function gettentrinhdo()
    {
        return $this->tentrinhdo;
    }

    public function settentrinhdo($value)
    {
        $this->tentrinhdo = $value;
    }

    public function laytrinhdo()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM trinhdo";
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

    public function laytrinhdotheoid($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM trinhdo WHERE id=:id";
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

    public function themtrinhdo($trinhdo)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql_check_ma = "SELECT COUNT(*) AS count FROM trinhdo WHERE matrinhdo = :matrinhdo";
            $cmd_check_ma = $dbcon->prepare($sql_check_ma);
            $cmd_check_ma->bindValue(":matrinhdo", $trinhdo->getmatrinhdo());
            $cmd_check_ma->execute();
            $row_ma = $cmd_check_ma->fetch(PDO::FETCH_ASSOC);
            $existing_count_ma = $row_ma['count'];

            $sql_check_ten = "SELECT COUNT(*) AS count FROM trinhdo WHERE tentrinhdo = :tentrinhdo";
            $cmd_check_ten = $dbcon->prepare($sql_check_ten);
            $cmd_check_ten->bindValue(":tentrinhdo", $trinhdo->gettentrinhdo());
            $cmd_check_ten->execute();
            $row_ten = $cmd_check_ten->fetch(PDO::FETCH_ASSOC);
            $existing_count_ten = $row_ten['count'];

            if ($existing_count_ma > 0) {
                return "Mã trình độ đã tồn tại.";
            } elseif ($existing_count_ten > 0) {
                return "Tên trình độ đã tồn tại.";
            } else {
                $sql_count = "SELECT COUNT(*) AS count FROM trinhdo";
                $cmd_count = $dbcon->prepare($sql_count);
                $cmd_count->execute();
                $row_count = $cmd_count->fetch(PDO::FETCH_ASSOC);
                $rowCount = $row_count['count'];

                $sql_insert = "INSERT INTO trinhdo(id, matrinhdo, tentrinhdo) VALUES(:id, :matrinhdo, :tentrinhdo)";
                $cmd_insert = $dbcon->prepare($sql_insert);
                $cmd_insert->bindValue(":id", $rowCount + 1);
                $cmd_insert->bindValue(":matrinhdo", $trinhdo->getmatrinhdo());
                $cmd_insert->bindValue(":tentrinhdo", $trinhdo->gettentrinhdo());
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
    public function xoatrinhdo($trinhdo)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql_delete = "DELETE FROM trinhdo WHERE id=:id";
            $cmd_delete = $dbcon->prepare($sql_delete);
            $cmd_delete->bindValue(":id", $trinhdo->getid());
            $result = $cmd_delete->execute();

            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật
    public function suatrinhdo($trinhdo)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE trinhdo SET matrinhdo=:matrinhdo, tentrinhdo=:tentrinhdo WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":matrinhdo", $trinhdo->getmatrinhdo()); // Sửa đổi để lấy giá trị của machuyenmon
            $cmd->bindValue(":tentrinhdo", $trinhdo->gettentrinhdo());
            $cmd->bindValue(":id", $trinhdo->getid());
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
