<?php
include("header.php")
?>

<body>
    <form name="frmChao" action="xly.php" method="post">
        <table align="center">
            <tr>
                <td>Nhập tên: </td>
                <td><input type="text" name="txtTen" /></td>
            </tr>
            <tr>
                <td>Nhập tuổi: </td>
                <td><input type="number" name="txtTuoi" /></td>
            </tr>
            <tr>
                <td><input type="submit" name="sbmXem" value="Xem KQ" /></td>
                <td><input type="reset" name="rsHuy" value="Hủy bỏ" /></td>
            </tr>
        </table>
    </form>
</body>

<?php
include("footer.php")
?>