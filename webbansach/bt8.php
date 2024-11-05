<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin người dùng</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Xử lý khi người dùng đã submit form
        $ten = $_POST["txtTen"];
        $tuoi = $_POST["txtTuoi"];
        $nam = date("Y");

        if ($ten && $tuoi && $tuoi >= 0) {
            echo "<p>Chào bạn $ten</p>";
            echo "<p>Tên bạn dài " . strlen($ten) . " ký tự</p>";
            echo "<p>Vậy là bạn đã $tuoi tuổi rồi.</p>";

            $nam_sinh = $nam - $tuoi;
            if ((($nam_sinh % 4 == 0) && ($nam_sinh % 100 != 0)) || ($nam_sinh % 400 == 0)) {
                echo "<p>Bạn sinh năm nhuần $nam_sinh</p>";
            } else {
                echo "<p>Bạn sinh năm $nam_sinh không phải năm nhuận</p>";
            }
        } else {
            echo "<p>Bạn chưa nhập đủ thông tin hoặc thông tin không đúng</p>";
        }
    } else {
        // Hiển thị form nếu chưa có dữ liệu POST
        ?>
    <form name="frmChao" method="post">
        <table align="center">
            <tr>
                <td>Nhập tên: </td>
                <td><input type="text" name="txtTen" required /></td>
            </tr>
            <tr>
                <td>Nhập tuổi: </td>
                <td><input type="number" name="txtTuoi" min="0" required /></td>
            </tr>
            <tr>
                <td><input type="submit" name="sbmXem" value="Xem KQ" /></td>
                <td><input type="reset" name="rsHuy" value="Hủy bỏ" /></td>
            </tr>
        </table>
    </form>
    <?php
    }
    ?>
</body>

</html>