<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <td>Ảnh</td>
            <td>Tên sách</td>
            <td>Số lượng</td>
            <td>Tổng giá</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <img class="" style="max-width: 100px;" src="./hinhanh/Adolf_Hitler_28.jpg.webp" alt="">
            </td>
            <td>Chí phèo</td>
            <td>1</td>
            <td>10000 VNĐ</td>
            <td>
                <a href="" class="btn btn-warning btn-sm">Sửa</a>
                <a href="" class="btn btn-danger btn-sm">Xóa</a>
            </td>
        </tr>
    </tbody>
</table>
<?php
// Khởi động phiên làm việc
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kết nối cơ sở dữ liệu
include 'ketNoi.php';

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Vui lòng đăng nhập để xem giỏ hàng!'); window.location.href='index.php';</script>";
    exit();
}

// Lấy thông tin người dùng từ session
$username = $_SESSION['username'];

// Truy vấn để lấy giỏ hàng của người dùng
$queryGioHang = "SELECT gh.ID_GIO_HANG, gh.USER_ADMIN, gh.THONG_TIN_GIO_HANG 
                 FROM gio_hang gh
                 WHERE gh.USER_ADMIN = (SELECT USER_ADMIN FROM admin LIMIT 1) AND EXISTS 
                 (SELECT 1 FROM chi_tiet_gio_hang ctgh WHERE ctgh.USERNAME = '$username' AND ctgh.ID_GIO_HANG = gh.ID_GIO_HANG)";

$resultGioHang = mysqli_query($conn, $queryGioHang);

// Kiểm tra nếu giỏ hàng của người dùng tồn tại
if (mysqli_num_rows($resultGioHang) == 0) {
    echo "<p>Giỏ hàng của bạn hiện đang trống.</p>";
} else {
    // Lấy giỏ hàng của người dùng
    $gioHang = mysqli_fetch_assoc($resultGioHang);
    echo "<h2>Giỏ hàng của bạn</h2>";
    echo "<p><strong>Thông tin giỏ hàng:</strong> " . $gioHang['THONG_TIN_GIO_HANG'] . "</p>";

    // Truy vấn để lấy danh sách chi tiết sản phẩm trong giỏ hàng
    $queryChiTietGioHang = "SELECT ctgh.ID_CHI_TIET_GIO_HANG, ctgh.ID_SACH, ctgh.SO_LUONG_MUA, s.TEN_SACH, s.GIA, s.HINH_SACH 
                            FROM chi_tiet_gio_hang ctgh 
                            JOIN sach s ON ctgh.ID_SACH = s.ID_SACH 
                            WHERE ctgh.USERNAME = '$username' AND ctgh.ID_GIO_HANG = {$gioHang['ID_GIO_HANG']}";
    $resultChiTiet = mysqli_query($conn, $queryChiTietGioHang);

    // Kiểm tra nếu có sản phẩm trong giỏ hàng
    if (mysqli_num_rows($resultChiTiet) > 0) {
        echo "<table class='table table-bordered table-hover'>
                <thead>
                    <tr>
                        <td>Ảnh</td>
                        <td>Tên sách</td>
                        <td>Số lượng</td>
                        <td>Giá</td>
                        <td>Tổng giá</td>
                        <td>Thao tác</td>
                    </tr>
                </thead>
                <tbody>";

        $tongTien = 0; // Tổng tiền giỏ hàng
        while ($row = mysqli_fetch_assoc($resultChiTiet)) {
            $tongGia = $row['SO_LUONG_MUA'] * $row['GIA']; // Tính tổng giá của sản phẩm
            $tongTien += $tongGia; // Cộng vào tổng tiền giỏ hàng
            echo "<tr>
            <td><img style='max-width: 100px;' src='./hinhanh/{$row['HINH_SACH']}' alt='{$row['TEN_SACH']}'></td>
            <td>{$row['TEN_SACH']}</td>
            <td>{$row['SO_LUONG_MUA']}</td>
            <td>{$row['GIA']} VND</td>
            <td>{$tongGia} VND</td>
            <td>
                <a href='xoaGioHang.php?ID_CHI_TIET_GIO_HANG={$row['ID_CHI_TIET_GIO_HANG']}' class='btn btn-danger btn-sm'>Xóa</a>
                <a href='capNhatGioHang.php?id={$row['ID_CHI_TIET_GIO_HANG']}&action=update' class='btn btn-warning btn-sm'>Cập nhật</a>
            </td>
        </tr>";


        }

        echo "<tr>
                <td colspan='4' align='right'><strong>Tổng tiền:</strong></td>
                <td><strong>$tongTien VND</strong></td>
                <td></td>
              </tr>";
        echo "</tbody></table>";

        echo "<br><a href='thanhToan.php' class='btn btn-success'>Tiến hành thanh toán</a>";
    } else {
        echo "<p>Giỏ hàng của bạn hiện không có sản phẩm nào.</p>";
    }
}
?>