<?php
$result = "";
$num1 = isset($_POST['num1']) ? $_POST['num1'] : 1;
$num2 = isset($_POST['num2']) ? $_POST['num2'] : 0;

if ($num1 != 0) {
    // Nếu num1 không phải 0, thực hiện phép tính
    $result = $num2 * -1 / $num1;
} else {
    // Nếu num1 là 0, hiển thị thông báo lỗi
    $result = "Không thể chia cho 0!";
}
?>

<h2>Máy tính kết quả phương trình bậc 1</h2>
<h3>ax + b = 0 </h3>
<form method="POST" action="">
    <label for="num1">Nhập a:</label>
    <input type="number" id="num1" name="num1" required><br><br>

    <label for="num2">Nhập b:</label>
    <input type="number" id="num2" name="num2" required><br><br>

    

    <input type="submit" value="Tính">
</form>
<?php if ($result !== ""): ?>
    <h3>Kết quả: <?php echo $result; ?></h3>
<?php endif; ?>