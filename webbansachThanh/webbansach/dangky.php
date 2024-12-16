<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <h1 align="center">Trang đăng ký thành viên</h1>
    <form enctype="multipart/form-data" action="xly_dangky.php" name="frmdk" method="post">
        <table align="center">
            <tr>
                <td>Tên đăng nhập: </td>
                <td><input type="text" name="tendn" /></td>
            </tr>
            <tr>
                <td>Mật khẩu: </td>
                <td><input type="password" name="matkhau" /></td>
            </tr>
            <tr>
                <td>Họ tên: </td>
                <td><input type="text" name="hoten" /></td>
            </tr>
            <tr>
                <td>Giới tính: </td>
                <td><input type="radio" name="gioitinh" value="Nam" /> Nam &nbsp;&nbsp; <input type="radio"
                        name="gioitinh" value="Nữ" /> Nữ</td>
            </tr>
            <tr>
                <td>Quốc gia: </td>
                <td><select name="quocgia">
                        <option value="vn" selected="selected"> Viet Nam </option>
                        <option value="cn">China</option>
                        <option value="jp">Japan </option>



                </td>
            </tr>
            <tr>

                <option value="k"> Khác</option>
                </select>

                <td>Ảnh đại diện: </td>
                <td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                    <input type="file" name="hinhanh" />
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="dangky" value="Đăng Ký" /></td>
                <td><input type="reset" name="lamlai" value="Làm lại" /></td>
            </tr>
        </table>
    </form>
</body>

</html>