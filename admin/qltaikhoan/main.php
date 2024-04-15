<?php
  include("../inc/sidebar.php");
  include("../inc/top.php");
?>

<link rel="stylesheet" href="../css/table.css">

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
	<div class="container">
		<h1 class="h3 mb-0 custom-heading">Danh sách tài khoản</h1>
	</div>
</nav>

  <!-- Thông báo lỗi nếu có -->
  <?php
  if(isset($tb)){
  ?>
  <div class="alert alert-danger alert-dismissible fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Lỗi!</strong> <?php echo $tb; ?>
  </div>
  <?php
  }
  ?>

  <!-- Danh sách người dùng -->
  <div class="container-fluid">
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
					<thead>
        <tr>
            <th>STT</th>
            <th>Họ</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Quyền</th>
            <th>Trạng thái</th>
            <th>Kích hoạt</th>
        </tr>
    </thead>
    <tbody>
        
    <?php
    $stt = 1; 
    foreach ($taikhoan as $tk): ?>
        <tr>
            <td><?php echo $stt++; ?></td>
            <td><?php echo $tk["ho"]; ?></td>
            <td><?php echo $tk["ten"]; ?></td>
            <td><?php echo $tk["email"]; ?></td>
            <td><?php echo $tk["sdt"]; ?></td>
            <td><?php if($tk["quyen"]==1) echo "Quản trị viên"; elseif ($tk["quyen"]==2) echo "Quản lý"; elseif ($tk["quyen"]==3) echo "Nhân viên"; ?></td>
            <td class="text-center">
                <?php if($tk["quyen"] != 1): ?>
                    <?php if($tk["trangthai"] == 1): ?>
                        <div class="bg-success text-white rounded-pill py-1 px-2">
                            Hoạt động
                        </div>
                    <?php else: ?>
                        <div class="bg-danger text-white rounded-pill py-1 px-2">
                            Khóa
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </td>

            <td>
                <?php 
                if($tk["quyen"]!=1) 
                {
                    if($tk["trangthai"]==1)
                    {
                ?>
                <a href="?action=khoa&trangthai=0&matk=<?php echo $tk["id"]; ?>">Khóa</a></td></tr>
                <?php 
                    }
                    else 
                    { 
                ?>
                <a href="?action=khoa&trangthai=1&matk=<?php echo $tk["id"]; ?>">Kích hoạt</a></td></tr>
                <?php 
                    }
                }
                ?>
    <?php endforeach; ?>
</tbody>

          
          <div class="mb-4" >
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAcc"><i class="bi bi-file-earmark-plus px-0.5"></i>Tạo tài khoản</button>
          </div>

                    <!-- Logout Modal-->
                   <div class="modal fade" id="addAcc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="exampleModalLabel">Tạo tài khoản</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                                                
                            <div class="frame">
                                <div>
                                    <form method="post">
                                      <div class="thongnaosao">
                                        <span class="text">Dấu</span> <span class="Sao">*</span> <span style="font-style: italic;">bắt buộc phải nhập</span>
                                      </div>  
                                      <div>
                                          <div class="row">
                                            <div class="col required">
                                                Họ <a class="Sao">*</a>
                                                <input class="form-control mb-2" type="text" name="txtho" required style="width: 215px;">
                                            </div>

                                              <div class="col required">Tên <a class="Sao">*</a>
                                                  <input class="form-control" type="text" name="txtten" required style="width: 215px;">
                                              </div>
                                          </div>
                                        </div>

                                        <div class="row">
                                            <div class="col required">Email <a class="Sao">*</a> <a style="font-style: italic;">( Tên + @americanenglish.edu.vn)</a>
                                                <input class="form-control" type="text" name="txtemail" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col required">Số điện thoại <a class="Sao">*</a>
                                                <input class="form-control" type="text" name="txtsdt" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col required">Mật khẩu <a class="Sao">*</a>
                                                <input class="form-control" type="password" name="txtmatkhau" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col my-2">
                                                <label>Chọn quyền</label>
                                                <select class="form-control" name="optquyen">                
                                                    <option value="1">Quản trị viên</option>
                                                    <option value="2">Quản lý</option>
                                                    <option value="3" selected>Nhân viên</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row justify-content-center" style="margin-bottom: 10px;">
                                            <div class="col-6 text-center">
                                                <input type="hidden" name="action" value="xlthem" >
                                                <input class="btn btn-primary mr-2" type="submit" value="Hoàn tất">
                                                <input class="btn btn-danger ml-2" type="reset" value="Xóa">
                                            </div>
                                        </div>

                                    </form>          
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

  </table>
        </div>
        </div>
</div>
<?php include("../inc/footer.php"); ?>
