<?php
require 'SNT.php';
$inputNumber = isset($_POST['number']) ? (int)$_POST['number'] : 0;

if ($inputNumber >= 2) {
    $primes = getPrimes($inputNumber);
} else {
    $primes = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả số nguyên tố</title>
</head>

<body>
    <CENTER>
    <h1>Kết quả các số nguyên tố từ 2 đến <?php echo $inputNumber; ?>:</h1>

    <?php if (!empty($primes)): ?>
        <p>
            <?php 
            foreach ($primes as $index => $prime) {
                if (($index + 1) % 2 != 0) {
                    echo "<span style='color: red;'>$prime</span> ";
                } else {
                    echo "$prime ";
                }
            }
            ?>
        </p>
    <?php else: ?>
        <p>Không có số nguyên tố nào được tìm thấy hoặc số bạn nhập không hợp lệ.</p>
    <?php endif; ?>
    <a href="BT8.php">Nhập lại số khác</a>
    </CENTER>
</body>
</html>
