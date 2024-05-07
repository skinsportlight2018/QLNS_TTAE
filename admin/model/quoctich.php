<?php
class QUOCTICH
{
    private $id;
    private $tenquoctich;

    public function getid()
    {
        return $this->id;
    }

    public function setid($value)
    {
        $this->id = $value;
    }

    public function gettenquoctich()
    {
        return $this->tenquoctich;
    }

    public function settenquoctich($value)
    {
        $this->tenquoctich = $value;
    }

    public function layquoctich()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM quoctich";
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

    public function layquoctichtheoid($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM quoctich WHERE id=:id";
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

    public function themquoctich($quoctich)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql_check_ten = "SELECT COUNT(*) AS count FROM quoctich WHERE tenquoctich = :tenquoctich";
            $cmd_check_ten = $dbcon->prepare($sql_check_ten);
            $cmd_check_ten->bindValue(":tenquoctich", $quoctich->gettenquoctich());
            $cmd_check_ten->execute();
            $row_ten = $cmd_check_ten->fetch(PDO::FETCH_ASSOC);
            $existing_count_ten = $row_ten['count'];

            if ($existing_count_ten > 0) {
                return "Mã quốc tịch đã tồn tại.";
            } else {
                $sql_count = "SELECT COUNT(*) AS count FROM quoctich";
                $cmd_count = $dbcon->prepare($sql_count);
                $cmd_count->execute();
                $row_count = $cmd_count->fetch(PDO::FETCH_ASSOC);
                $rowCount = $row_count['count'];

                $sql_insert = "INSERT INTO quoctich(id, tenquoctich) VALUES(:id, :tenquoctich)";
                $cmd_insert = $dbcon->prepare($sql_insert);
                $cmd_insert->bindValue(":id", $rowCount + 1);
                $cmd_insert->bindValue(":tenquoctich", $quoctich->gettenquoctich());
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
    public function xoaquoctich($quoctich)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql_delete = "DELETE FROM quoctich WHERE id=:id";
            $cmd_delete = $dbcon->prepare($sql_delete);
            $cmd_delete->bindValue(":id", $quoctich->getid());
            $result = $cmd_delete->execute();

            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật
    public function suaquoctich($quoctich)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE quoctich SET tenquoctich=:tenquoctich WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tenquoctich", $quoctich->gettenquoctich());
            $cmd->bindValue(":id", $quoctich->getid());
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
