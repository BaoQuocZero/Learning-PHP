<!-- xly_dangnhap.php -->
<?php
session_start(); // Bắt đầu phiên làm việc (session) để lưu trữ thông tin người dùng nếu cần

// Tạo kết nối MySQL
$conn = new mysqli("localhost", "root", "", "online_shop");

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Kiểm tra nếu người dùng đã gửi thông tin đăng nhập (nút submit được nhấn)
if (isset($_POST['sbmDN'])) {
    // Lấy thông tin từ form
    $username = mysqli_real_escape_string($conn, $_POST['txtTDNhap']);
    $password = mysqli_real_escape_string($conn, $_POST['pswMKhau']);
    // mysqli_real_escape_string: Ngăn ngừa SQL Injection bằng cách xử lý các ký tự đặc biệt trong chuỗi đầu vào.
    $hashed_password = md5($password); // Mã hóa mật khẩu người dùng nhập bằng MD5
    // Hiển thị qua alert
    echo "<script>alert('hashed_password: $hashed_password');</script>";

    // Truy vấn cơ sở dữ liệu để kiểm tra tên đăng nhập và mật khẩu
    $query = "SELECT * FROM nguoi_dung WHERE USERNAME = '$username'";
    $result = mysqli_query($conn, $query);

    // Kiểm tra nếu tên đăng nhập tồn tại
    if (mysqli_num_rows($result) > 0) {
        // Lấy thông tin người dùng từ cơ sở dữ liệu
        $row = mysqli_fetch_assoc($result);

        // Kiểm tra mật khẩu (có thể bạn sử dụng hash mật khẩu trong thực tế)
        if ($row['PASSWORD'] === $hashed_password) {
            // Đăng nhập thành công
            $_SESSION['username'] = $username;  // Lưu tên người dùng vào session
            echo "Đăng nhập thành công! Chào mừng, " . $username;
            // Chuyển hướng đến trang khác sau khi đăng nhập thành công (ví dụ: trang chủ)
            header('Location: index.php');  // Bạn có thể thay đổi URL này theo ý muốn
            exit();  // Dừng chương trình sau khi chuyển hướng
        } else {
            // Mật khẩu không đúng
            echo "Mật khẩu không đúng!";
        }
        print_r($_SESSION); // Hiển thị tất cả session hiện tại
    } else {
        // Tên đăng nhập không tồn tại
        echo "Tên đăng nhập không đúng!";
    }
}

mysqli_close($conn); // Đóng kết nối với cơ sở dữ liệu
?>