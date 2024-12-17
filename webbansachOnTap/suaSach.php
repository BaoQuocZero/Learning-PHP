<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Kiểm tra quyền
if ($_SESSION['role'] !== 'admin') {
    echo "<script>alert('Bạn không có quyền!'); window.location.href='index.php';</script>";
    exit();
}
include 'ketNoi.php';

// Lấy ID_SACH từ tham số URL
if (isset($_GET['edit'])) {
    $id_sach = $_GET['edit'];
} else {
    echo "ID sách không tồn tại.";
    exit;
}

// Truy vấn thông tin sách từ cơ sở dữ liệu
$query = "SELECT s.*, ls.TEN_LOAI FROM sach s JOIN loai_sanh ls ON ls.MA_LOAI = s.MA_LOAI WHERE s.ID_SACH = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_sach);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra nếu có sách với ID_SACH này
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Không tìm thấy sách với ID này.";
    exit;
}

// Xử lý cập nhật sách
if (isset($_POST['save'])) {
    $ma_loai = $_POST['ma_loai'];
    $ten_sach = $_POST['ten_sach'];
    $tac_gia = $_POST['tac_gia'];
    $mo_ta = $_POST['mo_ta'];
    $so_trang = $_POST['so_trang'];
    $gia = $_POST['gia'];
    $so_luong = $_POST['so_luong'];

    // Xử lý hình ảnh
    if ($_FILES['hinh_sach']['name']) {
        $hinh_sach = basename($_FILES["hinh_sach"]["name"]);
        move_uploaded_file($_FILES["hinh_sach"]["tmp_name"], "hinhanh/" . $hinh_sach);
    } else {
        // Nếu không có hình ảnh mới, giữ lại hình ảnh cũ
        $hinh_sach = $row['HINH_SACH'];
    }

    // Cập nhật thông tin sách vào cơ sở dữ liệu
    $stmt = $conn->prepare("UPDATE sach SET MA_LOAI = ?, TEN_SACH = ?, TAC_GIA = ?, MO_TA = ?, HINH_SACH = ?, SO_TRANG = ?, GIA = ?, SO_LUONG = ? WHERE ID_SACH = ?");
    $stmt->bind_param("ssssssiii", $ma_loai, $ten_sach, $tac_gia, $mo_ta, $hinh_sach, $so_trang, $gia, $so_luong, $id_sach);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Cập nhật sách thành công!'); window.location.href='index.php';</script>";
}

?>

<section class="mb-4">
    <h2>Sửa thông tin sách</h2>
    <form action="" method="post" enctype="multipart/form-data" class="mt-4">
        <div class="form-group">
            <label for="ma_loai">Loại Sách:</label>
            <select name="ma_loai" class="form-control" required>
                <option value="">Chọn loại sách</option>
                <?php
                // Lấy danh sách loại sách để hiển thị trong dropdown
                $loai_query = "SELECT * FROM loai_sanh";
                $loai_result = $conn->query($loai_query);
                while ($loai_row = $loai_result->fetch_assoc()) {
                    $selected = ($loai_row['MA_LOAI'] == $row['MA_LOAI']) ? 'selected' : '';
                    echo "<option value='" . $loai_row['MA_LOAI'] . "' $selected>" . $loai_row['TEN_LOAI'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="ten_sach">Tên Sách:</label>
            <input type="text" name="ten_sach" class="form-control" value="<?php echo $row['TEN_SACH']; ?>" required>
        </div>

        <div class="form-group">
            <label for="tac_gia">Tác Giả:</label>
            <input type="text" name="tac_gia" class="form-control" value="<?php echo $row['TAC_GIA']; ?>">
        </div>

        <div class="form-group">
            <label for="mo_ta">Mô Tả:</label>
            <textarea name="mo_ta" class="form-control"><?php echo $row['MO_TA']; ?></textarea>
        </div>

        <div class="form-group">
            <label for="hinh_sach">Hình Ảnh:</label>
            <input type="file" name="hinh_sach" class="form-control-file">
            <img src="hinhanh/<?php echo $row['HINH_SACH']; ?>" width="100" alt="Hình sách cũ">
        </div>

        <div class="form-group">
            <label for="so_trang">Số Trang:</label>
            <input type="number" name="so_trang" class="form-control" value="<?php echo $row['SO_TRANG']; ?>" required>
        </div>

        <div class="form-group">
            <label for="gia">Giá:</label>
            <input type="number" name="gia" class="form-control" value="<?php echo $row['GIA']; ?>" required>
        </div>

        <div class="form-group">
            <label for="so_luong">Số Lượng:</label>
            <input type="number" name="so_luong" class="form-control" value="<?php echo $row['SO_LUONG']; ?>" required>
        </div>

        <button type="submit" name="save" class="btn btn-primary">Cập nhật</button>
    </form>
</section>

<?php
$conn->close();
?>