<!-- index.php -->
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
        <h1 class="text-center">Quản lý Sách</h1>

        <!-- Nút Thêm Sách -->
        <a href="create_book.php" class="btn btn-success mb-3">Thêm Sách</a>

        <h2 class="mt-4">Danh sách Sách</h2>
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Mã Loại</th>
                    <th>Tên Sách</th>
                    <th>Tác Giả</th>
                    <th>Mô Tả</th>
                    <th>Hình Ảnh</th>
                    <th>Số Trang</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                    <th>Hành động</th>
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
                $result = $conn->query("SELECT * FROM sach");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['ID_SACH'] . "</td>";
                    echo "<td>" . $row['MA_LOAI'] . "</td>";
                    echo "<td>" . $row['TEN_SACH'] . "</td>";
                    echo "<td>" . $row['TAC_GIA'] . "</td>";
                    echo "<td>" . $row['MO_TA'] . "</td>";
                    echo "<td><img src='hinhanh/" . $row['HINH_SACH'] . "' width='50'></td>";
                    echo "<td>" . $row['SO_TRANG'] . "</td>";
                    echo "<td>" . $row['GIA'] . "</td>";
                    echo "<td>" . $row['SO_LUONG'] . "</td>";
                    echo "<td><a href='edit_book.php?edit=" . $row['ID_SACH'] . "' class='btn btn-warning'>Sửa</a> <a href='?delete=" . $row['ID_SACH'] . "' class='btn btn-danger'>Xóa</a></td>";
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
