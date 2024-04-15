<?php
class BANGCAP{
    private $id;
    private $mabangcap;
    private $tenbangcap;
    private $ghichu;

    public function getid(){
        return $this->id;
    }

    public function setid($value){
        $this->id = $value;
    }

    public function getmabangcap(){
        return $this->mabangcap;
    }

    public function setmabangcap($value){
        $this->mabangcap = $value;
    }

    public function gettenbangcap(){
        return $this->tenbangcap;
    }

    public function settenbangcap($value){
        $this->tenbangcap = $value;
    }

    public function getghichu(){
        return $this->ghichu;
    }

    public function setghichu($value){
        $this->ghichu = $value;
    }

    // Lấy danh sách chức vụ
    public function laybangcap(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM bangcap";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Lấy danh sách loại nhân viên theo theo id
    public function laybangcaptheoid($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM bangcap WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $result = $cmd->fetch();             
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Thêm mới
    public function thembangcap($bangcap){
        $dbcon = DATABASE::connect();
        try {
            // Kiểm tra xem mã chuyên môn đã tồn tại chưa
            $sql_check_ma = "SELECT COUNT(*) AS count FROM bangcap WHERE mabangcap = :mabangcap";
            $cmd_check_ma = $dbcon->prepare($sql_check_ma);
            $cmd_check_ma->bindValue(":mabangcap", $bangcap->getmabangcap());
            $cmd_check_ma->execute();
            $row_ma = $cmd_check_ma->fetch(PDO::FETCH_ASSOC);
            $existing_count_ma = $row_ma['count'];

            // Kiểm tra xem tên chuyên môn đã tồn tại chưa
            $sql_check_ten = "SELECT COUNT(*) AS count FROM bangcap WHERE tenbangcap = :tenbangcap";
            $cmd_check_ten = $dbcon->prepare($sql_check_ten);
            $cmd_check_ten->bindValue(":tenbangcap", $bangcap->gettenbangcap());
            $cmd_check_ten->execute();
            $row_ten = $cmd_check_ten->fetch(PDO::FETCH_ASSOC);
            $existing_count_ten = $row_ten['count'];

            if ($existing_count_ma > 0) {
                // Mã bằng cấp đã tồn tại, trả về thông báo lỗi
                return "Mã bằng cấp đã tồn tại.";
            } elseif ($existing_count_ten > 0) {
                // Tên bằng cấp đã tồn tại, trả về thông báo lỗi
                return "Tên bằng cấp đã tồn tại.";
            } else {
                // Lấy số lượng bản ghi hiện tại trong bảng chuyenmon
                $sql_count = "SELECT COUNT(*) AS count FROM bangcap";
                $cmd_count = $dbcon->prepare($sql_count);
                $cmd_count->execute();
                $row_count = $cmd_count->fetch(PDO::FETCH_ASSOC);
                $rowCount = $row_count['count'];

                // Tiến hành thêm mới với STT là số lượng bản ghi hiện tại + 1
                $sql_insert = "INSERT INTO bangcap(id, mabangcap, tenbangcap) VALUES(:id, :mabangcap, :tenbangcap)";
                $cmd_insert = $dbcon->prepare($sql_insert);
                $cmd_insert->bindValue(":id", $rowCount + 1);
                $cmd_insert->bindValue(":mabangcap", $bangcap->getmabangcap());
                $cmd_insert->bindValue(":tenbangcap", $bangcap->gettenbangcap());
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
    public function xoabangcap($bangcap)
    {
        $dbcon = DATABASE::connect();
        try{
        $sql = "DELETE FROM bangcap WHERE id=:id";
        $cmd = $dbcon->prepare($sql);
        $cmd->bindValue(":id", $bangcap->id);
        $result = $cmd->execute();

        return $result;
        }
        catch(PDOException $e){
        $error_message = $e->getMessage();
        echo "<p>Lỗi truy vấn: $error_message</p>";
        exit();
        }
    }
    // Cập nhật 
    public function suabangcap($bangcap){
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE bangcap SET mabangcap=:mabangcap, tenbangcap=:tenbangcap WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":mabangcap", $bangcap->getmabangcap()); // Sửa đổi để lấy giá trị của mabangcap
            $cmd->bindValue(":tenbangcap", $bangcap->gettenbangcap());
            $cmd->bindValue(":id", $bangcap->getid());
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
