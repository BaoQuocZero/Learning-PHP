<?php
//session_start();
$kn = new mysqli("localhost", "root", "", "online_shop");

// Kiểm tra kết nối
if ($kn->connect_error) {
    die("Kết nối thất bại: " . $kn->connect_error);
}

// Cấu hình mã hóa
$kn->set_charset("utf8");

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['nguoidung']) || isset($_SESSION['admin'])) {
    $username = isset($_SESSION['nguoidung']) ? $_SESSION['nguoidung'] : $_SESSION['admin'];
    $table = isset($_SESSION['nguoidung']) ? "nguoidung" : "admin";
    $passwordColumn = isset($_SESSION['nguoidung']) ? "PASSWORD" : "PASS_ADMIN";
    $usernameColumn = isset($_SESSION['nguoidung']) ? "USERNAME" : "USER_ADMIN";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $currentPassword = isset($_POST['current_password']) ? md5($_POST['current_password']) : '';
        $newPassword = isset($_POST['new_password']) ? md5($_POST['new_password']) : '';
        $confirmPassword = isset($_POST['confirm_password']) ? md5($_POST['confirm_password']) : '';

        if ($newPassword !== $confirmPassword) {
            $error = "Mật khẩu mới và xác nhận mật khẩu không khớp!";
        } else {
            $stmt = $kn->prepare("SELECT $passwordColumn FROM $table WHERE $usernameColumn = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($storedPassword);
            $stmt->fetch();
            $stmt->close();

            if ($storedPassword !== $currentPassword) {
                $error = "Mật khẩu cũ không đúng!";
            } else {
                $updateStmt = $kn->prepare("UPDATE $table SET $passwordColumn = ? WHERE $usernameColumn = ?");
                $updateStmt->bind_param("ss", $newPassword, $username);

                if ($updateStmt->execute()) {
                    $success = "Đổi mật khẩu thành công!";
                } else {
                    $error = "Có lỗi xảy ra khi đổi mật khẩu!";
                }
                $updateStmt->close();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>
</head>

<body>
    <h1>Đổi Mật Khẩu</h1>
    <?php if (isset($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <?php if (isset($success)): ?>
    <p style="color: green;"><?php echo htmlspecialchars($success); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="current_password">Mật khẩu cũ:</label><br>
        <input type="password" id="current_password" name="current_password" required><br><br>

        <label for="new_password">Mật khẩu mới:</label><br>
        <input type="password" id="new_password" name="new_password" required><br><br>

        <label for="confirm_password">Xác nhận mật khẩu mới:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <button type="submit">Đổi mật khẩu</button>
    </form>
</body>

</html>