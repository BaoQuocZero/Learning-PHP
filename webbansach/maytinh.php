<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Máy Tính Cơ Bản</title>
    <style>
    form {
        display: inline-block;
        margin-top: 20px;
    }

    input,
    select {
        margin: 5px;
        padding: 5px;
    }
    </style>
</head>

<body>
    <h3>Máy Tính Cơ Bản</h3>
    <form method="post" action="">
        <input type="number" name="num1" placeholder="Số thứ nhất" required />
        <select name="operation">
            <option value="add">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
        </select>
        <input type="number" name="num2" placeholder="Số thứ hai" required />
        <button type="submit" name="calculate">Tính</button>
    </form>

    <?php
    if (isset($_POST['calculate'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operation = $_POST['operation'];
        $result = null;

        switch ($operation) {
            case 'add':
                $result = $num1 + $num2;
                break;
            case 'subtract':
                $result = $num1 - $num2;
                break;
            case 'multiply':
                $result = $num1 * $num2;
                break;
            case 'divide':
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    $result = "Lỗi: Không thể chia cho 0";
                }
                break;
        }

        echo "<p>Kết quả: $result</p>";
    }
    ?>
</body>

</html>