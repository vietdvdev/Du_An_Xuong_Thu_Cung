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
                            <?php
                                    if (isset($_SESSION['success_message'])) {
                                        echo '<div class="alert-success">' . $_SESSION['success_message'] . '</div>';
                                        unset($_SESSION['success_message']); // Xóa sau khi hiển thị 1 lần
                                    } ?>
                            <div class="login-reg-form-wrap">
                                <h5 class="text-center">Đăng nhập</h5>
                                    <?php if (isset($_SESSION['error'])) { ?>
                                            <p class="text-danger login-box-msg text-center"><?= $_SESSION['error']?></p>
                                             <?php  unset($_SESSION['error']) ?>
                                        <?php } else { ?>
                                            <p class="login-box-msg">Vui lòng đăng nhập</p>
                                    <?php } ?>

                                <form action="<?=  BASE_URL . '?act=check-login' ?>" method="post">
                                    <div class="single-input-item">
                                        <label for="email"> <b>Tài khoản</b> </label>
                                        <input type="text" name="email" placeholder="Nhập tài khoản email " required />
                                    </div>
                                    <div class="single-input-item">
                                        <label for="password"><b>Nhập mật khẩu</b> </label>
                                        <input type="text" name="password" placeholder=" password" required />
                                    </div>
                                    <div class="single-input-item">
                                        <div class="login-reg-form-meta d-flex align-items-center justify-content-between">

                                            <a href="#" class="forget-pwd">Quên mật khẩu</a>
                                        </div>
                                    </div>
                                    <div class="single-input-item text-center">
                                        <button class="btn btn-sqr " type="submit">Đăng nhập</button>
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