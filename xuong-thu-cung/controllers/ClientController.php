<?php

class ClientController
{

    public $modelTaiKhoan;

    public function __construct()
    {

        $this->modelTaiKhoan = new TaiKhoan();
    }


    function  formLogin()
    {
        require_once './views/auth/formLogin.php';
        deleteSessionError();
    }

    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy email và pass gửi lên từ form 
            $email = $_POST['email'];
            $password = $_POST['password'];

            // var_dump($email);
            // var_dump($password);die;
            // sử lý kiểm tra thông tin đăng nhập
            $user  = $this->modelTaiKhoan->checkLogin($email, $password);
            if ($user == $email) {  // trường hợp đăng nhập thành công
                // lưu thông tin vào session
                $_SESSION['user_client'] = $user;
                header('Location:' . BASE_URL);
                exit();
            } else {
                // Lỗi thì lưu lỗi vào session
                $_SESSION['error'] = $user;
                $_SESSION['flash'] = true;

                header('Location:' . BASE_URL . '?act=login');
                exit();
            }
        }
    }

    // đăng xuất tài khoản khách hàng 
    public function logoutKhachHang()
    {
        if (isset($_SESSION['user_client'])) {
            unset($_SESSION['user_client']);
            header('Location:' . BASE_URL);
        }
    }




    // đường dẫn đến form thêm khách hàng 

    public function formAddKhachHang()
    {
        require_once './views/auth/formDangKy.php';
        deleteSessionError();
    }


    public function postAddKhachHang()
    {
        // Sử lý thêm dữ liệu
        // Kiểm tra xem dữ liệu có phải được submit lên không

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu                                                                
            $ho_ten = $_POST['ho_ten'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $email = $_POST['email'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $dia_chi = $_POST['dia_chi'];
            $new_pass = $_POST['new_pass'];
            $confirm_pass = $_POST['confirm_pass'];
            // tạo mảng chống để chứa dữ liệu
            $taiKhoan = $this->modelTaiKhoan->getTaiKhoanFromEmail($email);

            $errors = [];

            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Họ tên  không được để chống';
            }

            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = 'Nhập ngày sinh không ';
            }


            if ($email == $taiKhoan['email']) {
                $errors['email'] = 'Tài khoản đã được đăng kí';
            }

            if (empty($email)) {
                $errors['email'] = 'Email không được để chống';
            }

            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = 'Chọn giới tính. Không được để chống';
            }


            if (empty($dia_chi)) {
                $errors['dia_chi'] = 'Nhập địa chỉ của bạn ';
            }

            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'Số điện thoại không được để chống';
            }

            // kiểm tra mật khẩu trùng khớp
            if ($new_pass !== $confirm_pass) {
                $errors['confirm_pass'] = ' Mật khẩu khẩu nhập lại không chùng khớp';
            }

            if (empty($new_pass)) {
                $errors['new_pass'] = 'Điền trường dữ liệu này ';
            }

            if (empty($confirm_pass)) {
                $errors['confirm_pass'] = 'Điền trường dữ liệu này ';
            }

            $_SESSION['error'] = $errors;
            // var_dump($ho_ten);
            // var_dump($email);die;

            if (empty($errors)) {
                // không có lỗi thêm tài khoản

                // đặt password mặc định - 123@123ab
                // password_verify() dùng để giải mã 
                $password = password_hash($confirm_pass, PASSWORD_BCRYPT);
                // var_dump($password);die;
                // khai báo chức vụ 
                $chuc_vu_id = 2;
                $trang_thai = 1;

                $this->modelTaiKhoan->insertTaiKhoanKhachHang($ho_ten, $ngay_sinh, $email, $so_dien_thoai, $gioi_tinh, $dia_chi, $password, $chuc_vu_id, $trang_thai);

                $_SESSION['success_message'] = "Tài khoản đã được đăng ký thành công!";
                header("Location:" . BASE_URL . '?act=login');
                exit();
            } else {
                // trả về form
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL . '?act=form-dang-ky-khach-hang');
                exit();
            }
        }
    }






    // form sửa thông tin khách hàng

    public function formEditCaNhanKhachHang()
    {
        $email = $_SESSION['user_client'];
        // lấy ra thông tin tài khoản khách hàng 
        $thongTin = $this->modelTaiKhoan->getTaiKhoanFromEmail($email);
        require_once 'views/auth/editCaNhan.php';
        deleteSessionError();
    }



    // sử lý sửa thông tin khách hàng 
    public function postEditMatKhauCaNhanKhachHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $old_pass = $_POST['old_pass'];
            $new_pass = $_POST['new_pass'];
            $confirm_pass = $_POST['confirm_pass'];

            // lấy thông tin user thông qua sesion
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $checkPass = password_verify($old_pass, $user['mat_khau']);
            $errors = [];

            if (!$checkPass) {
                $errors['old_pass'] = ' Mật khẩu người dùng không đúng';
            }

            if ($new_pass !== $confirm_pass) {
                $errors['confirm_pass'] = ' Mật khẩu khẩu nhập lại không chùng khớp';
            }

            if (empty($old_pass)) {
                $errors['old_pass'] = 'Điền trường dữ liệu này ';
            }

            if (empty($new_pass)) {
                $errors['new_pass'] = 'Điền trường dữ liệu này ';
            }

            if (empty($confirm_pass)) {
                $errors['confirm_pass'] = 'Điền trường dữ liệu này ';
            }

            $_SESSION['error'] = $errors;

            if (!$errors) {
                // thực hiện đổi mật khẩu khi không có lỗi 
                $hashPass = password_hash($new_pass, PASSWORD_BCRYPT);
                $status =  $this->modelTaiKhoan->resetPassword($user['id'], $hashPass);
                if ($status) {
                    $_SESSION['success'] = "Đã đổi mật khẩu thành công";
                    header('Location:' . BASE_URL . '?act=form-sua-thong-tin-ca-nhan-khach-hang');
                    $_SESSION['flash'] = true;
                }
            } else {
                // Lỗi thì lưu lỗi vào session

                $_SESSION['flash'] = true;

                header('Location:' . BASE_URL . '?act=form-sua-thong-tin-ca-nhan-khach-hang');
                exit();
            }
        }
    }




    public function postEditCaNhanKhachHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $khach_hang_id = $_POST['khach_hang_id'] ?? '';
            $ho_ten = $_POST['ho_ten'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';

            $errors = [];

            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên người dùng không được để trống';
            }
            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = ' Nhập ngày sinh không được để trống';
            }
            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = 'Vui lòng chọn giới tính';
            }
            if (empty($dia_chi)) {
                $errors['dia_chi'] = 'Địa chỉ không được để trống';
            }

            $_SESSION['errors'] = $errors;

            if (empty($errors)) {
                // Xử lý ảnh đại diện
                $anh_dai_dien_file = $_FILES['anh_dai_dien'] ?? null;
                $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
                $old_avatar = $user['anh_dai_dien'];

                if ($anh_dai_dien_file && $anh_dai_dien_file['error'] == UPLOAD_ERR_OK) {
                    $new_avatar = uploadFile($anh_dai_dien_file, './uploads/');
                    if (!empty($old_avatar)) {
                        deleteFile($old_avatar);
                    }
                } else {
                    $new_avatar = $old_avatar;
                }

                // Cập nhật vào DB
                $this->modelTaiKhoan->updateTaiKhoanCaNhanKhachhang(
                    $khach_hang_id,
                    $ho_ten,
                    $ngay_sinh,
                    $so_dien_thoai,
                    $gioi_tinh,
                    $dia_chi,
                    $new_avatar
                );

                unset($_SESSION['errors']);
                header('Location: ' . BASE_URL . '?act=form-sua-thong-tin-ca-nhan-khach-hang&id=' . $khach_hang_id);
                exit();
            } else {
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL . '?act=form-sua-thong-tin-ca-nhan-khach-hang&id=' . $khach_hang_id);
                exit();
            }
        }
    }
}
