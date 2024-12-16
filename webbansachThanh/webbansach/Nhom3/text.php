<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng Cửu Chương</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h2 {
            font-size: 2em;
            margin-bottom: 20px;
        }
        .table-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .table-column {
            margin: 10px;
            padding: 15px;
            border: 3px solid;
            border-radius: 8px;
            background-color: #fff;
            min-width: 150px;
            text-align: left;
        }
        .table-column:nth-child(even) {
            background-color: #00FFFF; 
            color: red;
        }
        
        td {
            padding: 5px;
            font-size: 1.2em;
        }
    </style>
</head>
<body>

    <h2>Bảng Cửu Chương</h2>

    <form method="POST" action="">
        <label for="number">Nhập số:</label>
        <input type="number" id="number" name="number" min="1" required>
        <input type="submit" value="Hiển thị bảng cửu chương">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $n = (int)$_POST["number"];
        echo "<div class='table-container'>";
        
        for ($i = 1; $i <= $n; $i++) {
            echo "<div class='table-column'>";
            echo "<h3>Bảng cửu chương $i</h3>";
            echo "<table>";
            
            for ($j = 1; $j <= 10; $j++) {
                $result = $i * $j;
                $class = ($result % 2 == 0) ? 'class="even"' : '';
                echo "<tr><td>$i x $j =</td><td $class>$result</td></tr>";
            }
            echo "</table>";
            echo "</div>";
        }

        echo "</div>";
    }
    ?>

</body>
</html>
