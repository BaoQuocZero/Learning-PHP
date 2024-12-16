<?php include 'header.php'; ?>

<!-- Bootstrap Container -->
<div class="container mt-4">

    <?php
    include 'ketnoi.php';
    $sql = "SELECT * FROM sach";
    $kq = mysqli_query($kn, $sql);

    // Hiển thị bảng
    echo '<table class="table table-bordered table-hover">';
    echo '<thead class="table-success">
            <tr>
                <th>Hình ảnh</th>
                <th>Thông tin sách</th>
            </tr>
          </thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_array($kq)) {
        echo '<tr>';
        echo '<td class="text-center">
                <img src="'.$row["HinhSach"].'" class="img-fluid rounded" alt="Hình sách" style="width: 90px; height: 120px;">
              </td>';
        echo '<td>
                <strong>Tên sách:</strong> '.$row["TenSach"].'<br>
                <strong>Tác giả:</strong> '.$row["TacGia"].'<br>
                <strong>Mô tả:</strong> '.$row["MoTa"].'<br>
                <strong>Số trang:</strong> '.$row["SoTrang"].'<br>
                <strong>Giá:</strong> '.number_format($row["Gia"], 0, ',', '.').' VNĐ<br>
                <strong>Số lượng:</strong> '.$row["SoLuong"].'<br>
                <strong>Mã loại:</strong> '.$row["MaLoai"].'
              </td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    ?>
</div>

<?php include 'footer.php'; ?>
