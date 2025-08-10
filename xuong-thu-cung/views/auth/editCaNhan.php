<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>


 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6 ">
                     <h1>Thông tin cá nhân khách hàng</h1>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <div class="container-fluid">

             <div class="row">
                 <!-- left column -->
                 
                 <div class="col-md-3">
                     <div class="text-center">
                         <img src="<?= BASE_URL. $thongTin['anh_dai_dien'] ?> " style="width: 150px">
                         <h6 class="mt-2">Họ tên: <?= $thongTin['ho_ten'] ?></h6>
                     </div>
                 </div>

                 <!-- edit form column -->
                    <div class="col-md-9">


                     <form action="<?= BASE_URL . '?act=sua-thong-tin-ca-nhan-khach-hang' ?>" method="post" enctype="multipart/form-data">  
                    <hr>
                     <h3>Sửa thông tin cá nhân</h3>
                         <input type="hidden" name="khach_hang_id" value="<?= $thongTin['id'] ?>">
                         <div class="form-group">
                             <label class="col-lg-3 control-label">Họ và Tên:</label>
                             <div class="col-lg-12">
                                 <input class="form-control" type="text" value="<?= $thongTin['ho_ten']?> "name="ho_ten">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-lg-3 control-label">Ngày sinh</label>
                             <div class="col-lg-12">
                                 <input class="form-control" type="date" value="<?= $thongTin['ngay_sinh'] ?>" name="ngay_sinh">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-lg-3 control-label">Số điện thoại</label>
                             <div class="col-lg-12">
                                 <input class="form-control" type="text" value="<?= $thongTin['so_dien_thoai'] ?>" name="so_dien_thoai">
                             </div>
                            </div>
                            <div class="form-group ">
                                <p><b>Giới tính</b></p>
                                <!-- <label >Giới tính </label> -->
                            <select name="gioi_tinh" class="form-control custom-select">
                                    <option <?= $thongTin['gioi_tinh'] == 1 ? 'selected' : '' ?> value="1">Nam</option>
                                    <option <?= $thongTin['gioi_tinh'] !== 1 ? 'selected' : '' ?> value="2">Nữ</option>

                            </select>
                            </div> 
                             <br><br>
                         <div class="form-group">
                             <label class="col-lg-3 control-label">Địa chỉ</label>
                             <div class="col-lg-12">
                                 <input class="form-control" type="text" value="<?= $thongTin['dia_chi'] ?>" name="dia_chi">
                             </div>
                         </div>

                        <div class="form-group">
                            <label for="hinh_anh">Thay ảnh đại diện </label>
                            <input type="file" id="inputName" name="anh_dai_dien"  class="form-control">
                        </div>

                         <hr>
                            <div class="form-group">
                             <label class="col-md-3 control-label"></label>
                             <div class="col-md-12">
                                 <input type="submit" class="btn btn-primary" value="Cập nhật thông tin">                               
                             </div>
                            </div>
                         </form>
                            <hr>


                         <h3>Đổi mật khẩu </h3>

                        <?php  if (isset($_SESSION['success'])){ ?>
                                <div class="alert alert-info alert-dismissable">
                                 <a class="panel-close close" data-dismiss="alert">×</a> 
                                    <i class="fa fa-coffee"></i>
                                 <?=   $_SESSION['success']; ?>
                            </div>    
                         <?php } ?>



                         <form action="<?= BASE_URL . '?act=sua-mat-khau-ca-nhan-khach-hang' ?>" method="post">
                         <div class="form-group">
                             <label class="col-md-3 control-label">Mật khẩu cũ:</label>
                             <div class="col-md-12">
                                 <input class="form-control" type="text" name="old_pass" value="">
                                    <?php  if (isset($_SESSION['error']['old_pass'])){ ?>
                                        <p class="text-danger"><?= $_SESSION['error']['old_pass']  ?></p>
                                    <?php } ?>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-3 control-label">Mật khẩu mới:</label>
                             <div class="col-md-12">
                                 <input class="form-control" type="text" name="new_pass" value="">
                                 <?php  if (isset($_SESSION['error']['new_pass'])){ ?>
                                        <p class="text-danger"><?= $_SESSION['error']['new_pass']  ?></p>
                                    <?php } ?>                                
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-3 control-label">Nhập lại mật khẩu mới:</label>
                             <div class="col-md-12">
                                 <input class="form-control" type="text" name="confirm_pass" value="">
                                <?php  if (isset($_SESSION['error']['confirm_pass'])){ ?>
                                        <p class="text-danger"><?= $_SESSION['error']['confirm_pass']  ?></p>
                                    <?php } ?>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-3 control-label"></label>
                             <div class="col-md-12">
                                 <input type="submit" class="btn btn-primary" value="Lưu mật khẩu mới">                               
                             </div>
                         </div>
                            </form>
                     
                 </div>
             </div>
         </div>
         <hr>
         <!-- /.container-fluid -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->
 <!-- <footer> -->
 <?php require_once 'views/layout/footer.php';  ?> ?>
 <!-- endforeach -->
 <!-- Page specific script -->

 <!-- Code injected by live-server -->
 </body>
 
 <style>
    /* Tổng thể layout */
.content-wrapper {
    padding: 30px 20px;
    background-color: #f8f9fa;
    min-height: 100vh;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Tiêu đề */
.content-header h1 {
    font-size: 24px;
    font-weight: 600;
    color: #343a40;
}

/* Ảnh đại diện và thông tin ngắn */
.text-center img {
    border-radius: 50%;
    border: 3px solid #007bff;
    margin-bottom: 15px;
}

.text-center h6 {
    font-size: 16px;
    color: #495057;
}

/* Form chỉnh sửa */
form {
    background: #ffffff;
    border-radius: 8px;
    padding: 25px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

form h3 {
    font-size: 20px;
    margin-bottom: 20px;
    color: #007bff;
    font-weight: 600;
}

.form-group label {
    font-weight: 500;
    margin-bottom: 5px;
    color: #495057;
}

.form-control {
    border-radius: 5px;
    padding: 10px;
    font-size: 14px;
}

select.form-control {
    cursor: pointer;
}

.btn-primary {
    background-color: #007bff;
    border: none;
    padding: 10px 20px;
    font-weight: 500;
    transition: 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Alert thông báo */
.alert {
    padding: 12px 20px;
    border-radius: 6px;
    margin-top: 15px;
    margin-bottom: 15px;
}

.alert-info {
    background-color: #e2f0fb;
    color: #0c5460;
    border: 1px solid #bee5eb;
}

.alert .close {
    color: #000;
    font-size: 20px;
    opacity: 0.6;
}

/* Error text */
.text-danger {
    font-size: 13px;
    margin-top: 5px;
}

/* Responsive fix */
@media (max-width: 768px) {
    .col-md-3, .col-md-9, .col-md-12 {
        padding-left: 0;
        padding-right: 0;
    }

    .text-center {
        margin-bottom: 30px;
    }
}

</style>


 </html>