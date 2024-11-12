<!-- getSach.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sách hay</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">

        <!-- Nút Thêm Sách -->
        <!-- <a href="create_book.php" class="btn btn-success mb-3">Thêm Sách</a> -->

        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Hình Ảnh</th>
                    <th>Nội Dung</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Kết nối cơ sở dữ liệu
                $conn = new mysqli("localhost", "root", "", "online_shop");
                if ($conn->connect_error) {
                    die("Kết nối thất bại: " . $conn->connect_error);
                }

                // Xử lý xóa sách
                if (isset($_GET['delete'])) {
                    $id_sach = $_GET['delete'];
                    $stmt = $conn->prepare("DELETE FROM sach WHERE ID_SACH=?");
                    $stmt->bind_param("i", $id_sach);
                    $stmt->execute();
                    $stmt->close();
                }

                // Hiển thị danh sách sách
                $result = $conn->query("SELECT s.*, ls.* FROM sach s JOIN loai_sanh ls ON ls.MA_LOAI = s.MA_LOAI");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    // Cột Hình Ảnh
                    echo "<td><img src='hinhanh/" . $row['HINH_SACH'] . "' width='100'></td>";
                    // Cột Nội Dung
                    echo "<td style='text-align: left;'>";
                    echo "<strong>Tên Sách:</strong> " . $row['TEN_SACH'] . "<br>";
                    echo "<strong>Loại Sách:</strong> " . $row['TEN_LOAI'] . "<br>";
                    echo "<strong>Tác Giả:</strong> " . $row['TAC_GIA'] . "<br>";
                    echo "<strong>Mô tả:</strong> " . $row['MO_TA'] . "<br>";
                    echo "<strong>Số trang:</strong> " . $row['SO_TRANG'] . "<br>";
                    echo "<strong>Số lượng:</strong> " . $row['SO_LUONG'] . "<br>";
                    echo "<strong>Giá:</strong> " . number_format($row['GIA'], 0, ',', '.') . " VND<br>";

                    // Các nút hành động căn phải
                    echo "<div style='text-align: right;'>";
                    echo "<a href='edit_book.php?edit=" . $row['ID_SACH'] . "' class='btn btn-warning btn-sm mt-2'>Sửa</a> ";
                    echo "<a href='?delete=" . $row['ID_SACH'] . "' class='btn btn-danger btn-sm mt-2'>Xóa</a>";
                    echo "</div>";

                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>