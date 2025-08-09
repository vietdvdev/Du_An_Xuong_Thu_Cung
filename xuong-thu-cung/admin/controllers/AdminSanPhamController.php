<?php


class AdminSanPhamController
{
    public $modelSanPham;
    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelSanPham = new AdminSanPham();
        $this->modelDanhMuc = new AdminDanhMuc();
    }

    public function danhSachSanPham()
    {

        $listSanPham = $this->modelSanPham->getAllSanPham();

        require_once './views/sanpham/listSanPham.php';
    }

    public function formAddSanPham()
    {
        // hiển thị form nhập
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/sanpham/addSanPham.php';

        // xóa session sau khi load trang

        deleteSessionError();
    }

    public function postAddSanPham()
    {
        // Sử lý thêm dữ liệu
        // Kiểm tra xem dữ liệu có phải được submit lên không

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu 
            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $trang_thai = $_POST['trang_thai'];
            $mo_ta = $_POST['mo_ta'] ?? '';

            $hinh_anh = $_FILES['hinh_anh'] ?? null;


            // lưu hình vào 
            $file_thumb = uploadFile($hinh_anh, './uploads/');

            $img_array = $_FILES['img_array'];
            // tạo mảng chống để chứa dữ liệu
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để chống';
            }

            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = 'Giá sản phẩm không được để chống';
            }

            if (empty($so_luong)) {
                $errors['so_luong'] = 'Số lượng sản phẩm không được để chống';
            }

            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'Ngày nhập sản phẩm không được để chống';
            }

            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'Chọn danh mục sản phẩm không được để chống';
            }

            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái sản phẩm không được để chống';
            }


            if ($hinh_anh['error'] !== 0) {
                $errors['hinh_anh'] = 'Phải chọn ảnh sản phẩm ';
            }

            $_SESSION['error'] = $errors;
            // không có lỗi tiến hành thêm sản phẩm 

            if (empty($errors)) {
                // không có lỗi thêm danh mục
                $san_pham_id = $this->modelSanPham->insertSanPham(
                    $ten_san_pham,
                    $gia_san_pham,
                    $gia_khuyen_mai,
                    $so_luong,
                    $ngay_nhap,
                    $danh_muc_id,
                    $trang_thai,
                    $mo_ta,
                    $file_thumb
                );


                // su lý thêm album ảnh sản phẩm img_array
                if (!empty($img_array['name'])) {
                    foreach ($img_array['name'] as $key => $value) {
                        $file = [
                            'name' => $img_array['name'][$key],
                            'type' => $img_array['type'][$key],
                            'tmp_name' => $img_array['tmp_name'][$key],
                            'orror' => $img_array['orror'][$key],
                            'size' => $img_array['size'][$key],

                        ];

                        $link_hinh_anh = uploadFile($file, './uploads/');
                        $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh);
                    }
                }


                header('location: ' . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else {
                // trả về form
                // đặt chỉ thị xóa session sau khi hiển thị form
                $_SESSION['flash'] = true;
                header('location: ' . BASE_URL_ADMIN . '?act=form-them-san-pham');
                exit();
            }
        }
    }

    public function formEditSanPham()
    {
        // hiển thị form nhập
        // hiển thị thông tin của sản phẩm cần sửa 

        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        if ($sanPham) {

            require_once './views/sanpham/editSanPham.php';
            deleteSessionError();
        } else {
            header('location: ' . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
    }


    public function postEditSanPham()
    {
        // Sử lý thêm dữ liệu
        // Kiểm tra xem dữ liệu có phải được submit lên không

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu 
            // lấy ra rữ liệu cũ của sản phẩm 
            $san_pham_id = $_POST['san_pham_id'] ?? '';
            // truy vấn 
            $sanPhamOld = $this->modelSanPham->getDetailSanPham($san_pham_id);
            $old_file = $sanPhamOld['hinh_anh']; // lấy ảnh cũ để phục vụ sửa ảnh 
            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $trang_thai = $_POST['trang_thai'];
            $mo_ta = $_POST['mo_ta'] ?? '';

            $hinh_anh = $_FILES['hinh_anh'] ?? null;


            // tạo mảng chống để chứa dữ liệu
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để chống';
            }

            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = 'Giá sản phẩm không được để chống';
            }
            
            if (empty($so_luong)) {
                $errors['so_luong'] = 'Số lượng sản phẩm không được để chống';
            }

            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'Ngày nhập sản phẩm không được để chống';
            }

            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'Chọn danh mục sản phẩm không được để chống';
            }

            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái sản phẩm không được để chống';
            }

            $_SESSION['error'] = $errors;
            // không có lỗi tiến hành thêm sản phẩm 

            // logic sửa ảnh 
            if (isset($hinh_anh) && $hinh_anh['error'] == UPLOAD_ERR_OK) {
                // up file ảnh mới lên 
                $new_file = uploadFile($hinh_anh, './uploads/');
                if (!empty($old_file)) {
                    deleteFile($old_file);
                }
            } else {
                $new_file = $old_file;
            }

            if (empty($errors)) {
                // không có lỗi thêm danh mục
                $this->modelSanPham->updateSanPham(
                    $san_pham_id,
                    $ten_san_pham,
                    $gia_san_pham,
                    $gia_khuyen_mai,
                    $so_luong,
                    $ngay_nhap,
                    $danh_muc_id,
                    $trang_thai,
                    $mo_ta,
                    $new_file
                );



                header('location: ' . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else {
                // trả về form
                // đặt chỉ thị xóa session sau khi hiển thị form
                $_SESSION['flash'] = true;
                header('location: ' . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
                exit();
            }
        }
    }


    // sửa Album ảnh sửa ảnh cũ -> thêm ảnh mới -> không thêm ảnh mới 
    // không sửa ảnh cũ -> thêm ảnh mới -> không thêm ảnh mới 
    // Xóa ảnh cũ 

    public function postEditAnhSanPham()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $san_pham_id = $_POST['san_pham_id'] ?? '';
            // lấy danh sách ảnh hiệm tại của sản phẩm
            $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($san_pham_id);
            // Sử lý các ảnh gửi từ form
            $img_array = $_FILES['img_array'];
            $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
            $current_img_ids = $_POST['current_img_ids']  ?? [];

            // Khai báo mảng thêm mới hoặc thay thế cũ 
            $upload_file = [];
            // up ảnh mới hoặc thay thế ảnh cũ 
            foreach ($img_array['name'] as $key => $value) {
                if ($img_array['error'][$key] == UPLOAD_ERR_OK) {
                    $new_file = uploadFileAlbum($img_array, './uploads/', $key);
                    if ($new_file) {
                        $upload_file[] = [
                            'id' => $current_img_ids[$key] ?? null,
                            'file' =>  $new_file
                        ];
                    }
                }
            }
            // lưu ảnh mới vào db xóa ảnh cũ 
            foreach ($upload_file as $file_info) {
                if ($file_info['id']) {
                    $old_file = $this->modelSanPham->getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];

                    // Cập nhật ảnh cũ 
                    $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);
                    // xóa ảnh cũ 
                    deleteFile($old_file);
                } else {
                    // thêm ảnh mới 
                    $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $file_info['file']);
                }
            }
            // sử lý xóa ảnh 
            foreach ($listAnhSanPhamCurrent as $anhSP) {
                $anh_id = $anhSP['id'];

                if (in_array($anh_id, $img_delete)) {
                    // xóa ảnh trong db
                    $this->modelSanPham->destroyAnhSanPham($anh_id);
                    // xóa file 
                    deleteFile($anhSP['link_hinh_anh']);
                }
            }
            header('location: ' . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
            exit();
        }
    }


    public function deleteSanPham()
    {
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        if ($sanPham) {

            $this->modelSanPham->destroySanPham($id);
        }
        if ($listAnhSanPham) {
            foreach ($listAnhSanPham as $key => $anhSP) {
                deleteFile($anhSP['liink_hinh_anh']);
                $this->modelSanPham->destroyAnhSanPham($anhSP['id']);
            }
        }
        header('location: ' . BASE_URL_ADMIN . '?act=san-pham');
        exit();
    }

    


    public function detailSanPham()
    {


        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);

        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

        if ($sanPham) {

            require_once './views/sanpham/detailSanPham.php';
            deleteSessionError();
        } else {
            header('location: ' . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
        
    }


    public function updateTrangThaiBinhLuan()
    {
        $id_binh_luan = $_POST['id_binh_luan'];
        $name_view = $_POST['name_view'];
        $binhLuan = $this->modelSanPham->getDetailBinhLuan($id_binh_luan);

        if ($binhLuan) {
            $trang_thai_update = '';
            if ($binhLuan['trang_thai'] == 1) {
                $trang_thai_update = 2;
            } else {
                $trang_thai_update = 1;
            }

            $status =    $this->modelSanPham->updateTrangThaiBinhLuan($id_binh_luan, $trang_thai_update);
            if ($status) {
                if ($name_view == 'detail_khach') {
                    header('location: ' . BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $binhLuan['tai_khoan_id']);
                }else{
                    header('location: ' . BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $binhLuan['san_pham_id']);
                }
            }
        }
    }








}
