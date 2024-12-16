<?php include 'header.php'; ?>

<h1>Trang đăng ký thành viên</h1>
<form enctype="multipart/form-data" action="xly_dangky.php" name="frmdk" method="post">
    <table>
        <tr>
            <td>Tên đăng nhập:</td>
            <td><input type="text" name="tendn" required></td>
        </tr>
        <tr>
            <td>Mật khẩu:</td>
            <td><input type="password" name="matkhau" required></td>
        </tr>
        <tr>
            <td>Họ tên:</td>
            <td><input type="text" name="hoten" required></td>
        </tr>
        <tr>
            <td>Giới tính:</td>
            <td><input type="radio" name="gioitinh" value="0" required>Nam &nbsp;&nbsp; <input type="radio" name="gioitinh" value="1">Nữ</td>
        </tr>
        <tr>
            <td>Quốc gia:</td>
            <td><select name="quocgia" required>
                <option value="vn" selected="selected">Viet Nam</option>
                <option value="cn">China</option>
                <option value="jp">Japan</option>
                <option value="k">Khác</option>
            </select></td>
        </tr>
        <tr>
            <td>Ảnh đại diện:</td>
            <td><input type="hidden" name="MAX_FILE_SIZE" value="10000000">
            <input type="file" name="hinhanh" accept="image/jpeg, image/png, image/gif" required></td>
        </tr>
        <tr>
            <td><input type="submit" name="dangky" value="Đăng Ký"></td>
            <td><input type="reset" name="lamlai" value="Làm lại"></td>
        </tr>
    </table>
</form>

<?php include 'footer.php'; ?>
