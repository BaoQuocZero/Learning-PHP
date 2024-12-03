<?php
// Khởi động session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!');</script>";
    header("Location: ../index.php"); // Chuyển hướng về trang đăng nhập
    exit();
}

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "online_shop");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy thông tin sản phẩm cần thêm
if (isset($_GET['add']) && is_numeric($_GET['add'])) {
    $idSach = intval($_GET['add']); // Lấy ID sản phẩm từ query string và ép kiểu an toàn
    $username = $_SESSION['username']; // Lấy tên đăng nhập từ session

    // Kiểm tra xem người dùng đã có giỏ hàng chưa
    $checkCartQuery = "SELECT * FROM gio_hang WHERE USERNAME = ?";
    $checkStmt = $conn->prepare($checkCartQuery);
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $cartResult = $checkStmt->get_result();

    if ($cartResult->num_rows > 0) {
        // Nếu giỏ hàng đã tồn tại, lấy ID giỏ hàng
        $cart = $cartResult->fetch_assoc();
        $idGioHang = $cart['ID_GIO_HANG'];
        
        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $checkDetailQuery = "SELECT * FROM chi_tiet_gio_hang WHERE ID_GIO_HANG = ? AND ID_SACH = ?";
        $checkDetailStmt = $conn->prepare($checkDetailQuery);
        $checkDetailStmt->bind_param("ii", $idGioHang, $idSach);
        $checkDetailStmt->execute();
        $detailResult = $checkDetailStmt->get_result();

        if ($detailResult->num_rows > 0) {
            // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
            $updateQtyQuery = "UPDATE chi_tiet_gio_hang SET SO_LUONG_MUA = SO_LUONG_MUA + 1 WHERE ID_GIO_HANG = ? AND ID_SACH = ?";
            $updateStmt = $conn->prepare($updateQtyQuery);
            $updateStmt->bind_param("ii", $idGioHang, $idSach);
            $updateStmt->execute();
        } else {
            // Nếu sản phẩm chưa có, thêm mới vào chi tiết giỏ hàng
            $insertDetailQuery = "INSERT INTO chi_tiet_gio_hang (USERNAME, ID_SACH, ID_GIO_HANG, SO_LUONG_MUA) VALUES (?, ?, ?, 1)";
            $insertDetailStmt = $conn->prepare($insertDetailQuery);
            $insertDetailStmt->bind_param("sii", $username, $idSach, $idGioHang);
            $insertDetailStmt->execute();
        }
    } else {
        // Nếu giỏ hàng chưa tồn tại, tạo giỏ hàng mới
        $insertCartQuery = "INSERT INTO gio_hang (USERNAME, THONG_TIN_GIO_HANG) VALUES (?, ?)";
        $insertCartStmt = $conn->prepare($insertCartQuery);
        $cartInfo = json_encode([$idSach => 1], JSON_UNESCAPED_UNICODE);
        $insertCartStmt->bind_param("ss", $username, $cartInfo);
        $insertCartStmt->execute();
        
        // Lấy ID giỏ hàng mới tạo
        $idGioHang = $conn->insert_id;

        // Thêm sản phẩm vào giỏ hàng
        $insertDetailQuery = "INSERT INTO chi_tiet_gio_hang (USERNAME, ID_SACH, ID_GIO_HANG, SO_LUONG_MUA) VALUES (?, ?, ?, 1)";
        $insertDetailStmt = $conn->prepare($insertDetailQuery);
        $insertDetailStmt->bind_param("sii", $username, $idSach, $idGioHang);
        $insertDetailStmt->execute();
    }

    // Hiển thị thông báo và chuyển hướng về trang trước đó
    echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng!');</script>";
    header("Location: ../index.php");
} else {
    echo "<script>alert('Không tìm thấy sản phẩm để thêm!');</script>";
    header("Location: ../index.php");
}

$conn->close(); // Đóng kết nối
?>