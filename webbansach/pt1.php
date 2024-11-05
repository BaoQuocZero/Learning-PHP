<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Giải Phương Trình Bậc Nhất Một Ẩn</title>
    <style>
    form {
        display: inline-block;
        margin-top: 20px;
    }

    input,
    button {
        margin: 5px;
        padding: 5px;
    }
    </style>
</head>

<body>
    <h3>Giải Phương Trình Bậc Nhất Một Ẩn (ax + b = 0)</h3>
    <form method="post" action="">
        <label>Nhập hệ số a:</label>
        <input type="number" name="a" step="any" required />
        <br />
        <label>Nhập hệ số b:</label>
        <input type="number" name="b" step="any" required />
        <br />
        <button type="submit" name="solve">Giải</button>
    </form>

    <?php
    if (isset($_POST['solve'])) {
        $a = $_POST['a'];
        $b = $_POST['b'];
        
        if ($a == 0) {
            if ($b == 0) {
                echo "<p>Phương trình có vô số nghiệm.</p>";
            } else {
                echo "<p>Phương trình vô nghiệm.</p>";
            }
        } else {
            $x = -$b / $a;
            echo "<p>Nghiệm của phương trình là: x = $x</p>";
        }
    }
    ?>
</body>

</html>