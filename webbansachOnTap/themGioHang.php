<?php
// Khởi động phiên làm việc
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Kiểm tra quyền
if ($_SESSION['role'] === 'admin') {
    echo "<script>alert('Admin không có giỏ hàng!'); window.location.href='index.php';</script>";
    exit();
}
// Kết nối cơ sở dữ liệu
include 'ketNoi.php';

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Vui lòng đăng nhập trước khi thêm vào giỏ hàng!'); window.location.href='index.php';</script>";
    exit();
}

// Lấy thông tin người dùng từ session
$username = $_SESSION['username'];

// Kiểm tra xem người dùng có phải là admin không
if ($_SESSION['role'] !== 'user') {
    echo "<script>alert('Chỉ người dùng mới có thể thêm vào giỏ hàng!'); window.location.href='index.php';</script>";
    exit();
}

// Kiểm tra có `ID_SACH` trong URL không
if (isset($_GET['themGio'])) {
    $idSach = $_GET['themGio'];

    // Lấy USER_ADMIN đầu tiên trong bảng admin
    $queryAdmin = "SELECT `USER_ADMIN` FROM `admin` LIMIT 1";
    $resultAdmin = mysqli_query($conn, $queryAdmin);

    if (mysqli_num_rows($resultAdmin) > 0) {
        $admin = mysqli_fetch_assoc($resultAdmin);
        $userAdmin = $admin['USER_ADMIN'];

        // Kiểm tra xem giỏ hàng của người dùng đã có sản phẩm này chưa
        $queryCheck = "SELECT `ID_CHI_TIET_GIO_HANG`, `SO_LUONG_MUA` FROM `chi_tiet_gio_hang` 
                       WHERE `USERNAME` = '$username' AND `ID_SACH` = '$idSach' AND `SO_LUONG_MUA` > 0";
        $resultCheck = mysqli_query($conn, $queryCheck);

        if (mysqli_num_rows($resultCheck) > 0) {
            // Nếu đã có sản phẩm, cập nhật số lượng
            $row = mysqli_fetch_assoc($resultCheck);
            $newQuantity = $row['SO_LUONG_MUA'] + 1; // Tăng số lượng sản phẩm lên 1

            $updateQuery = "UPDATE `chi_tiet_gio_hang` 
                            SET `SO_LUONG_MUA` = $newQuantity 
                            WHERE `ID_CHI_TIET_GIO_HANG` = '{$row['ID_CHI_TIET_GIO_HANG']}'";

            if (mysqli_query($conn, $updateQuery)) {
                echo "<script>alert('Sản phẩm đã được cập nhật vào giỏ hàng!'); window.location.href='gioHang.php';</script>";
            } else {
                echo "<script>alert('Có lỗi xảy ra khi cập nhật giỏ hàng.'); window.location.href='index.php';</script>";
            }
        } else {
            // Nếu chưa có sản phẩm, thêm mới vào giỏ hàng
            $thongTinGioHang = 'Giỏ hàng của ' . $username; // Bạn có thể thay đổi thông tin giỏ hàng nếu cần
            $queryGioHang = "INSERT INTO `gio_hang`(`USER_ADMIN`, `THONG_TIN_GIO_HANG`) VALUES ('$userAdmin', '$thongTinGioHang')";
            if (mysqli_query($conn, $queryGioHang)) {
                // Lấy ID_GIO_HANG mới vừa thêm
                $idGioHang = mysqli_insert_id($conn);

                // Thêm chi tiết vào giỏ hàng (bảng `chi_tiet_gio_hang`)
                $soLuongMua = 1; // Giả sử người dùng thêm 1 sản phẩm
                $queryChiTietGioHang = "INSERT INTO `chi_tiet_gio_hang`(`USERNAME`, `ID_SACH`, `ID_GIO_HANG`, `SO_LUONG_MUA`) 
                                        VALUES ('$username', '$idSach', '$idGioHang', '$soLuongMua')";
                if (mysqli_query($conn, $queryChiTietGioHang)) {
                    echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng!'); window.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('Có lỗi xảy ra khi thêm chi tiết giỏ hàng.'); window.location.href='index.php';</script>";
                }
            } else {
                echo "<script>alert('Có lỗi xảy ra khi thêm giỏ hàng.'); window.location.href='index.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Không có admin nào trong hệ thống.'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('Không có sản phẩm để thêm vào giỏ hàng!'); window.location.href='index.php';</script>";
}
?>