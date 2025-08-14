<?php

class HomeController
{

    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDonHang;
    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();
    }




    public function home()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        // loại o là động vật thường 
        // loại 1 là động vật quý hiếm         
        $LoaiPhoBien = 0;
        $LoaiQuy = 1;
        $listSanPhamLoaiPhoBien = $this->modelSanPham->getListSanPhamCungLoai($LoaiPhoBien);
        $listSanPhamLoaiQuy = $this->modelSanPham->getListSanPhamCungLoai($LoaiQuy);


        // var_dump($listSanPhamCungLoai);die;

        require_once './views/home.php';
    }



    public function chiTietSanPham()
    {

        $id = $_GET['id_san_pham'];

        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        $trang_thai = 1;

        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id, $trang_thai);


        $listSanPhamCungDanhMuc  = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['danh_muc_id']);


        if ($sanPham) {

            require_once './views/detailSanPham.php';
            deleteSessionError();
        } else {
            header('location:'  . BASE_URL);
            exit();
        }
    }


    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_client'])) {

                $email = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

                // lấy dữ liệu giỏ hàng của người dùng
                $gioHang = $this->modelGioHang->getGioHangFromUser($email['id']);
                if (!$gioHang) {
                    $gioHangId =  $this->modelGioHang->addGioHang($email['id']);
                    $gioHang = ['id' => $gioHangId];
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                } else {
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                }



                $san_pham_id = $_POST['san_pham_id'];
                $so_luong = $_POST['so_luong'];
                $checkSanPham = false;
                foreach ($chiTietGioHang as $detail) {
                    if ($detail['san_pham_id'] == $san_pham_id) {
                        $newSoLuong = $detail['so_luong'] + $so_luong;
                        $this->modelGioHang->updateSoLuong($gioHang['id'], $san_pham_id, $newSoLuong);
                        $checkSanPham = true;
                        break;
                    }
                }

                if (!$checkSanPham) {
                    $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
                }
                header('Location:' . BASE_URL . '?act=gio-hang');
            } else {
              // nếu chưa đăng nhập
                echo "<script>
                        if (confirm('Bạn chưa đăng nhập. Bạn cần đăng nhập để sử dụng chức năng này.')) {
                            window.location.href = '" . BASE_URL . "?act=login'; // Điều hướng đến trang đăng nhập
                        } else {
                            window.location.href = '" . BASE_URL . "'; // Quay lại trang home
                        }
                    </script>";
                exit; // Dừng lại để không thực hiện tiếp các hành động

            }
        }
    }





    public function gioHang()
    {
        if (isset($_SESSION['user_client'])) {

            $email = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $gioHang = $this->modelGioHang->getGioHangFromUser($email['id']);

            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($email['id']);
                $gioHang = ['id' => $gioHangId];
            }

            $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

            require './views/giohang.php';
        } else {

              // nếu chưa đăng nhập
                echo "<script>
                        if (confirm('Bạn chưa đăng nhập. Bạn cần đăng nhập để sử dụng chức năng này.')) {
                            window.location.href = '" . BASE_URL . "?act=login'; // Điều hướng đến trang đăng nhập
                        } else {
                            window.location.href = '" . BASE_URL . "'; // Quay lại trang home
                        }
                    </script>";
                exit; // Dừng lại để không thực hiện tiếp các hành động
        }
    }



    public function thanhToan()
    {

        if (isset($_SESSION['user_client'])) {

            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);


            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);

            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($user['id']);
                $gioHang = ['id' => $gioHangId];
            }

            $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

            require_once './views/thanhToan.php';
        } else {
              // nếu chưa đăng nhập
                echo "<script>
                        if (confirm('Bạn chưa đăng nhập. Bạn cần đăng nhập để sử dụng chức năng này.')) {
                            window.location.href = '" . BASE_URL . "?act=login'; // Điều hướng đến trang đăng nhập
                        } else {
                            window.location.href = '" . BASE_URL . "'; // Quay lại trang home
                        }
                    </script>";
                exit; // Dừng lại để không thực hiện tiếp các hành động
        }
    }

    public function postThanhToan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];
            $ngay_dat =  date('Y-m-d');
            $trang_thai_id = 1;
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];
            $ma_don_hang = 'DH-' . rand(1000, 9999);
            // thêm thông tin vào DB
            $donHang = $this->modelDonHang->addDonHang(
                $tai_khoan_id,
                $ten_nguoi_nhan,
                $email_nguoi_nhan,
                $sdt_nguoi_nhan,
                $dia_chi_nguoi_nhan,
                $ghi_chu,
                $tong_tien,
                $phuong_thuc_thanh_toan_id,
                $ngay_dat,
                $ma_don_hang,
                $trang_thai_id
            );
            // Lấy thông tin giỏ hàng của người dùng
            $gioHang = $this->modelGioHang->getGioHangFromUser($tai_khoan_id);
            // Lưu sản phẩm vào chi tiết đơn hàng 
            if ($donHang) {
                // Lấy ra toàn bộ sản phẩm trong giỏ hàng 
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);


                // Thêm từng sản phẩm từ giỏ hàng vào bảng chi tiết đơn hàng
                foreach ($chiTietGioHang as $item) {
                    $donGia = $item['gia_khuyen_mai'] ?? $item['gia_san_pham']; // ưu tiên lấy giá khuyến mãi

                    $this->modelDonHang->addChiTietDonHang(
                        $donHang,  // id đơn hàng vừa tạo
                        $item['san_pham_id'], // id sp
                        $donGia,    // đơn giá sp
                        $item['so_luong'], // số lượng sp
                        $donGia *  $item['so_luong'] // thành tiền
                    );
                }

                // sau khi thêm tiến hành xóa sản phẩm trong giỏ hàng 
                // xóa toàn bộ sản phẩm trong chi tiết giỏ hàng
                $this->modelGioHang->clearDetailGioHang($gioHang['id']);
                // xóa thông tin giỏ hàng của người dùng

                $this->modelGioHang->clearGioHang($tai_khoan_id);

                $_SESSION['flash_message'] = 'Đặt hàng thành công!';
                // chuyển hướng lịch sử mua hàng
                header('Location:' . BASE_URL . '?act=lich-su-mua-hang');
                exit();
            } else {
                echo "<script>
                        if (confirm('Đặt hàng thất bại vui lòng đặt lại')) {
                            window.location.href = '" . BASE_URL . "?act=thanh-toan'; // Điều hướng đến trang thanh toán
                        } else {
                            window.location.href = '" . BASE_URL . "'; // Quay lại trang home
                        }
                    </script>";
                exit; // Dừng lại để không thực hiện tiếp các hành động
            }
        }
    }

    public function lichSuMuaHang()
    {

        if (isset($_SESSION['user_client'])) {
            // lấy ra thông tin tài khoản đăng nhập 
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            // lấy ra danh sách trạng thái đơn hàng
            $arrTrangThaiDonHang = $this->modelDonHang->getTrangThaiDonHang();
            $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id');
            // lấy ra danh sách trạng thái thanh toán


            $arrPhuongThucThanhToan = $this->modelDonHang->getPhuongThucThanhToan();
            $phuongThucThanhToan = array_column($arrPhuongThucThanhToan, 'ten_phuong_thuc', 'id');


            $donHangs = $this->modelDonHang->getDonHangFromUser($tai_khoan_id);

            require_once './views/lichSuMuaHang.php';
        } else {
              // nếu chưa đăng nhập
                echo "<script>
                        if (confirm('Bạn chưa đăng nhập. Bạn cần đăng nhập để sử dụng chức năng này.')) {
                            window.location.href = '" . BASE_URL . "?act=login'; // Điều hướng đến trang đăng nhập
                        } else {
                            window.location.href = '" . BASE_URL . "'; // Quay lại trang home
                        }
                    </script>";
                exit; // Dừng lại để không thực hiện tiếp các hành động
        }
    }



    public function chiTietMuaHang()
    {
        if (isset($_SESSION['user_client'])) {
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            // lấy id đơn hàng truyền từ URL
            $donHangId = $_GET['id'];

            // lấy ra danh sách trạng thái đơn hàng
            $arrTrangThaiDonHang = $this->modelDonHang->getTrangThaiDonHang();
            $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id');
            // lấy ra danh sách trạng thái thanh toán


            $arrPhuongThucThanhToan = $this->modelDonHang->getPhuongThucThanhToan();
            $phuongThucThanhToan = array_column($arrPhuongThucThanhToan, 'ten_phuong_thuc', 'id');

            // lấy ra thông thi đơn hàng theo id
            $donHang = $this->modelDonHang->getDonHangById($donHangId);
            // lấy thông tin sản phẩm của đơn hàng trong bảng chi tiết đơn hàng
            $chiTietDonHang = $this->modelDonHang->getChiTietDonHangByDonHangId($donHangId);


            if ($donHang['tai_khoan_id'] != $tai_khoan_id) {
                echo "Bạn không có quyền truy cập đơn hàng này";
                exit();
            }

            require_once './views/chiTietMuaHang.php';
        } else {
              // nếu chưa đăng nhập
                echo "<script>
                        if (confirm('Bạn chưa đăng nhập. Bạn cần đăng nhập để sử dụng chức năng này.')) {
                            window.location.href = '" . BASE_URL . "?act=login'; // Điều hướng đến trang đăng nhập
                        } else {
                            window.location.href = '" . BASE_URL . "'; // Quay lại trang home
                        }
                    </script>";
                exit; // Dừng lại để không thực hiện tiếp các hành động
        }
    }



    public function huyDonHang()
    {
        if (isset($_SESSION['user_client'])) {
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            // lấy id đơn hàng truyền từ URL
            $donHangId = $_GET['id'];

            // kiểm tra đơn hàng
            $donHang = $this->modelDonHang->getDonHangById($donHangId);

            if ($donHang['tai_khoan_id'] != $tai_khoan_id) {
                echo "Bạn không có quyền hủy đơn hàng này";
                exit();
            }

            if ($donHang['trang_thai_id'] != 1) {
                // chỉ đơn hàng ở trạng thái chưa xác nhận mới có thể hủy              
                exit();
            }

            $this->modelDonHang->updateTrangThaiDonHang($donHangId, 11);

            header('Location:' . BASE_URL . '?act=lich-su-mua-hang');
        } else {
              // nếu chưa đăng nhập
                echo "<script>
                        if (confirm('Bạn chưa đăng nhập. Bạn cần đăng nhập để sử dụng chức năng này.')) {
                            window.location.href = '" . BASE_URL . "?act=login'; // Điều hướng đến trang đăng nhập
                        } else {
                            window.location.href = '" . BASE_URL . "'; // Quay lại trang home
                        }
                    </script>";
                exit; // Dừng lại để không thực hiện tiếp các hành động
        }
    }



    public function DeleteSanPhamGioHang()
    {
        if (isset($_SESSION['user_client'])) {
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            // lấy id sản phẩm hàng truyền từ URL
            $sanPhamId = $_GET['san_pham_id'];

            $sanPham = $this->modelGioHang->getSanPhamGioHangId($sanPhamId);

            // kiểm tra Sản phẩm có thuộc giỏ hàng hay không
            if ($sanPham['gio_hang_id'] != $tai_khoan_id) {
                echo "Bạn không có quyền xóa sản phẩm này khỏi giỏ hàng";
                exit();
            }
            // thực hiện xóa sản phẩm khỏi giỏ hàng
            $this->modelGioHang->deleteChiTietSanPham($sanPhamId);

            header('Location: ' . BASE_URL . '?act=gio-hang');
        } else {
              // nếu chưa đăng nhập
                echo "<script>
                        if (confirm('Bạn chưa đăng nhập. Bạn cần đăng nhập để sử dụng chức năng này.')) {
                            window.location.href = '" . BASE_URL . "?act=login'; // Điều hướng đến trang đăng nhập
                        } else {
                            window.location.href = '" . BASE_URL . "'; // Quay lại trang home
                        }
                    </script>";
                exit; // Dừng lại để không thực hiện tiếp các hành động
        }
    }




    public function postBinhLuanSanPham()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_client'])) {
                $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
                $tai_khoan_id = $user['id'];
                $san_pham_id = $_POST['san_pham_id'];
                $noi_dung = $_POST['noi_dung'];
                $ngay_dang = date("Y-m-d");
                $trang_thai = 1;
                $binhLuan =    $this->modelSanPham->addBinhLuanSanPham($tai_khoan_id, $san_pham_id, $noi_dung, $ngay_dang, $trang_thai);

                header('Location:' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id);
            } else {
              // nếu chưa đăng nhập
                echo "<script>
                        if (confirm('Bạn chưa đăng nhập. Bạn cần đăng nhập để sử dụng chức năng này.')) {
                            window.location.href = '" . BASE_URL . "?act=login'; // Điều hướng đến trang đăng nhập
                        } else {
                            window.location.href = '" . BASE_URL . "'; // Quay lại trang home
                        }
                    </script>";
                exit; // Dừng lại để không thực hiện tiếp các hành động
            }
        }
    }


    
}
