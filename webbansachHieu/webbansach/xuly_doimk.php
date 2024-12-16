<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("ketnoi.php");

if (!isset($_SESSION["nguoidung"])) {
    echo "<script>alert('Bạn chưa đăng nhập!'); window.location='dangky.php';</script>";
    exit();
}

$matkhau_cu = $_POST['matkhau_cu'];
$matkhau_moi = $_POST['matkhau_moi'];
$matkhau_moi_confirm = $_POST['matkhau_moi_confirm'];
$username = $_SESSION["nguoidung"];

if ($matkhau_moi !== $matkhau_moi_confirm) {
    echo "<script>alert('Mật khẩu mới và xác nhận mật khẩu không khớp!'); window.location='thaydoimatkhau.php';</script>";
    exit();
}


$sql = "SELECT * FROM nguoi_dung WHERE username = ?";
$stmt = mysqli_prepare($kn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    
    if (!password_verify($matkhau_cu, $row['password'])) {
        echo "<script>alert('Mật khẩu cũ không đúng!'); window.location='frmdoimk.php';</script>";
        exit();
    }

    // Mã hóa mật khẩu mới
    $matkhau_moi_hash = password_hash($matkhau_moi, PASSWORD_BCRYPT);

    // Cập nhật mật khẩu mới vào cơ sở dữ liệu
    $sql_update = "UPDATE nguoi_dung SET password = ? WHERE username = ?";
    $stmt_update = mysqli_prepare($kn, $sql_update);
    mysqli_stmt_bind_param($stmt_update, "ss", $matkhau_moi_hash, $username);
    
    if (mysqli_stmt_execute($stmt_update)) {
        echo "<script>alert('Mật khẩu đã được thay đổi thành công!'); window.location='trangtt_canhan.php';</script>";
    } else {
        echo "<script>alert('Có lỗi khi thay đổi mật khẩu!'); window.location='frmdoimk.php';</script>";
    }
} else {
    echo "<script>alert('Không tìm thấy người dùng!'); window.location='frmdoimk.php';</script>";
}

mysqli_stmt_close($stmt);
mysqli_stmt_close($stmt_update);
mysqli_close($kn);
?>
