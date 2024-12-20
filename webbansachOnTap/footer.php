<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : null;
$role = isset($_COOKIE['role']) ? $_COOKIE['role'] : null;
?>
<td width="200" valign="top" bgcolor="#92D84E">
    <?php if (isset($_SESSION['username'])): ?>
    <!-- Hiển thị thông tin tài khoản khi đã đăng nhập -->
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th colspan="2">
                <font color="#ff6600">Thông tin tài khoản</font>
            </th>
        </tr>
        <tr>
            <td colspan="2">Xin chào:
                <strong><?php echo htmlspecialchars($_SESSION['role']); ?>: </strong>
                <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
            </td>
        </tr>
        <tr>
            <td colspan="2">Xin chào bằng cookie:
                <strong><?php echo htmlspecialchars($role); ?>: </strong>
                <strong><?php echo htmlspecialchars($username); ?></strong>
            </td>
        </tr>
        <tr>
            <td colspan="2"><a href="ThongTinUser.php">Xem thông tin tài khoản</a></td>
        </tr>
        <tr>
            <td colspan="2"><a href="DoiMatKhau.php">Đổi mật khẩu</a></td>
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
                <!-- <td><input type="reset" name="rsHB" value="Hủy bỏ" /></td> -->
                <td><a href="?page=dangKy" class="btn btn-success btn-sm">Đăng ký</a></td>
            </tr>
        </table>
    </form>
    <?php endif; ?>
</td>
<tr bgcolor="#92D84E">
    <td colspan="3" align="center">
        CopyRight&copy; sachhay.com <br />
        Design by TrucMaiPham
    </td>
</tr>