<?php
session_start(); // Bắt đầu phiên làm việc (session) để lưu trữ thông tin người dùng nếu cần

// Tạo kết nối MySQL
$conn = new mysqli("localhost", "root", "", "online_shop");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error); // Đảm bảo thông báo lỗi kết nối rõ ràng
}

// Kiểm tra nếu người dùng đã gửi thông tin đăng nhập (nút submit được nhấn)
if (isset($_POST['sbmDN'])) {
    // Lấy thông tin từ form
    $username = mysqli_real_escape_string($conn, $_POST['txtTDNhap']);
    $password = mysqli_real_escape_string($conn, $_POST['pswMKhau']);
    $hashed_password = md5($password); // Mã hóa mật khẩu người dùng nhập bằng MD5

    // Truy vấn cơ sở dữ liệu để kiểm tra tên đăng nhập và mật khẩu
    $query = "SELECT * FROM nguoi_dung WHERE USERNAME = '$username'";
    $result = mysqli_query($conn, $query);

    // Kiểm tra nếu tên đăng nhập tồn tại
    if (mysqli_num_rows($result) > 0) {
        // Lấy thông tin người dùng từ cơ sở dữ liệu
        $row = mysqli_fetch_assoc($result);

        // Kiểm tra mật khẩu
        if ($row['PASSWORD'] === $hashed_password) {
            // Đăng nhập thành công
            $_SESSION['nguoidung'] = $username;  // Lưu tên người dùng vào session
            header('Location: index.php');  // Chuyển hướng sau khi đăng nhập thành công
            exit();
        } else {
            // Mật khẩu không đúng
            echo "<script>alert('Mật khẩu không đúng!');</script>";
             header('Location: index.php');
        }
    } else {
        $query = "SELECT * FROM admin WHERE USER_ADMIN  = '$username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['PASS_ADMIN'] === $hashed_password) {
                // Đăng nhập thành công
                $_SESSION['admin'] = $username;  // Lưu tên người dùng vào session
                header('Location: index.php');  // Chuyển hướng sau khi đăng nhập thành công
                exit();
            } else {
                // Mật khẩu không đúng
                echo "<script>alert('Mật khẩu không đúng!');</script>";
                 header('Location: index.php');
            }
        } else {
            echo "<script>alert('Tên đăng nhập không tồn tại!');</script>";
             header('Location: index.php');
        }
    }
}

mysqli_close($conn); // Đóng kết nối với cơ sở dữ liệu
?>