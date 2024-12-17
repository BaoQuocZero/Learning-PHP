<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
    echo "</pre>";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'ketNoi.php';

    // Lấy dữ liệu từ form
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Mã hóa mật khẩu bằng MD5
    $hoten = $_POST['hoten'];
    $gioitinhRaw = $_POST['gioitinh'];
    $quocgia = $_POST['quocgia'];
    $role = $_POST['role'];

    $gioitinh = 1;
    if ($gioitinhRaw = "nam") {
        $gioitinh = 0;
    } else {
        $gioitinh = 1;
    }

    if (!isset($_FILES['hinhdaidien']) || $_FILES['hinhdaidien']['error'] !== UPLOAD_ERR_OK) {
        echo "Lỗi khi tải lên hình đại diện.";
    }

    // Xử lý hình đại diện
    if ($_FILES['hinhdaidien']['name']) { //Kiểm tra sự tồn tại của hình ảnh
        $hinhdaidien = basename($_FILES["hinhdaidien"]["name"]); // chỉ lưu tên ảnh
        move_uploaded_file($_FILES["hinhdaidien"]["tmp_name"], "hinhanh/" . $hinhdaidien); //Lấy tên tệp và di chuyển tệp vào hinhanh/
    } else {
        $hinhdaidien = null; // Không có hình ảnh
        echo "<script>alert('Đăng ký thất bại, không có ảnh đại diện!'); window.location.href='index.php';</script>";
    }

    // Kiểm tra username đã tồn tại chưa
    // Kiểm tra nếu tên đăng nhập đã tồn tại
    $queryUser = "SELECT * FROM nguoi_dung WHERE USERNAME = '$username'";
    $resultUser = mysqli_query($conn, $queryUser);

    $queryAdmin = "SELECT * FROM admin WHERE USER_ADMIN = '$username'";
    $resultAdmin = mysqli_query($conn, $queryAdmin);

    if (mysqli_num_rows($resultUser) > 0 || mysqli_num_rows($resultAdmin) > 0) {
        // Tên đăng nhập đã tồn tại
        echo "Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác!";
        echo "<script>alert('Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác!'); window.location.href='index.php';</script>";
        // header("Location: index.php");
    } else {
        // Phân quyền
        if ($role === 'admin') {
            $sql = "INSERT INTO `admin`(`USER_ADMIN`, `PASS_ADMIN`) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $password);
        } else {
            $sql = "INSERT INTO `nguoi_dung`(`USERNAME`, `PASSWORD`, `HOTEN`, `GIOITINH`, `QUOCGIA`, `HINHDAIDIEN`) 
                VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $username, $password, $hoten, $gioitinh, $quocgia, $hinhdaidien);
        }

        // Thực thi truy vấn
        if ($stmt->execute()) {
            echo "<script>alert('Đăng ký thành công!'); window.location.href='index.php';</script>";
        } else {
            echo "Lỗi: " . $stmt->error;
        }
    }
    // Đóng kết nối
    $stmt->close();
    $conn->close();

    // Lưu session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
    // Lưu thông tin vào cookie (thời gian sống là 1 tuần)
    setcookie('username', $username, time() + (86400 * 7), "/");  // Thời gian sống 7 ngày
    setcookie('role', $role, time() + (86400 * 7), "/");  // Thời gian sống 7 ngày
    // Chuyển hướng sau khi đăng ký thành công
    header("Location: index.php");
}
?>