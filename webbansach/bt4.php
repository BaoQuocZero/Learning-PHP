<!DOCTYPE html>
<html>

<head>
    <title>Tính diện tích</title>
</head>

<body>
    <h2>Tính diện tích các hình</h2>
    <form method="post">
        <label>Chọn hình:</label>
        <select name="shape" onchange="this.form.submit()">
            <option value="">--Chọn hình--</option>
            <option value="circle" <?php if(isset($_POST['shape']) && $_POST['shape'] == 'circle') echo 'selected'; ?>>
                Hình tròn</option>
            <option value="rectangle"
                <?php if(isset($_POST['shape']) && $_POST['shape'] == 'rectangle') echo 'selected'; ?>>Hình chữ nhật
            </option>
            <option value="triangle"
                <?php if(isset($_POST['shape']) && $_POST['shape'] == 'triangle') echo 'selected'; ?>>Hình tam giác
            </option>
        </select>
    </form>

    <?php
    if (isset($_POST['shape'])) {
        $shape = $_POST['shape'];
        switch ($shape) {
            case 'circle':
                echo '<form method="post">
                        <input type="hidden" name="shape" value="circle">
                        <label>Bán kính:</label>
                        <input type="number" name="radius" required>
                        <input type="submit" name="calculate" value="Tính diện tích">
                      </form>';
                break;
            case 'rectangle':
                echo '<form method="post">
                        <input type="hidden" name="shape" value="rectangle">
                        <label>Chiều dài:</label>
                        <input type="number" name="length" required>
                        <br><br>
                        <label>Chiều rộng:</label>
                        <input type="number" name="width" required>
                        <input type="submit" name="calculate" value="Tính diện tích">
                      </form>';
                break;
            case 'triangle':
                echo '<form method="post">
                        <input type="hidden" name="shape" value="triangle">
                        <label>Chiều cao:</label>
                        <input type="number" name="height" required>
                        <br><br>
                        <label>Đáy:</label>
                        <input type="number" name="base" required>
                        <input type="submit" name="calculate" value="Tính diện tích">
                      </form>';
                break;
        }
    }

    if (isset($_POST['calculate'])) {
        $shape = $_POST['shape'];
        switch ($shape) {
            case 'circle':
                $radius = $_POST['radius'];
                $area = pi() * pow($radius, 2);
                echo "<p>Diện tích hình tròn là: $area</p>";
                break;
            case 'rectangle':
                $length = $_POST['length'];
                $width = $_POST['width'];
                $area = $length * $width;
                echo "<p>Diện tích hình chữ nhật là: $area</p>";
                break;
            case 'triangle':
                $height = $_POST['height'];
                $base = $_POST['base'];
                $area = 0.5 * $base * $height;
                echo "<p>Diện tích hình tam giác là: $area</p>";
                break;
        }
    }
    ?>
</body>

</html>