<?php
// Khởi động phiên làm việc
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Xóa tất cả các session
session_unset();

// Hủy session
session_destroy();

// Xóa cookie nếu có
setcookie('username', '', time() - 3600, "/");  // Xóa cookie username
setcookie('role', '', time() - 3600, "/");  // Xóa cookie role

// Chuyển hướng người dùng về trang đăng nhập (index.php hoặc login.php tùy vào cấu trúc của bạn)
header("Location: index.php");
exit();
?>