<?php
class CHAMCONG{
    private $id;
    private $nhanvien_id;
    private $ngaycong;
    private $gio;
    private $trangthai;
    private $lydo;
    private $tongcong;

    public function getid(){
        return $this->id;
    }

    public function setid($value){
        $this->id = $value;
    }

    public function getnhanvien_id(){
        return $this->nhanvien_id;
    }

    public function setnhanvien_id($value){
        $this->nhanvien_id = $value;
    }

    public function getngaycong(){
        return $this->ngaycong;
    }

    public function setngaycong($value){
        $this->ngaycong = $value;
    }

    public function getgio(){
        return $this->gio;
    }

    public function setgio($value){
        $this->gio = $value;
    }

    public function gettrangthai(){
        return $this->trangthai;
    }

    public function settrangthai($value){
        $this->trangthai = $value;
    }

    public function getlydo(){
        return $this->lydo;
    }

    public function setlydo($value){
        $this->lydo = $value;
    }

    public function gettongcong(){
        return $this->tongcong;
    }

    public function settongcong($value){
        $this->tongcong = $value;
    }

    public function laychamcong()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT cg.*, nv.hotennv FROM chamcong cg INNER JOIN nhanvien nv ON cg.nhanvien_id = nv.id ORDER BY id DESC";
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

    public function laychamcongtheoid($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM chamcong WHERE id=:id";
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

    public function laychamcongtheonv($nhanvien_id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM chamcong WHERE nhanvien_id = :nhanvien_id";
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

    public function themchamcong($chamcong)
    {
        $dbcon = DATABASE::connect();
        try {
            $currentRowCount = $this->laySoLuongBanGhiHienTai();

            $sql = "INSERT INTO chamcong(nhanvien_id, ngaycong, gio, lydo) 
                VALUES(:nhanvien_id, :ngaycong, :gio, :lydo)";
                
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":nhanvien_id", $chamcong->getnhanvien_id());
            $cmd->bindValue(":ngaycong", $chamcong->getngaycong());
            $cmd->bindValue(":gio", $chamcong->getgio());
            $cmd->bindValue(":lydo", $chamcong->getlydo());
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        } 
    } 

    // Xóa 
    public function xoachamcong($chamcong)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql_delete = "DELETE FROM chamcong WHERE id=:id";
            $cmd_delete = $dbcon->prepare($sql_delete);
            $cmd_delete->bindValue(":id", $chamcong->getid());
            $result = $cmd_delete->execute();

            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật
    public function suachamcong($chamcong)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE chamcong SET nhanvien_id=:nhanvien_id, ngaycong=:ngaycong, gio=:gio, lydo=:lydo WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":nhanvien_id", $chamcong->getnhanvien_id());
            $cmd->bindValue(":ngaycong", $chamcong->getngaycong());
            $cmd->bindValue(":gio", $chamcong->getgio());
            $cmd->bindValue(":lydo", $chamcong->getlydo());
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }    

    // Đổi trạng thái (0 khóa, 1 kích hoạt)
	public function doitrangthai($id,$trangthai){
		$db = DATABASE::connect();
		try{
			$sql = "UPDATE chamcong set trangthai=:trangthai where id=:id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':id',$id);
			$cmd->bindValue(':trangthai',$trangthai);
			$ketqua = $cmd->execute();            
            return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

    public function laySoLuongBanGhiHienTai() {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT COUNT(*) AS count FROM chamcong";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $row = $cmd->fetch(PDO::FETCH_ASSOC);
            return $row['count'];
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }    

    public function tongcongNhanVien($nhanvien_id, $month, $year)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT SUM(ngaycong) AS tong_cong FROM chamcong WHERE nhanvien_id = :nhanvien_id AND MONTH(ngaycong) = :month AND YEAR(ngaycong) = :year AND trangthai = 1";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":nhanvien_id", $nhanvien_id, PDO::PARAM_INT);
            $cmd->bindValue(":month", $month, PDO::PARAM_INT);
            $cmd->bindValue(":year", $year, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetch(PDO::FETCH_ASSOC);
            return $result['tong_cong'];
        } catch (PDOException $e) {
            // Ném ra một exception khi có lỗi truy vấn
            throw new Exception("Lỗi truy vấn: " . $e->getMessage());
        }
    }

}
?>
