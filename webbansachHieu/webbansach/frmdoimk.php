<?php include 'header.php'; ?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["nguoidung"])) {
    echo "<script>alert('Bạn chưa đăng nhập!'); window.location='dangky.php';</script>";
    exit();
}
?>
    <h2>Thay đổi mật khẩu</h2>
    <form method="POST" action="xuly_doimk.php">
    <table>
        <tr><td>
        <label for="matkhau_cu">Mật khẩu cũ:</label>
        <input type="password" id="matkhau_cu" name="matkhau_cu" required></td>
        </tr>
        
        <tr>
            <td><label for="matkhau_moi">Mật khẩu mới:</label>
            <input type="password" id="matkhau_moi" name="matkhau_moi" required><br><br></td>
        </tr>
        <tr>
            <td><label for="matkhau_moi_confirm">Xác nhận mật khẩu mới:</label>
            <input type="password" id="matkhau_moi_confirm" name="matkhau_moi_confirm" required><br><br>
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="Thay đổi mật khẩu"></td>
        </tr>
    </table>    
    </form>
<?php include 'footer.php'; ?>