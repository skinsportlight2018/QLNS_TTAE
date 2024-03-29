<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đăng nhập - AE</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../inc/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="../inc/js/sb-admin-2.js"></script>


</head>

<body class="blue" style="background-color:#2C3D57" >

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 TTAE d-flex align-items-center justify-content-center">
                            <div class="rounded-circle overflow-hidden" style="width: 300px; height: 300px;">
                                <img src="../../img/Logo/LogoAE1.jpg" alt="TTAE">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Chào mừng đến với Trung tâm ngoại ngữ AE!</h1>
                                </div>

                                <form method="post" action="index.php">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user rounded-pill" name="txtemail" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user rounded-pill" placeholder="Mật khẩu" name="txtmatkhau">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Nhớ tài khoản</label>
                                        </div>
                                    </div>
                                    <hr>
                                        <input type="hidden" name="action" value="xldangnhap">
                                        <input type="submit" class="btn btn-lg btn-user btn-block rounded-pill" style="background-color:#2C3D57; color: white;" value="Đăng nhập">
                                    <hr>
                                    <a href="#" class="btn btn-google btn-user btn-block rounded-pill">
                                        <i class="fab fa-google fa-fw"></i> Đăng nhập bằng Google
                                        
                                    </a>

                                </form>   

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

</body>

</html>