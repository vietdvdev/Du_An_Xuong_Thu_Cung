<?php


class AdminDanhMucController {
    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelDanhMuc = new AdminDanhMuc();
    }

    public function danhSachDanhMuc(){

        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();

        require_once './views/danhmuc/listDanhMuc.php';
    }

    public function formAddDanhMuc(){
        // hiển thị form nhập
        require_once './views/danhmuc/addDanhMuc.php';
    }

    public function postAddDanhMuc(){
        // Sử lý thêm dữ liệu
       // Kiểm tra xem dữ liệu có phải được submit lên không

       if($_SERVER['REQUEST_METHOD']== 'POST'){
            // lấy ra dữ liệu 
            $ten_danh_muc = $_POST['ten_danh_muc'];         
            $mo_ta = $_POST['mo_ta'];
            $loai_dong_vat = $_POST['loai_dong_vat'];

            // tạo mảng chống để chứa dữ liệu
            $errors = [];
            if(empty($ten_danh_muc)){
             $errors['ten_danh_muc'] = 'Tên danh mục không được để chống';
            }
            // không có lỗi tiến hành thêm danh mục

            if(empty($errors)){
                // không có lỗi thêm danh mục
            $this->modelDanhMuc->insertDanhMuc($ten_danh_muc,$mo_ta,$loai_dong_vat);
            header('location: ' . BASE_URL_ADMIN . '?act=danh-muc');
            exit;
            }else{
                // trả về form
                require_once './views/danhmuc/addDanhMuc.php';
            }
       }
    }

        public function formEditDanhMuc(){
        // hiển thị form nhập
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        if($danhMuc){

            require_once './views/danhmuc/editDanhMuc.php';
        }else{
             header('location: ' . BASE_URL_ADMIN . '?act=danh-muc');
        }
    }

    public function postEditDanhMuc(){
        // Sử lý thêm dữ liệu
       // Kiểm tra xem dữ liệu có phải được submit lên không

       if($_SERVER['REQUEST_METHOD']== 'POST'){
            // lấy ra dữ liệu 
            $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            $loai_dong_vat = $_POST['loai_dong_vat'];

            // tạo mảng chống để chứa dữ liệu
            $errors = [];
            if(empty($ten_danh_muc)){
             $errors['ten_danh_muc'] = 'Tên danh mục không được để chống';
            }
            // không có lỗi tiến hành thêm danh mục

            if(empty($errors)){
                // không có lỗi Sửa danh mục
            $this->modelDanhMuc->updateDanhMuc($id,$ten_danh_muc,$mo_ta,$loai_dong_vat);
            header('location: ' . BASE_URL_ADMIN . '?act=danh-muc');
            exit;
            }else{
                // trả về form
                $danhMuc = ['id' => $id , 'ten_danh_muc'=> $ten_danh_muc , 'mo_ta' => $mo_ta];
                require_once './views/danhmuc/editDanhMuc.php';
            }
       }
    }

    public function deleteDanhMuc(){
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);

        if($danhMuc){
             $this->modelDanhMuc->destroyDanhMuc($id);
        }
            header('location: ' . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        
    }

}