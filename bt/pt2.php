<!DOCTYPE html>
<html>

<head>
    <title>Giải phương trình bậc II</title>
</head>

<body>
    <h2>Giải phương trình bậc II: ax² + bx + c = 0</h2>
    <form method="post">
        <label>Nhập a:</label>
        <input type="number" name="a" required><br><br>

        <label>Nhập b:</label>
        <input type="number" name="b" required><br><br>

        <label>Nhập c:</label>
        <input type="number" name="c" required><br><br>

        <input type="submit" name="solve" value="Giải">
    </form>

    <?php
    if (isset($_POST['solve'])) {
        $a = $_POST['a'];
        $b = $_POST['b'];
        $c = $_POST['c'];

        if ($a == 0) {
            echo "<p>Phương trình không phải bậc hai.</p>";
        } else {
            $delta = $b * $b - 4 * $a * $c;
            if ($delta < 0) {
                echo "<p>Phương trình vô nghiệm.</p>";
            } elseif ($delta == 0) {
                $x = -$b / (2 * $a);
                echo "<p>Phương trình có nghiệm kép: x = $x</p>";
            } else {
                $x1 = (-$b + sqrt($delta)) / (2 * $a);
                $x2 = (-$b - sqrt($delta)) / (2 * $a);
                echo "<p>Phương trình có hai nghiệm phân biệt: x1 = $x1, x2 = $x2</p>";
            }
        }
    }
    ?>
</body>

</html>