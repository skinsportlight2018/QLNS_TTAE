<?php
class CHUCVU{
    private $id;
    private $machucvu;
    private $tenchucvu;
    private $luongngay;
    private $ghichu;

    public function getid(){
        return $this->id;
    }

    public function setid($value){
        $this->id = $value;
    }

    public function getmachucvu(){
        return $this->machucvu;
    }

    public function setmachucvu($value){
        $this->machucvu = $value;
    }

    public function gettenchucvu(){
        return $this->tenchucvu;
    }

    public function settenchucvu($value){
        $this->tenchucvu = $value;
    }

    public function getluongngay(){
        return $this->luongngay;
    }

    public function setluongngay($value){
        $this->luongngay = $value;
    }

    public function getghichu(){
        return $this->ghichu;
    }

    public function setghichu($value){
        $this->ghichu = $value;
    }

    public function laychucvu()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM chucvu";
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

    public function laychucvutheoid($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM chucvu WHERE id=:id";
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

    public function themchucvu($chucvu)
    {
        $dbcon = DATABASE::connect();
        try {
            // Kiểm tra xem mã chuyên môn đã tồn tại chưa
            $sql_check_ma = "SELECT COUNT(*) AS count FROM chucvu WHERE machucvu = :machucvu";
            $cmd_check_ma = $dbcon->prepare($sql_check_ma);
            $cmd_check_ma->bindValue(":machucvu", $chucvu->getmachucvu());
            $cmd_check_ma->execute();
            $row_ma = $cmd_check_ma->fetch(PDO::FETCH_ASSOC);
            $existing_count_ma = $row_ma['count'];

            // Kiểm tra xem tên chuyên môn đã tồn tại chưa
            $sql_check_ten = "SELECT COUNT(*) AS count FROM chucvu WHERE tenchucvu = :tenchucvu";
            $cmd_check_ten = $dbcon->prepare($sql_check_ten);
            $cmd_check_ten->bindValue(":tenchucvu", $chucvu->gettenchucvu());
            $cmd_check_ten->execute();
            $row_ten = $cmd_check_ten->fetch(PDO::FETCH_ASSOC);
            $existing_count_ten = $row_ten['count'];

            if ($existing_count_ma > 0) {
                // Mã chuyên môn đã tồn tại, trả về thông báo lỗi
                return "Mã chức vụ đã tồn tại.";
            } elseif ($existing_count_ten > 0) {
                // Tên chuyên môn đã tồn tại, trả về thông báo lỗi
                return "Tên chức vụ đã tồn tại.";
            } else {
                // Lấy số lượng bản ghi hiện tại trong bảng chuyenmon
                $sql_count = "SELECT COUNT(*) AS count FROM chucvu";
                $cmd_count = $dbcon->prepare($sql_count);
                $cmd_count->execute();
                $row_count = $cmd_count->fetch(PDO::FETCH_ASSOC);
                $rowCount = $row_count['count'];

                // Tiến hành thêm mới với STT là số lượng bản ghi hiện tại + 1
                $sql_insert = "INSERT INTO chucvu(id, machucvu, tenchucvu, luongngay) VALUES(:id, :machucvu, :tenchucvu, :luongngay)";
                $cmd_insert = $dbcon->prepare($sql_insert);
                $cmd_insert->bindValue(":id", $rowCount + 1);
                $cmd_insert->bindValue(":machucvu", $chucvu->getmachucvu());
                $cmd_insert->bindValue(":tenchucvu", $chucvu->gettenchucvu());
                $cmd_insert->bindValue(":luongngay", $chucvu->getluongngay());
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
    public function xoachucvu($chucvu)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql_delete = "DELETE FROM chucvu WHERE id=:id";
            $cmd_delete = $dbcon->prepare($sql_delete);
            $cmd_delete->bindValue(":id", $chucvu->getid());
            $result = $cmd_delete->execute();

            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật
    public function suachucvu($chucvu)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE chucvu SET machucvu=:machucvu, tenchucvu=:tenchucvu, luongngay=:luongngay WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":machucvu", $chucvu->getmachucvu()); 
            $cmd->bindValue(":tenchucvu", $chucvu->gettenchucvu());
            $cmd->bindValue(":luongngay", $chucvu->getluongngay());
            $cmd->bindValue(":id", $chucvu->getid());
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }    

    public function laySoLuongNhanVienTheoChucVu()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT cv.tenchucvu, COUNT(nv.id) AS soLuong 
                FROM chucvu cv 
                LEFT JOIN nhanvien nv ON cv.id = nv.chucvu_id 
                GROUP BY cv.id";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

}
?>
