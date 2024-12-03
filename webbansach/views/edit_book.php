<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "online_shop");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu sách để chỉnh sửa
if (isset($_GET['edit'])) {
    $id_sach = $_GET['edit'];
    $result = $conn->query("SELECT * FROM sach WHERE ID_SACH=$id_sach");
    $sach = $result->fetch_assoc();
}

// Lấy dữ liệu loại sách để hiển thị trong dropdown
$loai_sach_result = $conn->query("SELECT * FROM loai_sanh");

// Xử lý sửa sách
if (isset($_POST['save'])) {
    $id_sach = $_POST['id_sach'];
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
        $hinh_sach = isset($sach['HINH_SACH']) ? $sach['HINH_SACH'] : null;
    }

    // Cập nhật sách vào cơ sở dữ liệu
    $stmt = $conn->prepare("UPDATE sach SET MA_LOAI=?, TEN_SACH=?, TAC_GIA=?, MO_TA=?, HINH_SACH=?, SO_TRANG=?, GIA=?, SO_LUONG=? WHERE ID_SACH=?");
    $stmt->bind_param("sssssiiii", $ma_loai, $ten_sach, $tac_gia, $mo_ta, $hinh_sach, $so_trang, $gia, $so_luong, $id_sach);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php"); // Điều hướng về trang quản lý sách sau khi lưu
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sách</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">Sửa Sách</h1>

        <!-- Form sửa sách -->
        <form action="" method="post" enctype="multipart/form-data" class="mt-4">
            <input type="hidden" name="id_sach" value="<?php echo isset($sach['ID_SACH']) ? $sach['ID_SACH'] : ''; ?>">

            <div class="form-group">
                <label for="ma_loai">Mã Loại:</label>
                <select name="ma_loai" class="form-control" required>
                    <option value="">Chọn loại sách</option>
                    <?php
                    // Hiển thị danh sách loại sách
                    while ($loai = $loai_sach_result->fetch_assoc()) {
                        $selected = ($loai['MA_LOAI'] == $sach['MA_LOAI']) ? 'selected' : '';
                        echo "<option value=\"{$loai['MA_LOAI']}\" $selected>{$loai['TEN_LOAI']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="ten_sach">Tên Sách:</label>
                <input type="text" name="ten_sach" class="form-control"
                    value="<?php echo isset($sach['TEN_SACH']) ? $sach['TEN_SACH'] : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="tac_gia">Tác Giả:</label>
                <input type="text" name="tac_gia" class="form-control"
                    value="<?php echo isset($sach['TAC_GIA']) ? $sach['TAC_GIA'] : ''; ?>">
            </div>

            <div class="form-group">
                <label for="mo_ta">Mô Tả:</label>
                <textarea name="mo_ta"
                    class="form-control"><?php echo isset($sach['MO_TA']) ? $sach['MO_TA'] : ''; ?></textarea>
            </div>

            <div class="form-group">
                <label for="hinh_sach">Hình Ảnh:</label>
                <input type="file" name="hinh_sach" class="form-control-file">
                <?php if (isset($sach['HINH_SACH'])): ?>
                <img src="../hinhanh/<?php echo $sach['HINH_SACH']; ?>" alt="Hình Ảnh" width="100">
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="so_trang">Số Trang:</label>
                <input type="number" name="so_trang" class="form-control"
                    value="<?php echo isset($sach['SO_TRANG']) ? $sach['SO_TRANG'] : ''; ?>">
            </div>

            <div class="form-group">
                <label for="gia">Giá:</label>
                <input type="number" name="gia" class="form-control"
                    value="<?php echo isset($sach['GIA']) ? $sach['GIA'] : ''; ?>">
            </div>

            <div class="form-group">
                <label for="so_luong">Số Lượng:</label>
                <input type="number" name="so_luong" class="form-control"
                    value="<?php echo isset($sach['SO_LUONG']) ? $sach['SO_LUONG'] : ''; ?>">
            </div>

            <button type="submit" name="save" class="btn btn-primary">Lưu</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>