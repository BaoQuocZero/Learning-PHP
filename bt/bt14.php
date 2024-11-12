<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập số</title>
</head>

<body>
    <center>
        <h1>Nhập số để xuất các số nguyên tố</h1>
        <table align="center">
            <form method="POST" action="">
                <label for="number">Nhập một số:</label>
                <input type="number" id="number" name="number" min="2" required>
                <button type="submit">Xuất số nguyên tố</button>
            </form>
        </table>
    </center>

    <?php
// Hàm kiểm tra số nguyên tố
function isPrime($num) {
    if ($num < 2) return false;
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i == 0) return false;
    }
    return true;
}

// Hàm lấy các số nguyên tố
function getPrimes($limit) {
    $primes = [];
    for ($i = 2; $i <= $limit; $i++) {
        if (isPrime($i)) {
            $primes[] = $i;
        }
    }
    return $primes;
}

// Xử lý khi biểu mẫu được gửi
$inputNumber = isset($_POST['number']) ? (int)$_POST['number'] : 0;

if ($inputNumber >= 2) {
    $primes = getPrimes($inputNumber);
} else {
    $primes = [];
}
?>

    <?php if ($inputNumber >= 2): ?>
    <center>
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
        <a href="">Nhập lại số khác</a>
    </center>
    <?php endif; ?>

</body>

</html>