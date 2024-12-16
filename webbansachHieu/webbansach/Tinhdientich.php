<?php
include("header.php")
?>
    <h2>Tính Diện Tích</h2>
    <form method="post" action="">
        <label>
            <input type="radio" name="shape" value="circle" <?php if (isset($_POST['shape']) && $_POST['shape'] == 'circle')
                echo 'checked'; ?>> Đường tròn
        </label><br>
        <label>
            <input type="radio" name="shape" value="triangle" <?php if (isset($_POST['shape']) && $_POST['shape'] == 'triangle')
                echo 'checked'; ?>> Tam giác
        </label><br>
        <label>
            <input type="radio" name="shape" value="rectangle" <?php if (isset($_POST['shape']) && $_POST['shape'] == 'rectangle')
                echo 'checked'; ?>> Chữ nhật
        </label><br><br>

        <div>
            <?php
            if (isset($_POST['shape']) && $_POST['shape'] == 'circle') {
                $radius = isset($_POST['radius']) ? $_POST['radius'] : '';
                echo '<label>Bán kính đường tròn:</label>';
                echo '<input type="number" name="radius" value="' . $radius . '">';
            } elseif (isset($_POST['shape']) && $_POST['shape'] == 'triangle') {
                $base = isset($_POST['base']) ? $_POST['base'] : '';
                $height = isset($_POST['height']) ? $_POST['height'] : '';
                echo '<label>Cạnh đáy:</label>';
                echo '<input type="number" name="base" value="' . $base . '"><br>';
                echo '<label>Chiều cao:</label>';
                echo '<input type="number" name="height" value="' . $height . '">';
            } elseif (isset($_POST['shape']) && $_POST['shape'] == 'rectangle') {
                $length = isset($_POST['length']) ? $_POST['length'] : '';
                $width = isset($_POST['width']) ? $_POST['width'] : '';
                echo '<label>Chiều dài:</label>';
                echo '<input type="number" name="length" value="' . $length . '"><br>';
                echo '<label>Chiều rộng:</label>';
                echo '<input type="number" name="width" value="' . $width . '">';
            }
            ?>
        </div><br>

        <input type="submit" name="submit" value="xác nhận">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        if (isset($_POST['shape'])) {
            $shape = $_POST['shape'];
            switch ($shape) {
                case 'circle':
                    if (isset($_POST['radius']) && is_numeric($_POST['radius'])) {
                        $radius = $_POST['radius'];
                        $area = pi() * pow($radius, 2);
                        echo "<p>Diện tích đường tròn: " . round($area, 2) . "</p>";
                    } else {
                        echo "<p>Vui lòng nhập bán kính hợp lệ!</p>";
                    }
                    break;

                case 'triangle':
                    if (isset($_POST['base']) && isset($_POST['height']) && is_numeric($_POST['base']) && is_numeric($_POST['height'])) {
                        $base = $_POST['base'];
                        $height = $_POST['height'];
                        $area = 0.5 * $base * $height;
                        echo "<p>Diện tích tam giác: " . round($area, 2) . "</p>";
                    } else {
                        echo "<p>Vui lòng nhập cạnh đáy và chiều cao hợp lệ!</p>";
                    }
                    break;

                case 'rectangle':
                    if (isset($_POST['length']) && isset($_POST['width']) && is_numeric($_POST['length']) && is_numeric($_POST['width'])) {
                        $length = $_POST['length'];
                        $width = $_POST['width'];
                        $area = $length * $width;
                        echo "<p>Diện tích chữ nhật: " . round($area, 2) . "</p>";
                    } else {
                        echo "<p>Vui lòng nhập chiều dài và chiều rộng hợp lệ!</p>";
                    }
                    break;

                default:
                    echo "<p>Vui lòng chọn một hình để tính diện tích!</p>";
            }
        } else {
            echo "<p>Vui lòng chọn một hình để tính diện tích!</p>";
        }
    }
    ?>
<?php
include("footer.php")
?>