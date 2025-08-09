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


}