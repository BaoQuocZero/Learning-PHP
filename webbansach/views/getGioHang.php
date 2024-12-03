<?php
// Khởi động session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Bạn cần đăng nhập để xem giỏ hàng!');</script>";
    header("Location: login.php");
    exit();
}

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "online_shop");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy thông tin giỏ hàng của người dùng hiện tại
$username = $_SESSION['username'];

// Truy vấn giỏ hàng và chi tiết giỏ hàng
$query = "
    SELECT c.ID_SACH, c.SO_LUONG_MUA, p.TEN_SACH
    FROM gio_hang g
    INNER JOIN chi_tiet_gio_hang c ON g.ID_GIO_HANG = c.ID_GIO_HANG
    INNER JOIN sach p ON c.ID_SACH = p.ID_SACH
    WHERE g.USERNAME = ?
";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);  // "s" xác định kiểu dữ liệu là string
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra nếu giỏ hàng tồn tại
$cartItems = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Lưu thông tin chi tiết sản phẩm vào mảng giỏ hàng
        $cartItems[] = [
            'idSach' => $row['ID_SACH'],
            'tenSach' => $row['TEN_SACH'],
            'soLuong' => $row['SO_LUONG_MUA']
        ];
    }
} else {
    echo "<script>alert('Giỏ hàng của bạn đang trống!');</script>";
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Giỏ Hàng</h1>

        <!-- Kiểm tra nếu giỏ hàng không trống -->
        <?php if (!empty($cartItems)): ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>ID Sách</th>
                        <th>Tên Sách</th>
                        <th>Số Lượng</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Duyệt qua từng sản phẩm trong giỏ hàng
                    foreach ($cartItems as $cart) {
                    ?>
                    <tr>
                        <td><?php echo $cart['idSach']; ?></td>
                        <td><?php echo htmlspecialchars($cart['tenSach']); ?></td>
                        <td><?php echo $cart['soLuong']; ?></td>
                        <td>
                            <a href="remove_cart.php?id=<?php echo $cart['idSach']; ?>"
                                class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="alert alert-warning text-center mt-4">Giỏ hàng của bạn đang trống.</div>
        <?php endif; ?>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>