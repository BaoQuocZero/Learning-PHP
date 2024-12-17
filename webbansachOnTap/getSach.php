<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'ketNoi.php';
$query = "SELECT s.*, ls.* FROM sach s JOIN loai_sanh ls ON ls.MA_LOAI = s.MA_LOAI";
$result = $conn->query($query);

// Xử lý xóa sách
if (isset($_GET['delete'])) {
    $id_sach = $_GET['delete']; // Lấy ID sách từ tham số GET
    $stmt = $conn->prepare("DELETE FROM sach WHERE ID_SACH=?"); // Câu lệnh SQL xóa sách
    $stmt->bind_param("i", $id_sach); // Gán giá trị ID_SACH vào câu lệnh
    $stmt->execute(); // Thực thi câu lệnh
    $stmt->close(); // Đóng câu lệnh

    //Xóa thành công nhưng phải tải lại mới thấy
    //Thêm lệnh này để tải lại =)
    // Chuyển hướng về trang index.php sau khi xóa thành công
    header("Location: index.php");
    exit(); // Dừng thực thi mã tiếp theo
}

?>
<a href="?page=themSach" class="btn btn-success">Thêm sách</a>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Ảnh</th>
            <th colspan="2">Thông Tin</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td rowspan="7">
                <img class="" style="max-width: 100px;" src="./hinhanh/Adolf_Hitler_28.jpg.webp" alt="">
            </td>
            <td class="text-left">Tên</td>
            <td class="text-left">Nguyễn Văn A</td>
        </tr>
        <tr>
            <td class="text-left">Tác giả</td>
            <td class="text-left">tác gia sách</td>
        </tr>
        <tr>
            <td>Loại sách</td>
            <td>Moooooooooooooo</td>
        </tr>
        <tr>
            <td>Mô tả</td>
            <td>Moooooooooooooo</td>
        </tr>
        <tr>
            <td>Số trang</td>
            <td>Moooooooooooooo</td>
        </tr>
        <tr>
            <td>Giá</td>
            <td>Moooooooooooooo</td>
        </tr>
        <tr>
            <td>Số lượng</td>
            <td>Moooooooooooooo</td>
        </tr>
        <tr>
            <td><strong>Hành động</strong></td>
            <td colspan="2">
                <a href="/themGioHang.php?themGio=' . $row['ID_SACH'] . '" class="btn btn-success btn-sm">
                    Thêm vào giỏ hàng</a>
                <a href="?page=suaSach&edit=' . $row['ID_SACH'] . '" class="btn btn-warning btn-sm">Sửa</a>
                <!-- <a href="?delete=' . $row['ID_SACH'] . '" class="btn btn-danger btn-sm">Xóa</a>  -->
                <a href="javascript:void(0);" onclick="confirmDelete(' . $row['ID_SACH'] . ')"
                    class="btn btn-danger btn-sm">Xóa</a>
            </td>
        </tr>
    </tbody>
</table>

<?php
echo '<a href="?page=themSach" class="btn btn-success">Thêm sách</a>';
echo '<table class="table table-bordered table-hover">';
echo '<thead>';
echo '    <tr>';
echo '        <th>Ảnh</th>';
echo '        <th colspan="2">Thông Tin</th>';
echo '    </tr>';
echo '</thead>';
echo '<tbody>';
while ($row = $result->fetch_assoc()) {
    echo '    <tr>';
    echo '        <td rowspan="7">';
    echo '            <img style="max-width: 200px;" src="./hinhanh/' . $row['HINH_SACH'] . '" alt="">';
    echo '        </td>';
    echo '        <td class="text-left">Tên</td>';
    echo '        <td class="text-left">' . $row['TEN_SACH'] . '</td>';
    echo '    </tr>';
    echo '    <tr>';
    echo '        <td class="text-left">Tác giả</td>';
    echo '        <td class="text-left">' . $row['TAC_GIA'] . '</td>';
    echo '    </tr>';
    echo '    <tr>';
    echo '        <td>Loại sách</td>';
    echo '        <td>' . $row['TEN_LOAI'] . '</td>';
    echo '    </tr>';
    echo '    <tr>';
    echo '        <td>Mô tả</td>';
    echo '        <td>' . $row['MO_TA'] . '</td>';
    echo '    </tr>';
    echo '    <tr>';
    echo '        <td>Số trang</td>';
    echo '        <td>' . $row['SO_TRANG'] . '</td>';
    echo '    </tr>';
    echo '    <tr>';
    echo '        <td>Giá</td>';
    echo '        <td>' . $row['GIA'] . '</td>';
    echo '    </tr>';
    echo '    <tr>';
    echo '        <td>Số lượng</td>';
    echo '        <td>' . $row['SO_LUONG'] . '</td>';
    echo '    </tr>';
    echo '    <tr>';
    echo '        <td><strong>Hành động</strong></td>';
    echo '    <td colspan="2">';
    echo '    <a href="?page=themGioHang&themGio=' . $row['ID_SACH'] . '" class="btn btn-success btn-sm">';
    echo '        Thêm vào giỏ hàng</a>';
    echo '    <a href="?page=suaSach&edit=' . $row['ID_SACH'] . '" class="btn btn-warning btn-sm">Sửa</a>';
    echo '    <!-- <a href="?delete=' . $row['ID_SACH'] . '" class="btn btn-danger btn-sm">Xóa</a>  -->';
    echo '    <a href="javascript:void(0);" onclick="confirmDelete(' . $row['ID_SACH'] . ')"';
    echo '        class="btn btn-danger btn-sm">Xóa</a>';
    echo '    </td>';
    echo '    </tr>';
}
;
echo '</tbody>';
echo '</table>';
$conn->close();
?>
<!-- Cái hàm để xác nhận xóa =) -->
<script type="text/javascript">
function confirmDelete(id) {
    var confirmation = confirm("Bạn có chắc chắn muốn xóa sách này?");
    if (confirmation) {
        // Chuyển hướng đến trang xóa sách nếu người dùng xác nhận
        window.location.href = "?delete=" + id;
    }
}
</script>