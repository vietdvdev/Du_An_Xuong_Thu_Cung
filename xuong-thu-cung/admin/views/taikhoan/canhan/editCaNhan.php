 <!-- header  -->
 <?php include './views/layout/header.php'; ?>
 <!-- Navbar -->
 <?php include './views/layout/navbar.php'; ?>
 <!-- /.navbar -->

 <!-- Main Sidebar Container -->
 <?php include './views/layout/sidebar.php'; ?>


 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Thông tin cá nhân quản trị</h1>
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
                         <h6 class="mt-2">Chức vụ: <?= $thongTin['chuc_vu_id'] == 1 ? 'User' : 'MN' ?></h6>
 
                     </div>
                 </div>

                 <!-- edit form column -->
                    <div class="col-md-9">


                     <form action="<?= BASE_URL_ADMIN . '?act=sua-thong-tin-ca-nhan-quan-tri' ?>" method="post" enctype="multipart/form-data">  
                    <hr>
                     <h3>Sửa thông tin cá nhân</h3>
                         <input type="hidden" name="quan_tri_id" value="<?= $thongTin['id'] ?>">
                         <div class="form-group">
                             <label class="col-lg-3 control-label">Họ và Tên:</label>
                             <div class="col-lg-12">
                                 <input class="form-control" type="text" value="<?= $thongTin['ho_ten'] ?> " name="ho_ten">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-lg-3 control-label">Email</label>
                             <div class="col-lg-12">
                                 <input class="form-control" type="email" value="<?= $thongTin['email'] ?>" name="email">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-lg-3 control-label">Số điện thoại</label>
                             <div class="col-lg-12">
                                 <input class="form-control" type="text" value="<?= $thongTin['so_dien_thoai'] ?>" name="so_dien_thoai">
                             </div>
                         </div>
                            <div class="form-group ">
                                <label >Giới tính </label>
                            <select name="gioi_tinh" class="form-control custom-select">
                                    <option <?= $thongTin['gioi_tinh'] == 1 ? 'selected' : '' ?> value="1">Nam</option>
                                    <option <?= $thongTin['gioi_tinh'] !== 1 ? 'selected' : '' ?> value="2">Nữ</option>

                            </select>
                            </div> 
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
                                 <input type="submit" class="btn btn-primary" value="Save Changes">                               
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



                         <form action="<?= BASE_URL_ADMIN . '?act=sua-mat-khau-ca-nhan-quan-tri' ?>" method="post">
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
                                 <input type="submit" class="btn btn-primary" value="Save Changes">                               
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
 <?php include './views/layout/footer.php'; ?>
 <!-- endforeach -->
 <!-- Page specific script -->

 <!-- Code injected by live-server -->
 </body>

 </html>