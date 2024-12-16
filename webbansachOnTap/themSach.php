<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'ketNoi.php';
$query = "SELECT s.*, ls.* FROM sach s JOIN loai_sanh ls ON ls.MA_LOAI = s.MA_LOAI";
$result = $conn->query($query);

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
    if ($_FILES['hinh_sach']['name']) { //Kiểm tra sự tồn tại của hình ảnh
        //$hinh_sach = "hinhanh/" . basename($_FILES["hinh_sach"]["name"]); 
        // move_uploaded_file($_FILES["hinh_sach"]["tmp_name"], $hinh_sach);

        $hinh_sach = basename($_FILES["hinh_sach"]["name"]); // chỉ lưu tên ảnh
        move_uploaded_file($_FILES["hinh_sach"]["tmp_name"], "hinhanh/" . $hinh_sach); //Lấy tên tệp và di chuyển tệp vào hinhanh/
    } else {
        $hinh_sach = null; // Không có hình ảnh
    }

    // Thêm sách vào cơ sở dữ liệu
    $stmt = $conn->prepare("INSERT INTO sach (MA_LOAI, TEN_SACH, TAC_GIA, MO_TA, HINH_SACH, SO_TRANG, GIA, SO_LUONG) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssiii", $ma_loai, $ten_sach, $tac_gia, $mo_ta, $hinh_sach, $so_trang, $gia, $so_luong);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Lưu sách thành công!'); window.location.href='index.php';</script>";
    //header("Location: index.php"); // Điều hướng về trang quản lý sách sau khi lưu
}
?>
<section class="mb-4">
    <h2>Thêm sách</h2>
    <form action="" method="post" enctype="multipart/form-data" class="mt-4">
        <div class="form-group">
            <label for="ma_loai">Loại Sách:</label>
            <select name="ma_loai" class="form-control" required>
                <option value="">Chọn loại sách</option>
                <?php
                if ($result->num_rows > 0) { //Đảm bảo có trả về
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
</section>

<?php
$conn->close();
?>