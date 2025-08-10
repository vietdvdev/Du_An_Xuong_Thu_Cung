<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>


    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">login-Register</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- login register wrapper start -->
        <div class="login-register-wrapper section-padding">
            <div class="container" style="max-width : 40vw">
                <div class="member-area-from-wrap">
                    <div class="row">
                        <!-- Login Content Start -->
                        <div class="col-lg-12">
                            <div class="login-reg-form-wrap">
                                <h5 class="text-center">Đăng kí tài khoản </h5>
     

                                <form action="<?= BASE_URL . '?act=them-khach-hang'?>" method="post">
                                    <div class="single-input-item">
                                        <label for="email"> <b>Tài khoản</b> </label>
                                        <input type="email" name="email" placeholder="Nhập tài khoản email "  />

                                    <?php  if (isset($_SESSION['error']['email'])){ ?>
                                            <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
                                    <?php } ?>
                                    </div>

                                    <div class="single-input-item">
                                        <label for="ho_ten"><b>Họ và Tên</b> </label>
                                        <input type="text" name="ho_ten" placeholder="Nhập họ và tên"  />
                                    <?php  if (isset($_SESSION['error']['ho_ten'])){ ?>
                                            <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
                                    <?php } ?>                                        
                                    </div>

                                    <div class="single-input-item">
                                        <label for="ngay_sinh"><b> Ngày sinh </b> </label>
                                        <input type="date" name="ngay_sinh" placeholder=" Nhập ngày sinh của bạn "  />
                                    <?php  if (isset($_SESSION['error']['ngay_sinh'])){ ?>
                                            <p class="text-danger"><?= $_SESSION['error']['ngay_sinh'] ?></p>
                                    <?php } ?>                                        
                                    </div>

                                    <div class="single-input-item">
                                        <label for="so_dien_thoai"><b>Số điện thoại</b> </label>
                                        <input type="number" name="so_dien_thoai" placeholder="Nhập số điện thoại "  />
                                    <?php  if (isset($_SESSION['error']['so_dien_thoai'])){ ?>
                                            <p class="text-danger"><?= $_SESSION['error']['so_dien_thoai'] ?></p>
                                    <?php } ?>                                        
                                    </div>

                                    <div class="single-input-item">
                                        <select name="gioi_tinh" class="form-control custom-select">
                                                <option   value="1">Nam</option>
                                                <option  value="2">Nữ</option>

                                        </select>
                                    <?php  if (isset($_SESSION['error']['gioi_tinh'])){ ?>
                                            <p class="text-danger"><?= $_SESSION['error']['gioi_tinh'] ?></p>
                                    <?php } ?>                                        
                                    </div>

                                    <div class="single-input-item">
                                        <label for="dia_chi"><b>Địa chỉ</b> </label>
                                        <input type="text" name="dia_chi" placeholder="dia_chi"  />
                                    <?php  if (isset($_SESSION['error']['dia_chi'])){ ?>
                                            <p class="text-danger"><?= $_SESSION['error']['dia_chi'] ?></p>
                                    <?php } ?>                                        
                                    </div>


                                    <div class="form-group">
                                    <label class="col-md-3 control-label"><b>Nhập mật khẩu:</b></label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" name="new_pass" value="">
                                        <?php  if (isset($_SESSION['error']['new_pass'])){ ?>
                                                <p class="text-danger"><?= $_SESSION['error']['new_pass']  ?></p>
                                            <?php } ?>                                
                                    </div>
                                </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><b>Nhập lại mật khẩu:</b></label>
                                        <div class="col-md-12">
                                            <input class="form-control" type="text" name="confirm_pass" value="">
                                            <?php  if (isset($_SESSION['error']['confirm_pass'])){ ?>
                                                    <p class="text-danger"><?= $_SESSION['error']['confirm_pass']  ?></p>
                                                <?php } ?>
                                        </div>
                                    </div>

                                    <div class="custom-control custom-checkbox mb-20">
                                        <input type="checkbox" class="custom-control-input" id="terms" required />
                                        <label class="custom-control-label" for="terms"> Xác nhận thông tin đăng kí tài khoản </a></label>
                                    </div>

                                    
                                    <div class="single-input-item text-center">
                                        <button class="btn btn-sqr " type="submit">Đăng ký tài khoản </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Login Content End -->

                    </div>
                </div>
            </div>
        </div>
        <!-- login register wrapper end -->
    </main>

<!-- offcanvas mini cart start -->
<!-- offcanvas mini cart end -->


<?php
require_once 'views/layout/footer.php';  ?>