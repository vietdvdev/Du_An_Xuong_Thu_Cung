<?php 

class ClientController
{
  
    public $modelTaiKhoan;

    public function __construct()
    {
    
       $this->modelTaiKhoan = new TaiKhoan();

    }

        function  formLogin(){
             require_once './views/auth/formLogin.php';
             deleteSessionError();
        }

        public function postLogin(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // lấy email và pass gửi lên từ form 
                $email = $_POST['email'];
                $password = $_POST['password'];

                // var_dump($email);
                // var_dump($password);die;
                // sử lý kiểm tra thông tin đăng nhập
                $user  = $this->modelTaiKhoan->checkLogin($email,$password);
                if($user == $email){  // trường hợp đăng nhập thành công
                    // lưu thông tin vào session
                    $_SESSION['user_client'] = $user;
                    header('Location:' . BASE_URL );
                    exit();
                }else{
                    // Lỗi thì lưu lỗi vào session
                    $_SESSION['error'] = $user;
                    $_SESSION['flash'] = true;

                    header('Location:' . BASE_URL .'?act=login');
                    exit();
                }

                


            }
        }

            public function formEditCaNhanKhachHang(){
            $email = $_SESSION['user_client'];
            $thongTin = $this->modelTaiKhoan->getTaiKhoanFromEmail($email);
           
            require_once 'views/auth/editCaNhan.php';
            deleteSessionError();
        }



        

        public function postEditMatKhauCaNhanKhachHang(){
           if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $old_pass = $_POST['old_pass'];
            $new_pass = $_POST['new_pass'];
            $confirm_pass = $_POST['confirm_pass'];
      
            // lấy thông tin user thông qua sesion
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $checkPass = password_verify($old_pass,$user['mat_khau']);
                $errors = [];

                if(!$checkPass){
                $errors['old_pass'] = ' Mật khẩu người dùng không đúng';      
                }

                if($new_pass !== $confirm_pass){
                $errors['confirm_pass'] = ' Mật khẩu khẩu nhập lại không chùng khớp';      
                }

            if(empty($old_pass)){
             $errors['old_pass'] = 'Điền trường dữ liệu này ';
            }

            if(empty($new_pass)){
             $errors['new_pass'] = 'Điền trường dữ liệu này ';
            }    

            if(empty($confirm_pass)){
             $errors['confirm_pass'] = 'Điền trường dữ liệu này ';
            }

            $_SESSION['error'] = $errors;

            if(!$errors){
                // thực hiện đổi mật khẩu khi không có lỗi 
                $hashPass = password_hash($new_pass, PASSWORD_BCRYPT);
                $status =  $this->modelTaiKhoan->resetPassword($user['id'],$hashPass);
                if($status){
                    $_SESSION['success'] = "Đã đổi mật khẩu thành công";
                     header('Location:' . BASE_URL . '?act=form-sua-thong-tin-ca-nhan-khach-hang');
                      $_SESSION['flash'] = true;
                }
                }else{
                    // Lỗi thì lưu lỗi vào session
                  
                    $_SESSION['flash'] = true;

                    header('Location:' . BASE_URL .'?act=form-sua-thong-tin-ca-nhan-khach-hang');
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
                    header('Location: ' . BASE_URL. '?act=form-sua-thong-tin-ca-nhan-khach-hang&id=' . $khach_hang_id);
                    exit();
                } else {
                    $_SESSION['flash'] = true;
                    header('Location: ' . BASE_URL . '?act=form-sua-thong-tin-ca-nhan-khach-hang&id=' . $khach_hang_id);
                    exit();
                }
            }
        }






}