<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng Cửu Chương</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color:#6699CC;
        }
        .even {
            background-color: #f9f9f9;
        }
        .odd {
            background-color:#99CCFF;
        }
    </style>
</head>
<body>

<h1> BẢNG CỬU CHƯƠNG</h1>
<form method="POST" action="">
    <label for="number">Nhập số:</label>
    <input type="number" id="number" name="number" min="1" required>
    <button type="submit">OK</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = intval($_POST['number']);

    if ($number > 0) {
        echo "<h2>Bảng cửu chương từ 1 đến $number</h2>";     
        echo "<table>";
        echo "<tr>";

        echo "</tr>";

        for ($j = 1; $j <= 10; $j++) {
            echo "<tr>";
           
            for ($i = 1; $i <= $number; $i++) {
                
                $class = (($i + $j) % 2 == 0) ? 'even' : 'odd';
                echo "<td class='$class'>" . $i . " x " . $j . " = " . ($i * $j) . "</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Vui lòng nhập số nguyên dương lớn hơn 0.</p>";
    }
}
?>

</body>
</html>