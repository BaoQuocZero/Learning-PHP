<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "online_shop");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}


$query = "SELECT ctg.*, s.TEN_SACH, s.GIA, ctg.SO_LUONG_MUA
          FROM chi_tiet_gio_hang ctg
          JOIN sach s ON ctg.ID_SACH = s.ID_SACH
          WHERE ctg.USERNAME = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION["nguoidung"]);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Giỏ Hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-3">Chi Tiết Giỏ Hàng</h2>

        <!-- Danh sách sách trong giỏ hàng -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Người mua</th>
                    <th>Tên Sách</th>
                    <th>Số Lượng</th>
                    <th>Giá</th>
                    <th>Tổng Giá</th>
                </tr>
            </thead>
            <tbody>
                <?php
            $total_price = 0;
            while ($row = $result->fetch_assoc()) {
                $total_item_price = $row['GIA'] * $row['SO_LUONG_MUA'];
                $total_price += $total_item_price;
            ?>
                <tr>
                    <td><?php echo $row['USERNAME']; ?></td>
                    <td><?php echo $row['TEN_SACH']; ?></td>
                    <td><?php echo $row['SO_LUONG_MUA']; ?></td>
                    <td><?php echo number_format($row['GIA'], 0, ',', '.') . ' VND'; ?></td>
                    <td><?php echo number_format($total_item_price, 0, ',', '.') . ' VND'; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <h4>Tổng Giá: <?php echo number_format($total_price, 0, ',', '.') . ' VND'; ?></h4>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>