
    <header class="header-area header-wide">
        <!-- main header start -->
        <div class="main-header d-none d-lg-block">
            <!-- header middle area start -->
            <div class="header-main-area sticky">
                <div class="container">
                    <div class="row align-items-center position-relative">

                        <!-- start logo area -->
                        <div class="col-lg-2">
                            <div class="logo">
                                <a href="<?= BASE_URL ?>">
                                    <!-- assets/img/slider/slider2.png -->

                                    <img src="assets/img/logo/logo1.png" alt="Brand Logo">  
                                </a>
                            </div>
                        </div>
                        <!-- start logo area -->

                        
                        <!-- main menu area start -->
                        <div class="col-lg-6 position-static">
                            <div class="main-menu-area">
                                <div class="main-menu">

                                    <!-- main menu navbar start -->
                                    <nav class="desktop-menu">
                                        <ul>
                                            <li ><a href="<?= BASE_URL ?>">Trang chủ</a> 
                                        
                                        </li>

                                            <li><a href="#">Sản phẩm <i class="fa fa-angle-down"></i></a>
                                                <ul class="dropdown">
                                                    <li><a href="blog-left-sidebar.html">blog left sidebar</a></li>
    
                                                </ul>
                                            </li>
                                            <li><a href="#">Giới thiệu</a></li>
                                            <li><a href="#">Liên hệ</a></li>
                                        </ul>
                                    </nav>
                                    <!-- main menu navbar end -->
                                </div>
                            </div>
                        </div>
                        <!-- main menu area end -->

                        <!-- mini cart area start -->
                        <div class="col-lg-4">

                            <div class="header-right d-flex align-items-center justify-content-xl-between justify-content-lg-end">
                                <div class="header-search-container">
                                    <button class="search-trigger d-xl-none d-lg-block"><i class="pe-7s-search"></i></button>
                                    <form class="header-search-box d-lg-none d-xl-block">
                                        <input type="text" placeholder="Nhập tên sản phẩm " class="header-search-field">
                                        <button class="header-search-btn"><i class="pe-7s-search"></i></button>
                                    </form>
                                </div>
                                <div class="header-configure-area">
                                    <?php if(isset($_SESSION['user_client'])){
                                            echo 'Tài khoản: ' . formatEmail($_SESSION['user_client']) ;
                                         } ?>
                                         <hr>
                                    <ul class="nav justify-content-end">
                                        <label for="">
                                         <?php if(isset($_SESSION['user_client'])){
                                            echo  'Đã đăng nhập';
                                         }else{
                                          echo  'Chưa đang nhập';
                                         }  ?>
                                        </label>
                                        <li class="user-hover">
                                            <a href="#">
                                                <i class="pe-7s-user"></i>
                                            </a>

                                            <ul class="dropdown-list">
                                            <?php if(!isset($_SESSION['user_client'])){  ?>
                                            <li><a href="<?= BASE_URL . '?act=login' ?>">Đăng Nhập</a></li>
                                            <li><a href="<?= BASE_URL . '?act=login' ?>">Đăng kí</a></li>
                                          <?php     }else{ ?>
                                              
                                              <li><a href="<?= BASE_URL . '?act=form-sua-thong-tin-ca-nhan-khach-hang'  ?>">Tài khoản</a></li>
                                              <li><a href="<?= BASE_URL . '?act=lich-su-mua-hang' ?>">Đơn hàng</a></li>
                                        <?php   } ?>
                                                                                         
                                            </ul>
                                        </li>
                              
                                        <li>
                                            <a href="#" class="minicart-btn">
                                                <i class="pe-7s-shopbag"></i>
                                                <div class="notification">2</div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- mini cart area end -->

                    </div>
                </div>
            </div>
            <!-- header middle area end -->
        </div>
        <!-- main header start -->


    </header>
    <!-- end Header Area -->

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
