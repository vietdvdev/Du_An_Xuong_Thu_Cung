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
           <h1>Quản lý danh Sách sản phẩm </h1>
         </div>
       </div>
     </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
       <div class="row">
         <div class="col-12">

         <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> Thêm Sản Phẩm </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= BASE_URL_ADMIN . '?act=them-san-pham'?>" method="post" enctype="multipart/form-data">
                <div class="row card-body ">
                  <div class="form-group col-12">
                    <label >Tên sản phẩm</label>
                    <input type="text" class="form-control" name="ten_san_pham"  placeholder="Nhập tên sản phẩm">
                    <?php  if (isset($_SESSION['error']['ten_san_pham'])){ ?>
                        <p class="text-danger"><?= $_SESSION['error']['ten_san_pham'] ?></p>
                   <?php } ?>
                  </div> 
                  
                  <div class="form-group col-6">
                    <label >Giá sản phẩm</label>
                    <input type="number" class="form-control" name="gia_san_pham"  placeholder="Nhập Giá sản phẩm">
                    <?php  if (isset($_SESSION['error']['gia_san_pham'])){ ?>
                        <p class="text-danger"><?= $_SESSION['error']['gia_san_pham']  ?></p>
                   <?php } ?>
                  </div> 

                  <div class="form-group col-6">
                    <label > Giá khuyến mãi</label>
                    <input type="number" class="form-control" name="gia_khuyen_mai"  placeholder="Nhập  giá khuyến mãi">
                  </div> 

                  <div class="form-group col-6">
                    <label >Hình Ảnh</label>
                    <input type="file" class="form-control" name="hinh_anh" >
                    <?php  if (isset($_SESSION['error']['hinh_anh'])){ ?>
                        <p class="text-danger"><?= $_SESSION['error']['hinh_anh']  ?></p>
                   <?php } ?>
                  </div> 

                  <div class="form-group col-6">
                    <label >Album ảnh </label>
                    <input type="file" class="form-control" name="img_array[]" multiple >
                  </div> 

                  <div class="form-group col-6">
                    <label >Số lượng</label>
                    <input type="number" class="form-control" name="so_luong"  placeholder="Nhập số lượng">
                    <?php  if (isset($_SESSION['error']['so_luong'])){ ?>
                        <p class="text-danger"><?= $_SESSION['error']['so_luong']  ?></p>
                   <?php } ?>
                  </div> 

                  <div class="form-group col-6">
                    <label >Ngày nhập</label>
                    <input type="date" class="form-control" name="ngay_nhap"  placeholder="Nhập Ngày ">
                    <?php  if (isset($_SESSION['error']['ngay_nhap'])){ ?>
                        <p class="text-danger"><?= $_SESSION['error']['ngay_nhap']  ?></p>
                   <?php } ?>
                  </div> 

                  <div class="form-group col-6">
                    <label >Danh mục</label>
                    <select class="form-control" name="danh_muc_id" id="exampleFormControlSelect1">
                      <option selected disabled>Chọn danh  mục sản phẩm </option>
                      <?php foreach ($listDanhMuc as $danhMuc) { ?>
                          <option value="<?= $danhMuc['id'] ?>"><?= $danhMuc['ten_danh_muc'] ?></option>
                        <?php } ?>
                    </select>
                    <?php  if (isset($_SESSION['error']['danh_muc_id'])){ ?>
                        <p class="text-danger"><?= $_SESSION['error']['danh_muc_id']  ?></p>
                   <?php } ?>
                  </div> 

                  <div class="form-group col-6">
                    <label >Trạng thái</label>
                    <select class="form-control" name="trang_thai" id="exampleFormControlSelect1">
                      <option selected disabled>Chọn danh  mục sản phẩm </option>
                        <option value="1">Còn bán</option>
                        <option value="2">Dừng bán</option>
                    </select>
                    <?php  if (isset($_SESSION['error']['trang_thai'])){ ?>
                        <p class="text-danger"><?= $_SESSION['error']['trang_thai']  ?></p>
                   <?php } ?>
                  </div> 

                  <div class="form-group col-12">
                    <label >Mô tả</label>
                    <textarea  name="mo_ta" class="form-control"  placeholder="Nhập mô tả" > </textarea>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer ">
                  <button type="submit" class="btn btn-primary" >Submit</button>
                </div>
              </form>
            </div>
           <!-- /.card -->
         </div>
         <!-- /.col -->
       </div>
       <!-- /.row -->
     </div>
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