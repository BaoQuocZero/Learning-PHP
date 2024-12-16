<td width="200" valign="top" bgcolor="#92D84E">
    <?php if (isset($_SESSION['nguoidung']) || isset($_SESSION['admin'])): ?>
    <!-- Hiển thị thông tin tài khoản khi đã đăng nhập -->
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th colspan="2">
                <font color="#ff6600">Thông tin tài khoản</font>
            </th>
        </tr>
        <tr>
            <td colspan="2"> <strong><?php 
        if (isset($_SESSION['admin']) && $_SESSION['admin']) {
            // Nếu là admin
            echo "Xin chào quản trị viên: <strong>" . htmlspecialchars($_SESSION['admin']) . "</strong>";
        } elseif (isset($_SESSION['nguoidung'])) {
            // Nếu là người dùng thường
            echo "Xin chào: <strong>" . htmlspecialchars($_SESSION['nguoidung']) . "</strong>";
        } else {
            // Nếu không có thông tin đăng nhập
            echo "Xin chào: <strong>Khách</strong>";
        }
    ?></strong></td>
        </tr>
        <tr>
            
            <?php
            if (isset($_SESSION['nguoidung'])) {
                // Nếu có, hiển thị link "Xem thông tin tài khoản"
                echo '<td colspan="2"><a href="?page=profile">Xem thông tin tài khoản</a></td>';
            }
            ?>
            ?>
            <td colspan="2"><a href="?page=doimatkhau">Đổi mật khẩu</a></td>
        </tr>
        <tr>
            <td colspan="2"><a href="logout.php">Đăng xuất</a></td>
        </tr>
    </table>
    <?php else: ?>
    <!-- Hiển thị form đăng nhập nếu chưa đăng nhập -->
    <form action="xly_dangnhap.php" name="frmDN" method="post">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th colspan="2">
                    <font color="#ff6600">Đăng nhập</font>
                </th>
            </tr>
            <tr>
                <td>Tên đăng nhập:</td>
                <td><input type="text" name="txtTDNhap" size="12" /></td>
            </tr>
            <tr>
                <td>Mật khẩu:</td>
                <td><input type="password" name="pswMKhau" size="12" /></td>
            </tr>
            <tr>
                <td><input type="submit" name="sbmDN" value="Đăng nhập" /></td>
                <td><input type="reset" name="rsHB" value="Hủy bỏ" /></td>
                <td><a href="?page=register">Đăng ký</a></td>
            </tr>
        </table>
    </form>
    <?php endif; ?>
</td>