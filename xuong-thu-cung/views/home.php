<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>

<main>
    <!-- hero slider area start -->
    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slider1.png">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
            <!-- hero slider area start -->

            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slider2.png">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
            <!-- hero slider area start -->

            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slider3.png">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
            <!-- hero slider area start -->

        </div>
    </section>
    <!-- hero slider area end -->


    <!-- service policy area start -->
    <div class="service-policy section-padding">
        <div class="container">
            <div class="row mtn-30">
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-plane"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Giao hàng</h6>
                            <p>Miễn phí giao hàng</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-help2"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Hỗ trợ 24/7</h6>
                            <p>Hỗ trợ 24/7</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-back"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Hoàn tiền </h6>
                            <p>Hoàn tiền trong 30 ngày khi lỗi</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-credit"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Thanh toán </h6>
                            <p>Bảo mật thanh toán</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service policy area end -->

    <!-- banner statistics area start -->
    <div class="banner-statistics-area">
        <div class="container">
            <div class="row row-20 mtn-20">
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="#">
                            <img src="assets/img/slider/slider2.png" alt="product banner">
                        </a>
                    </figure>
                </div>
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="#">
                            <img src="assets/img/slider/slider3.png" alt="product banner">
                        </a>
                    </figure>
                </div>


            </div>
        </div>
    </div>
    <!-- banner statistics area end -->

    <!-- product area start -->
    <section class="product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm của chúng tôi</h2>
                        <p class="sub-title">Sản phâm được cập nhật liên tục </p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-container">
                        <!-- product tab menu start -->
                        <!-- product tab menu end -->

                        <!-- product tab content start -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    <!-- product item start -->
                                    <?php foreach ($listSanPham as $key => $sanPham): ?>

                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>" style="display:block;width:100%; max-width:300px;height:300px">
                                                <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh']  ?>" alt="product" style="width:100%;height:100%">
                                                <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh']  ?>" alt="product" style="width: 100%;height:100%">
                                                </a>
                                                <div class="product-badge">
                                                    <?php
                                                    $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                                    $ngayHienTai = new DateTime();
                                                    $tinhNgay = $ngayHienTai->diff($ngayNhap);
                                                    if ($tinhNgay->days  <= 7) {
                                                    ?>
                                                        <div class="product-label new">
                                                            <span>Mới</span>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if ($sanPham['gia_khuyen_mai']) {  ?>
                                                        <div class="product-label discount">
                                                            <span>Giảm giá</span>
                                                        </div>
                                                    <?php    }   ?>
                                                </div>

                                                <div class="cart-hover">
                                                    <button class="btn btn-cart">Xem chi tiết</button>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">

                                                <h6 class="product-name">
                                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                                </h6>
                                                <div class="price-box">
                                                    <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) . ' VNĐ';  ?></span>
                                                        <span class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) . ' VNĐ';  ?></del></span>
                                                    <?php    } else { ?>
                                                        <span class="price-regular"><?= formatPrice($sanPham['gia_san_pham']) . ' VNĐ';  ?></span>
                                                    <?php  } ?>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>

                        </div>
                        <!-- product tab content end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product area end -->

    <!-- featured product area start -->

    <section class="feature-product section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm phổ biến</h2>
                        <p class="sub-title">Cập nhập sản phẩm hàng ngày</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4_2 slick-row-10 slick-arrow-style">
                        <!-- product item start -->
                        <?php foreach ($listSanPhamLoaiPhoBien as $key => $sanPham): ?>
                            <div class="product-item">
                                <figure class="product-thumb">
                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>" style="display: block; width: 100%; max-width: 300px; height: 300px;">
                                <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh']  ?>" alt="product" style="width: 100%; height: 100%">
                                <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh']  ?>" alt="product" style="display: width: 100%; height: 100%">
                                </a>
                                    <div class="product-badge">
                                        <?php
                                        $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                        $ngayHienTai = new DateTime();
                                        $tinhNgay = $ngayHienTai->diff($ngayNhap);
                                        if ($tinhNgay->days  <= 7) {
                                        ?>
                                            <div class="product-label new">
                                                <span>Mới</span>
                                            </div>
                                        <?php } ?>

                                        <div class="cart-hover">
                                            <button class="btn btn-cart">Thêm vào giỏ hàng </button>
                                        </div>
                                </figure>
                                <div class="product-caption text-center">

                                    <h6 class="product-name">
                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">Giá sản phẩm</a>
                                    </h6>

                                    <div class="price-box">
                                        <span class="price-regular"><?= $sanPham['gia_san_pham']  ?></span>
                                        <span class="price-old"><del><?= $sanPham['gia_khuyen_mai'] ?></del></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                        <!-- product item end -->

                        <!-- product item end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- featured product area end -->

    <!-- testimonial area start -->
    <section class="testimonial-area section-padding bg-img" data-bg="assets/img/testimonial/testimonials-bg1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Shop uy tín tạo nên thương hiệu</h2>
                        <p class="sub-title">Người nổi tiếng họ nói gì ?</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-thumb-wrapper">
                        <div class="testimonial-thumb-carousel">
                            <div class="testimonial-thumb">
                                <img src="assets/img/testimonial/testimonial-11.png" alt="testimonial-thumb">
                            </div>
                            <div class="testimonial-thumb">
                                <img src="assets/img/testimonial/testimonial-21.png" alt="testimonial-thumb">
                            </div>
                            <div class="testimonial-thumb">
                                <img src="assets/img/testimonial/testimonial-31.png" alt="testimonial-thumb">
                            </div>
                            <div class="testimonial-thumb">
                                <img src="assets/img/testimonial/testimonial-41.png" alt="testimonial-thumb">
                            </div>
                            <div class="testimonial-thumb">
                                <img src="assets/img/testimonial/testimonial-51.png" alt="testimonial-thumb">
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-content-wrapper">
                        <div class="testimonial-content-carousel">
                            <div class="testimonial-content">
                                <p>Mình rất hài lòng khi mua một chú Hổ SeRiCan tại Vietdv.
                                    Mèo khỏe mạnh, lông đẹp với vằn sọc đặc trưng. Shop có đầy đủ giấy tờ và sổ tiêm chủng rõ ràng,
                                    rất uy tín. Giá hợp lý, dịch vụ tận tình. Rất đáng tin cậy!</p>
                                <h5 class="testimonial-author"> Monkey D. Luffy </h5>
                            </div>
                            <div class="testimonial-content">
                                <p>Mình rất hài lòng khi mua mèo tại shop Vietdv. Mèo khỏe mạnh,
                                    đáng yêu, được chăm sóc tốt. Shop uy tín, tư vấn nhiệt tình,
                                    giá cả hợp lý. Sẽ tiếp tục ủng hộ!</p>
                                <h5 class="testimonial-author">NaMi</h5>
                            </div>
                            <div class="testimonial-content">
                                <p>Mình đã mua thú cưng nhiều lần tại shop Vietdv và luôn rất hài lòng.
                                    Các bé thú cưng đều khỏe mạnh, được chăm sóc kỹ lưỡng và có đầy đủ giấy tờ rõ ràng.
                                    Shop rất uy tín, tư vấn tận tâm và giá cả hợp lý. Mỗi lần mua hàng đều mang lại trải nghiệm tốt,
                                    mình hoàn toàn yên tâm khi chọn Vietdv!</p>

                                <h5 class="testimonial-author">Nico Robin</h5>
                            </div>
                            <div class="testimonial-content">
                                <p>Mình đã mua thú cưng nhiều lần tại shop Vietdv và rất hài lòng về chất lượng dịch vụ.
                                    Shop tư vấn rất nhiệt tình, hướng dẫn chăm sóc chi tiết giúp mình dễ dàng nuôi dưỡng thú cưng. Giao hàng nhanh chóng, đóng gói cẩn thận, đảm bảo thú cưng luôn khỏe mạnh khi nhận. Đây là địa chỉ uy tín mà mình tin tưởng lựa chọn nhiều lần!</p>

                                <h5 class="testimonial-author">Roronoa Zoro</h5>
                            </div>
                            <div class="testimonial-content">
                                <p>Mình đã mua thú cưng nhiều lần tại shop Vietdv và rất hài lòng về chất lượng dịch vụ.
                                    Shop tư vấn rất nhiệt tình, hướng dẫn chăm sóc chi tiết giúp mình dễ dàng nuôi dưỡng thú cưng. Giao hàng nhanh chóng, đóng gói cẩn thận, đảm bảo thú cưng luôn khỏe mạnh khi nhận. Đây là địa chỉ uy tín mà mình tin tưởng lựa chọn nhiều lần!</p>

                                <h5 class="testimonial-author"> Trafalgar D. Water Law </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br> <br>
    <!-- latest blog area start -->
    <section class="latest-blog-area section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Thú cưng quý lạ</h2>
                        <p class="sub-title">Số lượng có hạn sản phẩm được quyền cấp phép đầy đủ tại shops</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="blog-carousel-active slick-row-10 slick-arrow-style">
                        <!-- blog post item start -->
                        <?php foreach ($listSanPhamLoaiQuy as $key => $sanPham): ?>
                            <div class="blog-post-item">
                                <figure class="blog-thumb">
                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                <img src="<?= BASE_URL . $sanPham['hinh_anh']  ?>" alt="blog image" 
                                    style="width: 357px; height: 225px; object-fit: cover;">
                                </a>
                                </figure>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <p><?= $sanPham['ngay_nhap']   ?>| <a href="<?= BASE_URL ?>">Shop Vietdv</a></p>
                                    </div>
                                    <div class="blog-meta">
                                        <p>Số lượng: . <?= $sanPham['so_luong'] ?></p>
                                    </div>
                                    <h5 class="blog-title">
                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?> "><?= $sanPham['mo_ta']  ?></a>
                                    </h5>
                                </div>
                            </div>
                        <?php endforeach ?>
                        <!-- blog post item end -->

                        <!-- blog post item end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- latest blog area end -->


    <!-- brand logo area end -->
</main>




<?php require_once 'layout/minicart.php';  ?>

<?php require_once 'layout/footer.php';  ?>