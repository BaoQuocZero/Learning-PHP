<?php
//session_start();

// Kiểm tra nếu người dùng chưa đăng nhập
// if (!isset($_SESSION["admin"]) || !isset($_SESSION["nguoidung"])) {
//     echo "<script language=javascript>
//         alert('Bạn không có quyền trên trang này!'); 
//         window.location='dangky.php';
//     </script>";
//     exit();
// }

$kn = new mysqli("localhost", "root", "", "online_shop");

// Kiểm tra kết nối
if ($kn->connect_error) {
    die("Kết nối thất bại: " . $kn->connect_error);
}

// Thiết lập mã hóa ký tự UTF-8
$kn->set_charset("utf8");

$user = $_SESSION["nguoidung"];

// Sử dụng Prepared Statements để bảo mật SQL Injection
$stmt = $kn->prepare("SELECT * FROM nguoi_dung WHERE USERNAME = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra xem người dùng có tồn tại không
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Không tìm thấy thông tin người dùng!";
    exit();
}

?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Thông tin cá nhân</title>
</head>

<body>
    <table align="center" border="1" cellpadding="10" cellspacing="0">
        <tr bgcolor="#CCCCCC">
            <td align="right">
                Xin chào <?php echo $_SESSION["nguoidung"]; ?> &nbsp;&nbsp;|
                <a href="thoat.php">Thoát</a>
            </td>
        </tr>
        <tr>
            <td><strong>THÔNG TIN CỦA BẠN</strong></td>
        </tr>
        <tr>
            <td>Họ và tên: <?php echo htmlspecialchars($row["HOTEN"]); ?></td>
        </tr>
        <tr>
        <td>Giới tính: <?php echo $row["GIOITINH"]; ?></td>
        </tr>
        <tr>
            <td>Thuộc quốc tịch: <?php echo htmlspecialchars($row["QUOCGIA"]); ?></td>
        </tr>
        <tr>
            <td>Ảnh đại diện:
                <?php 
                // Kiểm tra xem có ảnh đại diện không
                if (!empty($row["HINHDAIDIEN"]) && file_exists($row["HINHDAIDIEN"])) {
                    echo '<img src="' . htmlspecialchars($row["HINHDAIDIEN"]) . '" alt="Ảnh đại diện" width="100" height="100">';
                } else {
                    echo "Không có ảnh đại diện";
                }
                ?>
            </td>
            <td><a href="sua.php?edit=<?php echo $row["USERNAME"]; ?>">Sửa</a></td>


        </tr>
    </table>
</body>

</html>

<?php
// Đóng kết nối MySQLi
$stmt->close();
$kn->close();
?>