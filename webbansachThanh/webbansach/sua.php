<?php
session_start();
$conn = new mysqli("localhost", "root", "", "online_shop");

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the username from the URL parameter
if (isset($_GET['edit'])) {
    $username = $_GET['edit'];

    // Fetch the current user data from the database
    $sql = "SELECT * FROM nguoi_dung WHERE USERNAME = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "User not found!";
        exit();
    }
}

// Update user data when the form is submitted
if (isset($_POST['save'])) {
    // Get the updated values from the form
    $password = md5($_POST['password']);
    $hoten = $_POST['hoten'];
    $gioitinh = $_POST['gioitinh'];
    $quocgia = $_POST['quocgia'];
    $hinhdai = $_POST['hinhdaidiens']; // Get the existing image if no new image uploaded

    // Handle file upload for image
    if ($_FILES['hinhanh']['name']) {
        // Lấy tên file và di chuyển nó vào thư mục hinhanh/
        $hinhdai = basename($_FILES["hinhanh"]["name"]); // Lấy tên file từ $_FILES
        $target_file = "hinhanh/" . $hinhdai; // Đường dẫn lưu file
    
        // Di chuyển file từ thư mục tạm đến thư mục hinhanh/
        if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
            echo "File ". htmlspecialchars($hinhdai). " đã được tải lên.";
        } else {
            echo "Có lỗi khi tải lên file.";
        }
    } else {
        // Nếu không có file tải lên, giữ nguyên giá trị của $hinhdai từ $_POST (trường hợp người dùng không thay đổi ảnh)
        $target_file = $_POST['hinhdaidiens']; // Giữ nguyên ảnh cũ nếu không upload mới
    }
    
    // Update the user data in the database
    $updateSql = "UPDATE nguoi_dung SET PASSWORD = ?, HOTEN = ?, GIOITINH = ?, QUOCGIA = ?, HINHDAIDIEN = ? WHERE USERNAME = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ssssss", $password, $hoten, $gioitinh, $quocgia, $target_file, $username);
    $stmt->execute();

    // Redirect after the update
    header("Location: index.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin người dùng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Chỉnh sửa thông tin người dùng</h1>

        <form action="" method="post" enctype="multipart/form-data" class="mt-4">
            <!-- Username is read-only because it should not be changed -->
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" name="username" class="form-control" value="<?php echo $row['USERNAME']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" name="password" class="form-control" value="<?php echo $row['PASSWORD']; ?>" required>
            </div>

            <div class="form-group">
                <label for="hoten">Họ tên:</label>
                <input type="text" name="hoten" class="form-control" value="<?php echo $row['HOTEN']; ?>" required>
            </div>

            <div class="form-group">
                <label for="gioitinh">Giới tính:</label>
                <select name="gioitinh" class="form-control" required>
                    <option value="Nam" <?php echo ($row['GIOITINH'] == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo ($row['GIOITINH'] == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                </select>
            </div>

            <div class="form-group">
                <label for="quocgia">Quốc gia:</label>
                <input type="text" name="quocgia" class="form-control" value="<?php echo $row['QUOCGIA']; ?>" required>
            </div>

            <div class="form-group">
                <label for="hinhdai">Hình ảnh đại diện:</label>
                <input type="file" name="hinhanh" class="form-control-file">
                <?php
                if ($row['HINHDAIDIEN']) {
                    echo "<br><img src='" . $row['HINHDAIDIEN'] . "' alt='Image' width='100'>";
                }
                ?>
            </div>

            <button type="submit" name="save" class="btn btn-primary">Lưu thay đổi</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
