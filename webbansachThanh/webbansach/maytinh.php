<?php
// Khởi tạo biến kết quả
$result = "";

// Kiểm tra nếu người dùng đã gửi form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị của các số từ form
    $num1 = isset($_POST['num1']) ? $_POST['num1'] : 0;
    $num2 = isset($_POST['num2']) ? $_POST['num2'] : 0;
    $operation = isset($_POST['operation']) ? $_POST['operation'] : '';

    // Thực hiện phép tính tùy theo lựa chọn
    if ($operation == 'add') {
        $result = $num1 + $num2;
    } elseif ($operation == 'subtract') {
        $result = $num1 - $num2;
    }
}
?>

<h2>Máy tính Cộng Trừ 2 Số</h2>

<!-- Form nhập số và chọn phép toán -->
<form method="POST" action="">
    <label for="num1">Số thứ nhất:</label>
    <input type="number" id="num1" name="num1" required><br><br>

    <label for="num2">Số thứ hai:</label>
    <input type="number" id="num2" name="num2" required><br><br>

    <label for="operation">Chọn phép toán:</label><br>
    <input type="radio" id="add" name="operation" value="add" required>
    <label for="add">Cộng</label><br>
    <input type="radio" id="subtract" name="operation" value="subtract" required>
    <label for="subtract">Trừ</label><br><br>

    <input type="submit" value="Tính">
</form>

<!-- Hiển thị kết quả -->
<?php if ($result !== ""): ?>
    <h3>Kết quả: <?php echo $result; ?></h3>
<?php endif; ?>
