<?php

class GioHang
{
        public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }



    public function getGioHangFromUser($id){
        try {
                $sql = "SELECT * FROM gio_hangs WHERE tai_khoan_id = :tai_khoan_id "  ;
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([':tai_khoan_id' => $id]);
                return $stmt->fetch();
            } catch (Exception $e) {
                echo "Lỗi " . $e->getMessage();
        }
    }


public function getDetailGioHang($id){
    try {
              $sql = "SELECT chi_tiet_gio_hangs. *, san_phams.ten_san_pham ,san_phams.hinh_anh ,san_phams.gia_san_pham,san_phams.gia_khuyen_mai
              FROM chi_tiet_gio_hangs 
              INNER JOIN san_phams ON chi_tiet_gio_hangs.san_pham_id = san_phams.id 
              where  chi_tiet_gio_hangs.gio_hang_id=:gio_hang_id " ; 

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':gio_hang_id' => $id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        
    }
}

        public function addGioHang($id) {
            try {
                $sql = "INSERT INTO gio_hangs (tai_khoan_id) VALUES (:id)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([':id' => $id]);
                return $this->conn->lastInsertId();
            } catch (Exception $e) {
                echo "Lỗi: " . $e->getMessage();
                return false;
            }
        }


        

            public function updateSoLuong($gio_hang_id, $san_pham_id, $so_luong) {
                try {
                    $sql = "UPDATE chi_tiet_gio_hangs   
                            SET so_luong = :so_luong
                            WHERE gio_hang_id = :gio_hang_id AND san_pham_id = :san_pham_id";
                    
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute([
                        ':so_luong' => $so_luong,
                        ':gio_hang_id' => $gio_hang_id,
                        ':san_pham_id' => $san_pham_id
                    ]);

                    // Trả về số dòng bị ảnh hưởng (nên dùng hơn lastInsertId trong UPDATE)
                    return true;

                } catch (Exception $e) {
                    echo "Lỗi: " . $e->getMessage();
                }
            }




            
                public function addDetailGioHang($gio_hang_id, $san_pham_id, $so_luong) {
                    try {
                        $sql = "INSERT INTO chi_tiet_gio_hangs (gio_hang_id, san_pham_id, so_luong) 
                                VALUES (:gio_hang_id, :san_pham_id, :so_luong)";
                        
                        $stmt = $this->conn->prepare($sql);
                        $stmt->execute([
                            ':gio_hang_id' => $gio_hang_id,
                            ':san_pham_id' => $san_pham_id,
                            ':so_luong' => $so_luong
                        ]);

                        return true;
                    } catch (Exception $e) {
                        echo "Lỗi: " . $e->getMessage();
                    }
                }


                
                public function clearDetailGioHang($gioHangId) {
                    try {
                        $sql = " DELETE From chi_tiet_gio_hangs WHERE gio_hang_id  = :gio_hang_id ";
                        
                        $stmt = $this->conn->prepare($sql);
                        $stmt->execute([
                            ':gio_hang_id' => $gioHangId,

                        ]);

                        return true;
                    } catch (Exception $e) {
                        echo "Lỗi: " . $e->getMessage();
                    }
                }

                public function clearGioHang($taiKhoanId) {
                    try {
                        $sql = " DELETE From gio_hangs WHERE tai_khoan_id  = :tai_khoan_id ";
                        
                        $stmt = $this->conn->prepare($sql);
                        $stmt->execute([
                            ':tai_khoan_id' => $taiKhoanId,

                        ]);

                        return true;
                    } catch (Exception $e) {
                        echo "Lỗi: " . $e->getMessage();
                    }
                }



             public function getChiTietById($sanPhamId) {
                    try {
                    $sql = "SELECT * FROM chi_tiet_gio_hangs WHERE id = :id";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute([':id' => $sanPhamId]);
                    return $stmt->fetch();
                    } catch (Exception $e) {
                        echo "Lỗi: " . $e->getMessage();
                    }
                }


                
             public function deleteChiTietSanPham($sanPhamId) {
                    try {
                    $sql = "DELETE FROM chi_tiet_gio_hangs WHERE id = :id";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute([':id' => $sanPhamId]);
                    } catch (Exception $e) {
                        echo "Lỗi: " . $e->getMessage();
                    }
                }



}