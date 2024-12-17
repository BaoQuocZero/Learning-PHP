<?php
// Khởi động phiên làm việc
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Vui lòng đăng nhập để thực hiện thao tác này!'); window.location.href='index.php';</script>";
    exit();
}

// Kết nối cơ sở dữ liệu
include 'ketNoi.php';

// Lấy ID sản phẩm cần xóa từ URL
if (isset($_GET['ID_CHI_TIET_GIO_HANG'])) {
    $idChiTietGioHang = $_GET['ID_CHI_TIET_GIO_HANG'];

    // Truy vấn để xóa sản phẩm khỏi giỏ hàng
    $queryXoa = "DELETE FROM chi_tiet_gio_hang WHERE ID_CHI_TIET_GIO_HANG = '$idChiTietGioHang'";

    if (mysqli_query($conn, $queryXoa)) {
        echo "<script>alert('Xóa sản phẩm khỏi giỏ hàng thành công!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Có lỗi khi xóa sản phẩm!'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('ID sản phẩm không hợp lệ!'); window.location.href='index.php';</script>";
}
?>