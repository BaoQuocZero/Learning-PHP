<?php
// Khởi động phiên làm việc
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra nếu người dùng đã gửi form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối cơ sở dữ liệu
    include 'ketNoi.php';

    // Lấy thông tin từ form
    $username = $_POST['txtTDNhap'];
    $password = md5($_POST['pswMKhau']);  // Mã hóa mật khẩu

    // Kiểm tra trong bảng admin (role admin)
    $queryAdmin = "SELECT `USER_ADMIN`, `PASS_ADMIN` FROM `admin` WHERE `USER_ADMIN` = '$username' AND `PASS_ADMIN` = '$password'";
    $resultAdmin = mysqli_query($conn, $queryAdmin);
    if (mysqli_num_rows($resultAdmin) > 0) {
        // Đăng nhập thành công vào bảng admin
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'admin';  // Lưu role admin

        // Lưu thông tin vào cookie (thời gian sống 7 ngày)
        setcookie('username', $username, time() + (86400 * 7), "/");
        setcookie('role', 'admin', time() + (86400 * 7), "/");

        // Chuyển hướng đến trang admin (hoặc trang bạn muốn)
        header("Location: index.php");
        exit();
    }

    // Kiểm tra trong bảng người dùng (role user)
    $queryUser = "SELECT `USERNAME`, `PASSWORD`, `HOTEN`, `GIOITINH`, `QUOCGIA`, `HINHDAIDIEN` FROM `nguoi_dung` WHERE `USERNAME` = '$username' AND `PASSWORD` = '$password'";
    $resultUser = mysqli_query($conn, $queryUser);
    if (mysqli_num_rows($resultUser) > 0) {
        // Đăng nhập thành công vào bảng người dùng
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'user';  // Lưu role user

        // Lưu thông tin vào cookie (thời gian sống 7 ngày)
        setcookie('username', $username, time() + (86400 * 7), "/");
        setcookie('role', 'user', time() + (86400 * 7), "/");

        // Chuyển hướng đến trang người dùng (hoặc trang bạn muốn)
        header("Location: index.php");
        exit();
    }

    // Nếu không đăng nhập thành công
    echo "<script>alert('Đăng nhập thất bại, vui lòng kiểm tra lại tài khoản và mật khẩu!'); window.location.href='index.php';</script>";
}
?>