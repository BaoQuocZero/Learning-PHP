<?php 
//session_start(); 
if (!isset($_SESSION["admin"])) {
    echo "<script language='javascript'>
        alert('Bạn không có quyền trên trang này!');
        window.location='dangnhapQT.php';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
</head>

<body>
    <table align="center" border="1" style="width: 80%; border-collapse: collapse;">
        <tr bgcolor="#CCCCCC">
            <td align="right" colspan="8">
                Xin chào, <strong><?php echo htmlspecialchars($_SESSION["admin"]); ?></strong>
                &nbsp;&nbsp;| <a href="thoatQT.php">Thoát</a>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="8">
                <h3>THÔNG TIN NGƯỜI DÙNG</h3>
            </td>
        </tr>
        <tr>
            <th>Tên đăng nhập</th>
            <th>Mật khẩu</th>
            <th>Họ và tên</th>
            <th>Giới tính</th>
            <th>Quốc gia</th>
            <th>Hình đại diện</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>

        <?php
       $kn = new mysqli("localhost", "root", "", "online_shop");

       // Kiểm tra kết nối
       if ($kn->connect_error) {
           die("Kết nối thất bại: " . $kn->connect_error);
       }
       

        if (isset($_GET['delete'])) {
                $id_sach = $_GET['delete'];
                $stmt = $conn->prepare("DELETE FROM nguoi_dung WHERE USERNAME=?");
                $stmt->bind_param("i",  htmlspecialchars($row["USERNAME"]));
                $stmt->execute();
                $stmt->close();
            }


       // Thiết lập mã hóa ký tự UTF-8
       $kn->set_charset("utf8");

        // Truy vấn thông tin người dùng
        $sql = "SELECT * FROM nguoi_dung";
        $result = $kn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Lấy thông tin từ cơ sở dữ liệu
                $username = htmlspecialchars($row["USERNAME"]);
                $password = htmlspecialchars($row["PASSWORD"]);
                $hoten = htmlspecialchars($row["HOTEN"]);
                $gioitinh = htmlspecialchars($row["GIOITINH"]);
                $quocgia = htmlspecialchars($row["QUOCGIA"]);
                $hinhdaidien = htmlspecialchars($row["HINHDAIDIEN"]);
                ?>
        <tr>
            <td><?php echo $username; ?></td>
            <td><?php echo $password; ?></td>
            <td><?php echo $hoten; ?></td>
            <td><?php echo $gioitinh; ?></td>
            <td><?php echo $quocgia; ?></td>
            <td>
                <?php if (!empty($hinhdaidien)): ?>
                <img src="<?php echo $hinhdaidien; ?>" alt="Hình đại diện" height="50" width="50">
                <?php else: ?>
                Không có hình
                <?php endif; ?>
            </td>
            <td><a href="sua.php?edit=<?php echo urlencode($username); ?>">Sửa</a></td>
            <td><a href="xoa.php?delete=<?php echo urlencode($username); ?>"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a></td>
        </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='8' align='center'>Không có dữ liệu</td></tr>";
        }
        ?>
    </table>
</body>

</html>