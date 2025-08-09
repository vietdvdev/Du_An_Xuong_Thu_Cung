<?php 

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

define('BASE_URL'       , 'http://localhost/Mau1_DA/Tai_Nguyen_1/xuong-thu-cung/');
// đường dẫn vào phần admin
define('BASE_URL_ADMIN'       , 'http://localhost/Mau1_DA/Tai_Nguyen_1/xuong-thu-cung/admin/');

define('DB_HOST'    , 'localhost');
define('DB_PORT'    , 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME'    , 'xuong_thu_cung');  // Tên database

define('PATH_ROOT'    , __DIR__ . '/../');
