<?php

class TaiKhoan
{
        public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }




    
        public function checkLogin($email,$mat_khau){
            try {
            $sql = "SELECT * FROM tai_khoans WHERE email = :email";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute(['email'=>$email]);

            $user = $stmt->fetch();

                if ($user) {
                    // Người dùng tồn tại, kiểm tra mật khẩu
                    if (password_verify($mat_khau, $user['mat_khau'])) {
                        // Mật khẩu đúng, kiểm tra quyền và trạng thái
                        if ($user['chuc_vu_id'] == 2) {
                            if ($user['trang_thai'] == 1) {
                                return $user['email'];  // Đăng nhập thành công
                            } else {
                                return "Tài khoản bị cấm";
                            }
                        } else {
                            return "Tài khoản không có quyền đăng nhập";
                        }
                    } else {
                        // Sai mật khẩu
                        return "Mật khẩu không đúng";
                    }
                } else {
                    // Không tìm thấy người dùng
                    return "Tài khoản không tồn tại";
                }


            } catch (\Exception $e) {
               echo "Lỗi" . $e->getMessage();
               return false;
        }

    }

         public function getTaiKhoanFromEmail($email){
        try {
            $sql = "SELECT * FROM tai_khoans WHERE email=:email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':email' => $email
               
            ]);

            return $stmt->fetch();

        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }  

    
            
    public function resetPassword($id ,$password){
        try {
         
            $sql = " UPDATE tai_khoans SET 
                   
                    mat_khau = :mat_khau

                WHERE id = :id";
                // var_dump($sql);die;
                $stmt = $this->conn->prepare($sql);
                
            //    var_dump($stmt); die;
            $stmt->execute([
                ':mat_khau' => $password,
                 ':id' => $id
            ]);
               
            return true;

        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }  



    public function updateTaiKhoanCaNhanKhachhang($id , $ho_ten, $ngay_sinh, $so_dien_thoai, $gioi_tinh, $dia_chi, $anh_dai_dien){
    try {
        $sql = "UPDATE tai_khoans SET 
                    ho_ten = :ho_ten,
                    ngay_sinh = :ngay_sinh,
                    so_dien_thoai = :so_dien_thoai,
                    gioi_tinh = :gioi_tinh,
                    dia_chi = :dia_chi,
                    anh_dai_dien = :anh_dai_dien
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':ho_ten' => $ho_ten,
            ':ngay_sinh' => $ngay_sinh,
            ':so_dien_thoai' => $so_dien_thoai,
            ':gioi_tinh' => $gioi_tinh,
            ':dia_chi' => $dia_chi,
            ':anh_dai_dien' => $anh_dai_dien,
            ':id' => $id
        ]);
        return true;
    } catch (Exception $e) {
        echo "Lỗi" . $e->getMessage();
    }
}






}