<?php
//session_start(); // Start the session to check for admin login

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "online_shop");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý thêm sách
if (isset($_POST['save'])) {
    $ma_loai = $_POST['ma_loai'];
    $ten_sach = $_POST['ten_sach'];
    $tac_gia = $_POST['tac_gia'];
    $mo_ta = $_POST['mo_ta'];
    $so_trang = $_POST['so_trang'];
    $gia = $_POST['gia'];
    $so_luong = $_POST['so_luong'];

    // Upload hình ảnh
    if ($_FILES['hinh_sach']['name']) {
        $hinh_sach = "" . basename($_FILES["hinh_sach"]["name"]);
        move_uploaded_file($_FILES["hinh_sach"]["tmp_name"], $hinh_sach);
    } else {
        $hinh_sach = null; // Không có hình ảnh
    }

    // Thêm sách vào cơ sở dữ liệu
    $stmt = $conn->prepare("INSERT INTO sach (MA_LOAI, TEN_SACH, TAC_GIA, MO_TA, HINH_SACH, SO_TRANG, GIA, SO_LUONG) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssiii", $ma_loai, $ten_sach, $tac_gia, $mo_ta, $hinh_sach, $so_trang, $gia, $so_luong);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php"); // Điều hướng về trang quản lý sách sau khi lưu
    exit(); // Always use exit after a header redirect to avoid any further script execution
}

// Truy vấn danh sách loại sách
$sql = "SELECT * FROM loai_sanh"; // Corrected table name to loai_sach
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sách</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<?php
if (isset($_SESSION['admin'])) { // Corrected PHP opening tag and curly braces
?>
<div class="container mt-4">
    <h1 class="text-center">Thêm Sách Mới</h1>

    <!-- Form thêm sách -->
    <form action="" method="post" enctype="multipart/form-data" class="mt-4">
        <div class="form-group">
            <label for="ma_loai">Loại Sách:</label>
            <select name="ma_loai" class="form-control" required>
                <option value="">Chọn loại sách</option>
                <?php
                if ($result->num_rows > 0) {
                    // Hiển thị tất cả các loại sách
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['MA_LOAI'] . "'>" . $row['TEN_LOAI'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Không có loại sách</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="ten_sach">Tên Sách:</label>
            <input type="text" name="ten_sach" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="tac_gia">Tác Giả:</label>
            <input type="text" name="tac_gia" class="form-control">
        </div>

        <div class="form-group">
            <label for="mo_ta">Mô Tả:</label>
            <textarea name="mo_ta" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="hinh_sach">Hình Ảnh:</label>
            <input type="file" name="hinh_sach" class="form-control-file">
        </div>

        <div class="form-group">
            <label for="so_trang">Số Trang:</label>
            <input type="number" name="so_trang" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="gia">Giá:</label>
            <input type="number" name="gia" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="so_luong">Số Lượng:</label>
            <input type="number" name="so_luong" class="form-control" required>
        </div>

        <button type="submit" name="save" class="btn btn-primary">Lưu</button>
    </form>
</div>
<?php
}
?>
   
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
