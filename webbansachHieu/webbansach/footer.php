</div>
</td>

<?php
if (isset($_SESSION["nguoidung"])) {
    echo "<div>";
    echo "Chào " . $_SESSION["nguoidung"] . "<br>";
    echo "<a href='trangtt_canhan.php'>Xem tttk</a><br>";
    echo "<a href='thoat.php'>Đăng Xuất</a><br>";
    echo "<a href='giohang.php'>Giỏ hàng</a><br>";
    echo "</div>";
} else {
    echo '<div class="login">
        <h3>Đăng nhập</h3>
        <form action="xly_dangnhap.php" method="POST">
            <input type="text" name="tendn" placeholder="Tên đăng nhập"> 
            <input type="password" name="matkhau" placeholder="Mật khẩu"> 
            <button type="submit" name="sbmDangNhap">Đăng nhập</button>
        </form>
        <form action="dangky.php" method="POST">
            <button type="submit" name="sbmDangKy">Đăng ky</button>
        </form>
        <form action="dangnhap_ad.php" method="POST">
            <button type="submit" name="sbmDangNhapAd">Đăng Nhập QTV</button>
        </form>
      </div>';
}
?>

    
</div>

<!-- Footer -->
<div class="footer">CopyRight sachhay.com<br> design by Hiếu DZ</div>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
