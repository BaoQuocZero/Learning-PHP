<!-- xly_dangnhap.php -->
<?php
session_start(); // Bắt đầu phiên làm việc

// Tạo kết nối MySQL
$conn = new mysqli("localhost", "root", "", "online_shop");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu người dùng đã gửi thông tin đăng nhập
if (isset($_POST['sbmDN'])) {
    // Lấy thông tin từ form
    $username = $conn->real_escape_string($_POST['txtTDNhap']);
    $password = $conn->real_escape_string($_POST['pswMKhau']);
    $hashed_password = md5($password); // Mã hóa mật khẩu bằng MD5 (không nên dùng MD5 cho ứng dụng thực tế)

    // Kiểm tra trong bảng `nguoi_dung`
    $query_user = "SELECT * FROM nguoi_dung WHERE USERNAME = '$username'";
    $result_user = $conn->query($query_user);

    if ($result_user->num_rows > 0) {
        // Xử lý kết quả từ bảng `nguoi_dung`
        $row = $result_user->fetch_assoc();
        if ($row['PASSWORD'] === $hashed_password) {
            // Đăng nhập thành công
            $_SESSION['username'] = $username;
            $_SESSION['role'] = "user";
            echo "<script>alert('Đăng nhập thành công! Chào mừng $username');</script>";
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Mật khẩu không đúng!');</script>";
            header("Location: index.php");
        }
    } 

    // Kiểm tra trong bảng `admin`
    $query_admin = "SELECT * FROM admin WHERE USER_ADMIN = '$username'";
    $result_admin = $conn->query($query_admin);

    if ($result_admin->num_rows > 0) {
        // Xử lý kết quả từ bảng `admin`
        $row = $result_admin->fetch_assoc();
        if ($row['PASS_ADMIN'] === $hashed_password) {
            // Đăng nhập thành công
            $_SESSION['username'] = $username;
            $_SESSION['role'] = "admin";
            echo "<script>alert('Đăng nhập thành công! Chào mừng admin $username');</script>";
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Mật khẩu không đúng!');</script>";
            header("Location: index.php");
        }
    }

    // Nếu không tìm thấy trong cả hai bảng
    if ($result_user->num_rows === 0 && $result_admin->num_rows === 0) {
        echo "<script>alert('Tên đăng nhập không tồn tại!');</script>";
        header("Location: index.php");
    }
}

// Đóng kết nối
$conn->close();
?>