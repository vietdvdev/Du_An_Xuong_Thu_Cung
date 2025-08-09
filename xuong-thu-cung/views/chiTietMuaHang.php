<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>





    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#">shop</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Bill detail</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- cart main wrapper start -->
        <div class="cart-main-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-7">
                            <!--  thông tin sản phẩm đơn hàng -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    
                                    <thead >                                       
                                        <th colspan='5'>Thông tin sản phẩm</th>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center"> 
                                            <th>Hình ảnh </th>
                                            <th>Tên sản phẩm </th>
                                            <th>Đơn giá  </th>
                                            <th>Số lượng</th>
                                            <th>thành tiền</th>
                  
                                        </tr>
                                    <?php foreach($chiTietDonHang as $item) :  ?>
                                        <tr > 
                                           
                                            <td class="pro-thumbnail">
                                                 <img class="img-fluid" src="<?= BASE_URL . $item['hinh_anh'] ?>" alt="Product" width="100px" /> 
                                            </td>
                                            <td><?=  $item['ten_san_pham']  ?></td>
                                            <td><?= formatPrice($item['don_gia'])  ?> đ</td>
                                            <td><?=  $item['so_luong']  ?></td>
                                            <td><?=  formatEmail($item['thanh_tien'] ) ?> đ</td>
                                            
                           
                                        </tr>

                                    <?php  endforeach; ?>
                                    </tbody>
                             
                                </table>
                            </div>
                  
                        </div>

                            <div class="col-lg-5">
                            <!-- Thông tin mua hàng -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">                                   
                                    <thead>                                       
                                         <th colspan='2'>Thông tin sản phẩm</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <td><?= $donHang['ma_don_hang'] ?></td>
                                        </tr>

                                         <tr>
                                            <th>Tên người nhận</th>
                                            <td><?= $donHang['ten_nguoi_nhan'] ?></td>
                                        </tr>                                   


                                        <tr>
                                            <th>Email</th>
                                            <td><?= $donHang['email_nguoi_nhan'] ?></td>
                                        </tr>



                                        <tr>
                                            <th>Số điện thoại</th>
                                            <td><?= $donHang['sdt_nguoi_nhan'] ?></td>
                                        </tr>

                                        <tr>
                                            <th>Địa chỉ</th>
                                            <td><?= $donHang['dia_chi_nguoi_nhan'] ?></td>
                                        </tr>

                                        <tr>
                                            <th>Ngày đặt</th>
                                            <td><?= $donHang['ngay_dat'] ?></td>
                                        </tr>


                                        <tr>
                                            <th>Ghi chú đơn hàng</th>
                                            <td><?= $donHang['ghi_chu'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tổng tiền</th>
                                            <td><?= formatPrice($donHang['tong_tien']) ?></td>
                                        </tr>


                                        <tr>
                                            <th>Phương thức thanh toán</th>
                                            <td><?= $phuongThucThanhToan[$donHang['phuong_thuc_thanh_toan_id'] ]  ?></td>
                                        </tr>

                                        <tr>
                                            <th>Trạng thái </th>
                                            <td><?= $trangThaiDonHang[ $donHang['trang_thai_id'] ] ?></td>
                                        </tr>





                                    </tbody>
                             
                                </table>
                            </div>
                  
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- cart main wrapper end -->
    </main>


    

<?php require_once 'layout/minicart.php';  ?>

<?php require_once 'layout/footer.php';  ?>