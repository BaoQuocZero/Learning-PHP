<?php
session_start();

// Kết nối cơ sở dữ liệu
$kn = new mysqli("localhost", "root", "", "online_shop");

// Kiểm tra kết nối
if ($kn->connect_error) {
    die("Kết nối thất bại: " . $kn->connect_error);
}

// Kiểm tra và xử lý xóa người dùng
if (isset($_GET['delete'])) {
    $id_sach = $_GET['delete'];

    // Chuẩn bị câu lệnh xóa
    $stmt = $kn->prepare("DELETE FROM nguoi_dung WHERE USERNAME=?");

    // Bind tham số: "s" cho chuỗi (USERNAME là chuỗi)
    $stmt->bind_param("s", $id_sach);

    // Thực thi câu lệnh
    $stmt->execute();

    // Kiểm tra nếu xóa thành công
    if ($stmt->affected_rows > 0) {
        // Nếu xóa thành công, chuyển hướng về trang danh sách
     header("Location: http://localhost:8051/webbansach/index.php?page=quantri");
exit();


   
    } else {
        // Nếu không xóa thành công, có thể thông báo lỗi
        echo "Xóa không thành công.";
    }

    // Đóng câu lệnh
    $stmt->close();
}

// Đóng kết nối
$kn->close();
?>