<?php
include("../inc/sidebar.php");
include("../inc/top.php");

// Kiểm tra xem session đã được khởi tạo hay chưa
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

?>

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
	<div class="container">
		<h1 class="h3 mb-0 custom-heading">Tạo tài khoản</h1>
	</div>
</nav>

<div class="frame">
<div>
  <form method="post">
    <div class="row">
      <div class="col my-3">Họ*
        <input class="form-control" type="ho" name="txtho" required>
      </div>
      <div class="col my-3">
        <input class="form-control" type="text" name="txtten" placeholder="Tên" required>
      </div>
    </div>

    <div class="row">
      <div class="col my-3">
        <input class="form-control" type="number" name="txtemail" placeholder="Email" required>
      </div>
    </div>

    <div class="row">
      <div class="col my-3">
        <input class="form-control" type="text" name="txtsdt" placeholder="Số điện thoại" required>
      </div>
    </div>

    <div class="row">
      <div class="col my-3">
        <input class="form-control" type="password" name="txtmatkhau" placeholder="Mật khẩu" required>
      </div>
    </div>

    <div class="row">
      <div class="col my-3">
        <label>Chọn quyền</label>
        <select class="form-control" name="optloaind">                
          <option value="1">Quản trị viên</option>
          <option value="2" selected>Quản lý</option>
          <option value="3">Nhân viên</option>
        </select>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-6 text-center">
        <input type="hidden" name="action" value="xlthem" >
        <input class="btn btn-primary mr-2" type="submit" value="Hoàn tất">
        <input class="btn btn-danger ml-2" type="reset" value="Hủy">
      </div>
    </div>

  </form>          
</div>
</div>

<style>
  .frame {
    width: 1200px;
    height: 460px;
    border: 2px solid #ccc;
    padding: 20px;
    margin: 0 auto;
    margin-bottom: 10px;
  }
</style>
<?php include("../inc/footer.php"); ?>
