<?php

class AdminTaiKhoanController
{
    public $modelTaiKhoan;
    public $modelDonHang;
    public $modelSanPham;

    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
       $this->modelDonHang = new AdminDonHang();
       $this->modelSanPham = new AdminSanPham();


    }

    public function danhSachQuanTri(){
        $listQuanTri = $this->modelTaiKhoan->getAllTaiKhoan(1);
        
        require_once './views/taikhoan/quantri/listQuantri.php';
    }

    public function formAddQuanTri(){
        require_once './views/taikhoan/quantri/addQuantri.php';
        deleteSessionError();
    }

    public function postAddQuanTri(){
          // Sử lý thêm dữ liệu
       // Kiểm tra xem dữ liệu có phải được submit lên không

       if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // lấy ra dữ liệu 
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];

            // tạo mảng chống để chứa dữ liệu
            $errors = [];
            if(empty($ho_ten)){
             $errors['ho_ten'] = 'Họ tên  không được để chống';
            }

            if(empty($email)){
             $errors['email'] = 'Email không được để chống';
            }
            
            $_SESSION['error'] = $errors;
            // var_dump($ho_ten);
            // var_dump($email);die;
            if(empty($errors)){
                // không có lỗi thêm tài khoản
                // đặt password mặc định - 123@123ab
                //  password_hash()   dùng để mã hóa 
                // password_verify() dùng để giải mã 
                $password = password_hash('123@123ab', PASSWORD_BCRYPT);
                // var_dump($password);die;
                // khai báo chức vụ 
                $chuc_vu_id = 1;

                $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $password, $chuc_vu_id);

            header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
            exit();
            }else{
                // trả về form
               $_SESSION['flash'] = true;
            header('Location: ' . BASE_URL_ADMIN . '?act=form-them-quan-tri');
            exit();
            }
       }
    }

    public function formEditQuanTri(){
        $id_quan_tri = $_GET['id_quan_tri'];
        $quanTri = $this->modelTaiKhoan->getDetailTaiKhoan($id_quan_tri);
        require_once './views/taikhoan/quantri/editQuanTri.php';

        deleteSessionError();
    }

    
      public function postEditQuanTri(){


       if($_SERVER['REQUEST_METHOD']== 'POST'){
            // lấy ra dữ liệu 
            // lấy ra rữ liệu cũ của sản phẩm 
            $quan_tri_id = $_POST['quan_tri_id'] ?? '';


            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
  
            // tạo mảng chống để chứa dữ liệu
            $errors = [];
            if(empty($ho_ten)){
             $errors['ho_ten'] = 'Tên người dùng không được để chống';
            }

            if(empty($email)){
             $errors['email'] = 'Email người dùng không được để chống';
            }

            if(empty($trang_thai)){
             $errors['trang_thai'] = 'Vui lòng chọn trạng thái';
            }


            $_SESSION['errors'] = $errors;
            if(empty($errors)){
                $this->modelTaiKhoan->updateTaiKhoan( $quan_tri_id,
                                                $ho_ten,
                                                $email,
                                                $so_dien_thoai,
                                                $trang_thai,

                                            );

       

            header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
            exit();
            }else{
                // trả về form
                // đặt chỉ thị xóa session sau khi hiển thị form
                $_SESSION['flash'] = true;
             header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-quan-tri&id_quan_tri=' . $quan_tri_id);
            exit();               
            }
       }
    }

        public function resetPassword(){
        $tai_khoan_id = $_GET['id_quan_tri'];
        $tai_khoan = $this->modelTaiKhoan->getDetailTaiKhoan($tai_khoan_id);
                // đặt password mặc định - 123@123ab
                //  password_hash()   dùng để mã hóa 
                // password_verify() dùng để giải mã 
            $password = password_hash('123@123ab', PASSWORD_BCRYPT);
         $status =  $this->modelTaiKhoan->resetPassword($tai_khoan_id, $password);

         if($status && $tai_khoan['chuc_vu_id']==1){
            header('Location:' .  BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
            exit();  
         }elseif($status && $tai_khoan['chuc_vu_id']==2){
            header('Location:' .  BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
            exit();  
            }
         else{
            var_dump(' Lỗi tài khoản ');die;
         }
    }

        public function danhSachKhachhang(){
        $listKhachHang = $this->modelTaiKhoan->getAllTaiKhoan(2);
        
        require_once './views/taikhoan/khachhang/listKhachHang.php';
    }




    public function formEditKhachHang(){
        $id_khach_hang = $_GET['id_khach_hang'];
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
        require_once './views/taikhoan/khachhang/editKhachHang.php';

        deleteSessionError();
    }

    

      public function postEditKhachHang(){


       if($_SERVER['REQUEST_METHOD']== 'POST'){
            // lấy ra dữ liệu 
            // lấy ra rữ liệu cũ của sản phẩm 
            $khach_hang_id = $_POST['khach_hang_id'] ?? '';


            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
  

            // tạo mảng chống để chứa dữ liệu
            $errors = [];
            if(empty($ho_ten)){
             $errors['ho_ten'] = 'Tên người dùng không được để chống';
            }

            if(empty($email)){
             $errors['email'] = 'Email người dùng không được để chống';
            }

            if(empty($gioi_tinh)){
             $errors['gioi_tinh'] = 'chọn giới tính người dùng không được để chống';
            }

            if(empty($dia_chi)){
             $errors['dia_chi'] = 'Địa chỉ người dùng không được để chống';
            }


            if(empty($trang_thai)){
             $errors['trang_thai'] = 'Vui lòng chọn trạng thái';
            }


            $_SESSION['errors'] = $errors;
            if(empty($errors)){
                $this->modelTaiKhoan->updateKhachHang( $khach_hang_id,
                                                $ho_ten,
                                                $email,
                                                $so_dien_thoai,
                                                $ngay_sinh,
                                                $gioi_tinh,
                                                $dia_chi,
                                                $trang_thai,

                                            );

       

            header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
            exit();
            }else{
                // trả về form
                // đặt chỉ thị xóa session sau khi hiển thị form
                $_SESSION['flash'] = true;
             header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-khach-hang&id_khach_hang=' . $khach_hang_id);
            exit();               
            }
       }
    }

    public function detailKhachHang(){
        $id_khach_hang = $_GET['id_khach_hang'];
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);

        $listDonHang = $this->modelDonHang->getDonHangFromKhachHang($id_khach_hang);

        $listBinhLuan = $this->modelSanPham->getBinhLuanFromKhachHang($id_khach_hang);

          require_once './views/taikhoan/khachhang/detailKhachHang.php';
    }


        function  formLogin(){
             require_once './views/auth/formLogin.php';
             deleteSessionError();
        }

        public function login(){
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
                    $_SESSION['user_admin'] = $user;
                    header('Location:' . BASE_URL_ADMIN );
                    exit();
                }else{
                    // Lỗi thì lưu lỗi vào session
                    $_SESSION['error'] = $user;
                    $_SESSION['flash'] = true;

                    header('Location:' . BASE_URL_ADMIN .'?act=login-admin');
                    exit();
                }

                


            }
        }

        
        public function logout(){
            if(isset($_SESSION['user_admin'])){
                unset($_SESSION['user_admin']);
                header('Location:' . BASE_URL_ADMIN . '?act=login-admin');
                
            }
        }

        public function formEditCaNhanQuanTri(){
            $email = $_SESSION['user_admin'];
            $thongTin = $this->modelTaiKhoan->getTaiKhoanFormEmail($email);
            // var_dump($thongTin);die;
            require_once 'views/taikhoan/canhan/editCaNhan.php';
            deleteSessionError();
        }






        public function postEditMatKhauCaNhan(){
           if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $old_pass = $_POST['old_pass'];
            $new_pass = $_POST['new_pass'];
            $confirm_pass = $_POST['confirm_pass'];
      
            // lấy thông tin user thông qua sesion
            $user = $this->modelTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_admin']);
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
                     header('Location:' . BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri');
                      $_SESSION['flash'] = true;
                }
                }else{
                    // Lỗi thì lưu lỗi vào session
                  
                    $_SESSION['flash'] = true;

                    header('Location:' . BASE_URL_ADMIN .'?act=form-sua-thong-tin-ca-nhan-quan-tri');
                    exit();
                }

           }
        }
      



public function postEditCaNhanQuanTri()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $quan_tri_id = $_POST['quan_tri_id'] ?? '';
        $ho_ten = $_POST['ho_ten'] ?? '';
        $email = $_POST['email'] ?? '';
        $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
        $gioi_tinh = $_POST['gioi_tinh'] ?? '';
        $dia_chi = $_POST['dia_chi'] ?? '';

        $errors = [];

        if (empty($ho_ten)) {
            $errors['ho_ten'] = 'Tên người dùng không được để trống';
        }
        if (empty($email)) {
            $errors['email'] = 'Email không được để trống';
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
            $user = $this->modelTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_admin']);
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
            $this->modelTaiKhoan->updateTaiKhoanCaNhanQuanTri(
                $quan_tri_id,
                $ho_ten,
                $email,
                $so_dien_thoai,
                $gioi_tinh,
                $dia_chi,
                $new_avatar
            );

            unset($_SESSION['errors']);
            header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri&id=' . $quan_tri_id);
            exit();
        } else {
            $_SESSION['flash'] = true;
            header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri&id=' . $quan_tri_id);
            exit();
        }
    }
}




}



?>