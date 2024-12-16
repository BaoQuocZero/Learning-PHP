<?php
session_start();

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "online_shop");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function randomNumber($min, $max) {
    return rand($min, $max);  // Hoặc có thể dùng mt_rand($min, $max)
}

// Kiểm tra nếu có tham số 'giohang' (ID sách) và 'username' trong URL
if (isset($_GET['giohang']) && isset($_SESSION['nguoidung'])) {
    $sanpham_id = $_GET['giohang'];  // ID sách
    $username = $_SESSION['nguoidung'];   // Tên người dùng từ session

        $insert_sql = "INSERT INTO gio_hang (THONG_TIN_GIO_HANG) VALUES (1)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->execute();

      
$giohang_id = $stmt->insert_id;  // Lấy ID của giỏ hàng vừa tạo
$stmt->close();

// Bước 2: Lưu chi tiết giỏ hàng vào bảng chi_tiet_gio_hang
$insert_chitiet_sql = "INSERT INTO chi_tiet_gio_hang (USERNAME, ID_SACH, ID_GIO_HANG, ID_CHI_TIET_GIO_HANG, SO_LUONG_MUA) VALUES (?, ?, ?, ?, ?)";

// Chuẩn bị câu lệnh
$stmt = $conn->prepare($insert_chitiet_sql);

// Dữ liệu cần chèn
$username = $_SESSION['nguoidung'];  // Lấy tên người dùng từ session
$sanpham_id = $_GET['giohang'];  // Lấy ID sản phẩm từ URL (hoặc nơi khác bạn lấy được)
$so_luong = 1;  // Mặc định số lượng là 1
$id_chi_tiet_gio_hang = randomNumber(1, 100);  // Số ngẫu nhiên cho ID chi tiết giỏ hàng (hoặc có thể là ID tự động nếu có)

$stmt->bind_param("ssiii", $username, $sanpham_id, $giohang_id, $id_chi_tiet_gio_hang, $so_luong);  // Chú ý kiểu dữ liệu đúng

// Thực thi câu lệnh
$stmt->execute();

// Kiểm tra kết quả
if ($stmt->affected_rows > 0) {
    echo "Sản phẩm đã được thêm vào giỏ hàng!";
} else {
    echo "Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng!";
}

    $stmt->close();
} else {
    // Nếu thiếu tham số, báo lỗi
    echo "<script>
            alert('Lỗi: Không có sản phẩm hoặc người dùng!');
            window.location.href = 'index.php';  // Quay lại trang chính nếu thiếu tham số
          </script>";
}

$conn->close();
?>