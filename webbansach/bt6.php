<!DOCTYPE html>
<html>

<head>
    <title>Tính số ngày trong tháng</title>
</head>

<body>
    <h2>Tính số ngày trong tháng</h2>
    <form method="post">
        <label>Nhập tháng:</label>
        <input type="number" name="month" min="1" max="12" required>
        <br><br>
        <label>Nhập năm:</label>
        <input type="number" name="year" min="1" required>
        <br><br>
        <input type="submit" name="calculate" value="Tính số ngày">
    </form>

    <?php
    if (isset($_POST['calculate'])) {
        $month = $_POST['month'];
        $year = $_POST['year'];
        
        // Kiểm tra xem tháng và năm hợp lệ
        if ($month >= 1 && $month <= 12 && $year >= 1) {
            // Hàm cal_days_in_month() tính số ngày trong tháng cho năm và tháng đã cho
            $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            echo "<p>Tháng $month năm $year có $days ngày.</p>";
        } else {
            echo "<p>Vui lòng nhập tháng và năm hợp lệ.</p>";
        }
    }
    ?>
</body>

</html>