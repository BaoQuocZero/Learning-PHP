<?php session_start();
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
</head>

<body>
    <?php
session_start();

// Kết nối MySQL sử dụng MySQLi
$kn = new mysqli("localhost", "root", "", "online_shop");

// Kiểm tra kết nối
if ($kn->connect_error) {
    die("Kết nối thất bại: " . $kn->connect_error);
}

// Cấu hình mã hóa
$kn->set_charset("utf8");

// Lấy dữ liệu từ form
$tdn = $_POST["tendn"];
$mk = md5($_POST["matkhau"]);
$ht = $_POST["hoten"];
$gt = $_POST["gioitinh"];
$qg = $_POST["quocgia"];

// Kiểm tra tên đăng nhập đã tồn tại
$stmt = $kn->prepare("SELECT * FROM nguoi_dung WHERE username = ?");
$stmt->bind_param("s", $tdn);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo "<script language=javascript>
    alert('Đã có tên đăng nhập này. Bạn hãy chọn tên đăng nhập khác!'); 
    window.location='dangky.php';
    </script>";
    exit();
}

// Mã hóa mật khẩu


// Xử lý file hình ảnh
$duongdan = "hinhanh/";
if (isset($_FILES["hinhanh"]) && $_FILES["hinhanh"]["error"] == 0) {
    $file_name = basename($_FILES["hinhanh"]["name"]);
    $duongdan .= $file_name;
    $file_tam = $_FILES["hinhanh"]["tmp_name"];
    
    // Kiểm tra loại tệp (chỉ cho phép hình ảnh)
    $allowed_types = ["image/jpeg", "image/png", "image/gif"];
    if (in_array($_FILES["hinhanh"]["type"], $allowed_types)) {
        move_uploaded_file($file_tam, $duongdan);
    } else {
        echo "Chỉ cho phép tải lên tệp hình ảnh!";
        exit();
    }
} else {
    echo "Vui lòng chọn một tệp hình ảnh để tải lên!";
    exit();
}

// Thực hiện câu lệnh INSERT
$stmt = $kn->prepare("INSERT INTO nguoi_dung (USERNAME, PASSWORD, HOTEN, GIOITINH, QUOCGIA, HINHDAIDIEN) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $tdn, $mk, $ht, $gt, $qg, $duongdan);

if ($stmt->execute()) {
    $_SESSION["nguoidung"] = $tdn;
    echo "<script language=javascript>
    alert('Đăng ký thành công'); 
    window.location='index.php';
    </script>";
} else {
    echo "Đã xảy ra lỗi khi đăng ký. Vui lòng thử lại!";
}

// Đóng kết nối
$stmt->close();
$kn->close();
?>

</body>

</html>