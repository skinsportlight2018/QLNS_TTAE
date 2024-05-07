<?php
class TAIKHOAN
{

	public function kiemtrataikhoanhople($email, $matkhau)
	{
		$db = DATABASE::connect();
		try {
			$sql = "SELECT * FROM taikhoan WHERE email=:email AND matkhau=:matkhau AND trangthai=1";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":email", $email);
			$cmd->bindValue(":matkhau", md5($matkhau));
			$cmd->execute();
			$valid = ($cmd->rowCount() == 1);
			$cmd->closeCursor();
			return $valid;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	public function laythongtintaikhoan($email)
	{
		$db = DATABASE::connect();
		try {
			$sql = "SELECT * FROM taikhoan WHERE email=:email";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":email", $email);
			$cmd->execute();
			$ketqua = $cmd->fetch();
			$cmd->closeCursor();
			return $ketqua;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	public function laydanhsachtaikhoan()
	{
		$db = DATABASE::connect();
		try {
			$sql = "SELECT t.*, nv.hotennv FROM taikhoan t INNER JOIN nhanvien nv ON t.nhanvien_id = nv.id ORDER BY id DESC";
			$cmd = $db->prepare($sql);
			$cmd->execute();
			$ketqua = $cmd->fetchAll();
			return $ketqua;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	public function themtaikhoan($ho, $ten, $email, $matkhau, $sdt, $quyen, $nhanvien_id)
	{
		$db = DATABASE::connect();
		try {
			$sql_check_phone = "SELECT COUNT(*) FROM taikhoan WHERE sdt = :sdt";
			$stmt_check_phone = $db->prepare($sql_check_phone);
			$stmt_check_phone->bindValue(':sdt', $sdt);
			$stmt_check_phone->execute();
			$phone_count = $stmt_check_phone->fetchColumn();
			$stmt_check_phone->closeCursor();

			if (!preg_match("/@americanenglish.edu.vn/", $email)) {
				return false;
			}

			if ($phone_count > 0) {
				return "Số điện thoại đã bị trùng!";
			} else {
				$sql = "INSERT INTO taikhoan(ho, ten, email, matkhau, sdt, quyen, nhanvien_id) VALUES(:ho, :ten, :email, :matkhau, :sdt, :quyen, :nhanvien_id)";
				$cmd = $db->prepare($sql);
				$cmd->bindValue(':ho', $ho);
				$cmd->bindValue(':ten', $ten);
				$cmd->bindValue(':email', $email);
				$cmd->bindValue(':matkhau', md5($matkhau));
				$cmd->bindValue(':sdt', $sdt);
				$cmd->bindValue(':quyen', $quyen);
				$cmd->bindValue(':nhanvien_id', $nhanvien_id);
				$cmd->execute();
				$id = $db->lastInsertId();

				$hinhanh = 'Avatar_AE.jpg';
				$sql_avatar = "UPDATE taikhoan SET hinhanh = :hinhanh WHERE id = :id";
				$cmd_avatar = $db->prepare($sql_avatar);
				$cmd_avatar->bindValue(':hinhanh', $hinhanh);
				$cmd_avatar->bindValue(':id', $id);
				$cmd_avatar->execute();

				return $id;
			}
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	public function capnhattaikhoan($id, $ho, $ten, $hinhanh, $email, $sdt)
	{
		$db = DATABASE::connect();
		try {

			$sql = "UPDATE taikhoan set ho=:ho, ten=:ten, hinhanh=:hinhanh, email=:email, sdt=:sdt where id=:id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':id', $id);
			$cmd->bindValue(':ho', $ho);
			$cmd->bindValue(':ten', $ten);
			$cmd->bindValue(':hinhanh', $hinhanh);
			$cmd->bindValue(':email', $email);
			$cmd->bindValue(':sdt', $sdt);
			$ketqua = $cmd->execute();
			return $ketqua;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Đổi mật khẩu
	public function doimatkhau($email, $matkhau)
	{
		$db = DATABASE::connect();
		try {
			$sql = "UPDATE taikhoan set matkhau=:matkhau where email=:email";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':email', $email);
			$cmd->bindValue(':matkhau', md5($matkhau));
			$ketqua = $cmd->execute();
			return $ketqua;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Đổi quyền (loại người dùng: 1 quản trị, 2 nhân viên. Không cần nâng cấp quyền đối với loại người dùng 3-khách hàng)
	public function doiquyentaikhoan($email, $quyen)
	{
		$db = DATABASE::connect();
		try {
			$sql = "UPDATE taikhoan set quyen=:quyen where email=:email";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':email', $email);
			$cmd->bindValue(':quyen', $quyen);
			$ketqua = $cmd->execute();
			return $ketqua;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Đổi trạng thái (0 khóa, 1 kích hoạt)
	public function doitrangthai($id, $trangthai)
	{
		$db = DATABASE::connect();
		try {
			$sql = "UPDATE taikhoan set trangthai=:trangthai where id=:id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':id', $id);
			$cmd->bindValue(':trangthai', $trangthai);
			$ketqua = $cmd->execute();
			return $ketqua;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
}
