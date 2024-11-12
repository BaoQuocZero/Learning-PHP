<!DOCTYPE html>
<html>

<head>
    <style>
    .odd {
        background-color: #FFBE98;
    }

    table {
        border-collapse: collapse;
    }

    td {
        border: 1px solid black;
        padding: 5px;
    }
    </style>
</head>

<body>
    <form method="post">
        Nhập số: <input type="number" name="soNhap" min="1">
        <input type="submit" value="Hiển thị">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $soNhap = $_POST["soNhap"];
        echo "<h2>Bảng cửu chương từ 1 đến $soNhap</h2>";
        echo "<table>";
        for ($j = 1; $j <= 10; $j++) {
            echo "<tr>";
            for ($i = 1; $i <= $soNhap; $i++) {
                $class = ($j % 2 == 1) ? "odd" : "";
                echo "<td class='$class'>$i x $j = " . ($i * $j) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
</body>

</html>