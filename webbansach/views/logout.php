<!-- logout.php -->
<?php
session_start(); // Bắt đầu session để truy cập thông tin

// Xóa tất cả các biến session
$_SESSION = [];

// Hủy session
session_destroy();

// Chuyển hướng người dùng về trang chính hoặc trang đăng nhập
header('Location: ../index.php'); // Thay 'index.php' bằng trang bạn muốn chuyển hướng tới
exit();
?>