<!DOCTYPE html>
<html>

<head>
    <title>Tính diện tích</title>
</head>

<body>

    <form method="post" action="">
        <label for="shape">Chọn hình:</label>
        <select name="shape" id="shape" onchange="this.form.submit()">
            <option value="circle" <?php if (isset($_POST['shape']) && $_POST['shape'] == 'circle') echo 'selected'; ?>>
                Hình tròn</option>
            <option value="triangle"
                <?php if (isset($_POST['shape']) && $_POST['shape'] == 'triangle') echo 'selected'; ?>>Hình tam giác
            </option>
            <option value="rectangle"
                <?php if (isset($_POST['shape']) && $_POST['shape'] == 'rectangle') echo 'selected'; ?>>Hình chữ nhật
            </option>
        </select>

        <input type="hidden" name="radius" value="<?php echo isset($_POST['radius']) ? $_POST['radius'] : ''; ?>">
        <input type="hidden" name="base" value="<?php echo isset($_POST['base']) ? $_POST['base'] : ''; ?>">
        <input type="hidden" name="height" value="<?php echo isset($_POST['height']) ? $_POST['height'] : ''; ?>">
        <input type="hidden" name="length" value="<?php echo isset($_POST['length']) ? $_POST['length'] : ''; ?>">
        <input type="hidden" name="width" value="<?php echo isset($_POST['width']) ? $_POST['width'] : ''; ?>">
    </form>

    <?php
$shape = isset($_POST['shape']) ? $_POST['shape'] : 'circle';

switch ($shape) {
    case 'circle':
        ?>
    <form method="post" action="">
        <input type="hidden" name="shape" value="circle">
        <label for="radius">Bán kính:</label>
        <input type="number" name="radius" value="<?php echo isset($_POST['radius']) ? $_POST['radius'] : ''; ?>">
        <br><br>
        <input type="hidden" name="base" value="<?php echo isset($_POST['base']) ? $_POST['base'] : ''; ?>">
        <input type="hidden" name="height" value="<?php echo isset($_POST['height']) ? $_POST['height'] : ''; ?>">
        <input type="hidden" name="length" value="<?php echo isset($_POST['length']) ? $_POST['length'] : ''; ?>">
        <input type="hidden" name="width" value="<?php echo isset($_POST['width']) ? $_POST['width'] : ''; ?>">
        <input type="submit" name="calculate" value="Tính diện tích">
    </form>
    <?php
        break;

    case 'triangle':
        ?>
    <form method="post" action="">
        <input type="hidden" name="shape" value="triangle">
        <label for="base">Cạnh đáy:</label>
        <input type="number" name="base" value="<?php echo isset($_POST['base']) ? $_POST['base'] : ''; ?>">
        <br>
        <label for="height">Chiều cao:</label>
        <input type="number" name="height" value="<?php echo isset($_POST['height']) ? $_POST['height'] : ''; ?>">
        <br><br>
        <input type="hidden" name="radius" value="<?php echo isset($_POST['radius']) ? $_POST['radius'] : ''; ?>">
        <input type="hidden" name="length" value="<?php echo isset($_POST['length']) ? $_POST['length'] : ''; ?>">
        <input type="hidden" name="width" value="<?php echo isset($_POST['width']) ? $_POST['width'] : ''; ?>">
        <input type="submit" name="calculate" value="Tính diện tích">
    </form>
    <?php
        break;

    case 'rectangle':
        ?>
    <form method="post" action="">
        <input type="hidden" name="shape" value="rectangle">
        <label for="length">Chiều dài:</label>
        <input type="number" name="length" value="<?php echo isset($_POST['length']) ? $_POST['length'] : ''; ?>">
        <br>
        <label for="width">Chiều rộng:</label>
        <input type="number" name="width" value="<?php echo isset($_POST['width']) ? $_POST['width'] : ''; ?>">
        <br><br>
        <input type="hidden" name="radius" value="<?php echo isset($_POST['radius']) ? $_POST['radius'] : ''; ?>">
        <input type="hidden" name="base" value="<?php echo isset($_POST['base']) ? $_POST['base'] : ''; ?>">
        <input type="hidden" name="height" value="<?php echo isset($_POST['height']) ? $_POST['height'] : ''; ?>">
        <input type="submit" name="calculate" value="Tính diện tích">
    </form>
    <?php
        break;
}

if (isset($_POST['calculate'])) {
    switch ($shape) {
        case 'circle':
            $radius = $_POST['radius'];
            if ($radius > 0) {
                $area = pi() * pow($radius, 2);
                echo "Diện tích hình tròn là: " . $area;
            } else {
                echo "Vui lòng nhập bán kính hợp lệ.";
            }
            break;

        case 'triangle':
            $base = $_POST['base'];
            $height = $_POST['height'];
            if ($base > 0 && $height > 0) {
                $area = 0.5 * $base * $height;
                echo "Diện tích hình tam giác là: " . $area;
            } else {
                echo "Vui lòng nhập cạnh đáy và chiều cao hợp lệ.";
            }
            break;

        case 'rectangle':
            $length = $_POST['length'];
            $width = $_POST['width'];
            if ($length > 0 && $width > 0) {
                $area = $length * $width;
                echo "Diện tích hình chữ nhật là: " . $area;
            } else {
                echo "Vui lòng nhập chiều dài và chiều rộng hợp lệ.";
            }
            break;
    }
}
?>

</body>

</html>