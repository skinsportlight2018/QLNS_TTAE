<?php 

// create session
session_start();


  // include file

  include('../layouts/sidebar.php');
  include('../layouts/top.php');


  // show data
  $showData = "SELECT id, manv, hinhanh, hotennv, gioitinh, ngaytao, ngaysinh, noisinh, cccd, trangthai FROM nhanvien ORDER BY id DESC";
  $result = mysqli_query($conn, $showData);
  $arrShow = array();
  while ($row = mysqli_fetch_array($result)) {
    $arrShow[] = $row;
  }

  // delete record
  if(isset($_POST['delete']))
  {
    $id = $_POST['idStaff'];
    $target_dir = "../uploads/staffs/";

    // get image
    $image = "SELECT hinhanh FROM nhanvien WHERE id = $id";
    $resultImage = mysqli_query($conn, $image);
    $rowImage = mysqli_fetch_array($resultImage);
    $removeImage = $target_dir . $rowImage['hinhanh'];

    $delete = "DELETE FROM nhanvien WHERE id = $id";
    $resultDel = mysqli_query($conn, $delete);
    if($resultDel)
    {
      $showMess = true;
      if($rowImage['hinhanh'] != "demo-3x4.jpg")
      {
        unlink($removeImage);
      }

      $success['success'] = 'Xóa nhân viên thành công.';
      echo '<script>setTimeout("window.location=\'danh-sach-nhan-vien.php?p=staff&a=list-staff\'",1000);</script>';  
    }
  }

?>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form method="POST">
          <div class="modal-header">
            <span style="font-size: 18px;">Thông báo</span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="idStaff">
            Bạn có thực sự muốn xóa nhân viên này?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
            <button type="submit" class="btn btn-primary" name="delete">Xóa</button>
          </div>
        </form>
      </div>
    </div>
  </div>

      <!-- row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách nhân viên</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php 
                // show error
                {
                  echo "<div class='alert alert-warning alert-dismissible'>";
                  echo "<h4><i class='icon fa fa-ban'></i> Thông báo!</h4>";
                  echo "Bạn <b> không có quyền </b> thực hiện chức năng này.";
                  echo "</div>";
                }
              ?>

              <?php 
                // show error
                if(isset($error)) 
                {
                  if($showMess == false)
                  {
                    echo "<div class='alert alert-danger alert-dismissible'>";
                    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                    echo "<h4><i class='icon fa fa-ban'></i> Lỗi!</h4>";
                    foreach ($error as $err) 
                    {
                      echo $err . "<br/>";
                    }
                    echo "</div>";
                  }
                }
              ?>
              <?php 
                // show success
                if(isset($success)) 
                {
                  if($showMess == true)
                  {
                    echo "<div class='alert alert-success alert-dismissible'>";
                    echo "<h4><i class='icon fa fa-check'></i> Thành công!</h4>";
                    foreach ($success as $suc) 
                    {
                      echo $suc . "<br/>";
                    }
                    echo "</div>";
                  }
                }
              ?>
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã nhân viên</th>
                    <th>Ảnh</th>
                    <th>Tên nhân viên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Nơi sinh</th>
                    <th>CCCD</th>
                    <th>Tình trạng</th>
                    <th>Xem</th> 
                    <th>Sửa</th>
                    <th>Xóa</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $count = 1;
                    foreach ($arrShow as $arrS) 
                    {
                  ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $arrS['manv']; ?></td>
                        <td><img src="../uploads/staffs/<?php echo $arrS['hinhanh']; ?>" width="80"></td>
                        <td><?php echo $arrS['hotennv']; ?></td>
                        <td>
                        <?php
                          if($arrS['gioitinh'] == 1)
                          {
                            echo "Nam";
                          } 
                          else
                          {
                            echo "Nữ";
                          }
                        ?>
                        </td>
                        <td>
                        <?php 
                          $date = date_create($arrS['ngaysinh']);
                          echo date_format($date, 'd-m-Y');
                        ?>
                        </td>
                        <td><?php echo $arrS['noisinh']; ?></td>
                        <td><?php echo $arrS['cccd']; ?></td>
                        <td>
                        <?php 
                          if($arrS['trangthai'] == 1)
                          {
                            echo '<span class="badge bg-blue"> Đang làm việc </span>';
                          }
                          else
                          {
                            echo '<span class="badge bg-red"> Đã nghỉ việc </span>';
                          }
                        ?>
                        </td>
                        <td>
                          <?php 
                            if($row_acc['quyen'] == 1)
                            {
                              echo "<form method='POST'>";
                              echo "<input type='hidden' value='".$arrS['id']."' name='idStaff'/>";
                              echo "<button type='submit' class='btn btn-primary btn-flat'  name='view'><i class='fa fa-eye'></i></button>";
                              echo "</form>";
                            }
                            else
                            {
                              echo "<button type='button' class='btn btn-primary btn-flat' disabled><i class='fa fa-eye'></i></button>";
                            }
                          ?>
                        </td>
                        <td>
                          <?php 
                            if($row_acc['quyen'] == 1)
                            {
                              echo "<form method='POST'>";
                              echo "<input type='hidden' value='".$arrS['id']."' name='idStaff'/>";
                              echo "<button type='submit' class='btn bg-orange btn-flat'  name='edit'><i class='fa fa-edit'></i></button>";
                              echo "</form>";
                            }
                            else
                            {
                              echo "<button type='button' class='btn bg-orange btn-flat' disabled><i class='fa fa-edit'></i></button>";
                            }
                          ?>
                          
                        </td>
                        <td>
                          <?php 
                            if($row_acc['quyen'] == 1)
                            {
                              echo "<button type='button' class='btn bg-maroon btn-flat' data-toggle='modal' data-target='#exampleModal' data-whatever='".$arrS['id']."'><i class='fa fa-trash'></i></button>";
                            }
                            else
                            {
                              echo "<button type='button' class='btn bg-maroon btn-flat' disabled><i class='fa fa-trash'></i></button>";
                            }
                          ?>
                        </td>
                      </tr>
                  <?php
                      $count++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

<?php
  // include
  include('../layouts/footer.php');



?>  