<?php
// Khởi động phiên làm việc
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit();
}

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "online_shop");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy thông tin người dùng từ session
$username = $_SESSION['username'];

// Truy vấn thông tin người dùng
$query = "SELECT USERNAME, HOTEN, QUOCGIA, HINHDAIDIEN FROM nguoi_dung WHERE USERNAME = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra nếu người dùng tồn tại
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Không tìm thấy thông tin người dùng.";
    exit();
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
    <title>Trang Cá Nhân</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Trang Cá Nhân</h1>
        <div class="card mx-auto mt-4" style="max-width: 500px;">
            <div class="card-header text-center">
                <h3>Chào, <?php echo htmlspecialchars($user['HOTEN']); ?>!</h3>
            </div>
            <div class="card-body">
                <p><strong>Tên đăng nhập:</strong>
                    <?php echo htmlspecialchars($user['USERNAME']); ?></p>
                <p><strong>Quốc gia:</strong> <?php echo htmlspecialchars($user['QUOCGIA']); ?></p>
                <div class="text-center">
                    <?php if (!empty($user['HINHDAIDIEN'])): ?>
                    <img src="<?php echo htmlspecialchars($user['HINHDAIDIEN']); ?>" alt="Ảnh đại diện"
                        class="img-thumbnail" style="max-width: 200px;">
                    <?php else: ?>
                    <p><em>Không có ảnh đại diện.</em></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="logout.php" class="btn btn-danger">Đăng xuất</a>
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>