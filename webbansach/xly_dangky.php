<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php
// Tạo kết nối MySQL
$conn = new mysqli("localhost", "root", "", "online_shop");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu người dùng đã gửi thông tin đăng ký (nút submit được nhấn)
if (isset($_POST['dangky'])) {
    // Lấy thông tin từ form
    $username = mysqli_real_escape_string($conn, $_POST['tendn']);
    $password = mysqli_real_escape_string($conn, $_POST['matkhau']);
    $hoten = mysqli_real_escape_string($conn, $_POST['hoten']);
    $gioitinh = mysqli_real_escape_string($conn, $_POST['gioitinh']);
    $quocgia = mysqli_real_escape_string($conn, $_POST['quocgia']);
    echo ' '.$username.' '.$password.' '.$hoten.' '.$gioitinh.' '.$quocgia.';';

    // Kiểm tra xem file ảnh có được upload không
    if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] == 0) {
        // Lấy đường dẫn và xử lý file
        $target_dir = "hinhanh/";
        $target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
        move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file);
    } else {
        $target_file = ""; // Không có ảnh đại diện
    }

    // Mã hóa mật khẩu người dùng bằng MD5 (không khuyến khích trong thực tế, nên dùng bcrypt hoặc Argon2)
    $hashed_password = md5($password);

    // Kiểm tra nếu tên đăng nhập đã tồn tại
    $query = "SELECT * FROM nguoi_dung WHERE USERNAME = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Tên đăng nhập đã tồn tại
        echo "Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác!";
    } else {
        // Tên đăng nhập chưa tồn tại, thêm người dùng mới
        $query = "INSERT INTO nguoi_dung (USERNAME, PASSWORD, HOTEN, QUOCGIA, HINHDAIDIEN) 
                  VALUES ('$username', '$hashed_password', '$hoten', '$quocgia', '$target_file')";

        if (mysqli_query($conn, $query)) {
            echo "Đăng ký thành công!";
            // Lưu thông tin đăng ký vào session (nếu cần)
            $_SESSION['username'] = $username;
            header('Location: index.php'); // Chuyển hướng sau khi đăng ký thành công
            exit();
        } else {
            echo "Có lỗi xảy ra: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn); // Đóng kết nối với cơ sở dữ liệu
?>