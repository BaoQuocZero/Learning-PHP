<?php
// Khởi động phiên làm việc
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "online_shop");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy thông tin từ form
$username = $_SESSION['username'];
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

// Kiểm tra mật khẩu mới và xác nhận mật khẩu
if ($new_password !== $confirm_password) {
    echo "Mật khẩu mới và xác nhận mật khẩu không khớp.";
    exit();
}

// Mã hóa mật khẩu cũ bằng md5
$old_password_md5 = md5($old_password);

// Lấy mật khẩu cũ từ cơ sở dữ liệu
$query = "SELECT PASSWORD FROM nguoi_dung WHERE USERNAME = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Kiểm tra mật khẩu cũ có khớp không
    if ($old_password_md5 === $user['PASSWORD']) {
        // Mã hóa mật khẩu mới bằng md5
        $new_password_md5 = md5($new_password);

        // Cập nhật mật khẩu mới
        $update_query = "UPDATE nguoi_dung SET PASSWORD = ? WHERE USERNAME = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ss", $new_password_md5, $username);

        if ($update_stmt->execute()) {
            echo "Đổi mật khẩu thành công!";
            header("Location: ThongTinUser.php"); // Chuyển hướng về trang cá nhân
            exit();
        } else {
            echo "Có lỗi xảy ra. Vui lòng thử lại.";
        }

        $update_stmt->close();
    } else {
        echo "Mật khẩu cũ không đúng.";
    }
} else {
    echo "Người dùng không tồn tại.";
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>