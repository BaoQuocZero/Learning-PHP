<?php
include("header.php"); 
?>
<?php
    include("ketnoi.php"); // Kết nối cơ sở dữ liệu
    
    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (!isset($_SESSION["nguoidung"])) {
        echo "<script>alert('Bạn cần đăng nhập để xem giỏ hàng!'); window.location='index.php';</script>";
        exit();
    }

    $username = $_SESSION["nguoidung"];

// Lấy ID giỏ hàng của người dùng
$sql_giohang = "SELECT * FROM chitietgiohang WHERE username = '$username' ";
$result_giohang = mysqli_query($kn, $sql_giohang);

// Kiểm tra xem truy vấn có thành công không
if (!$result_giohang) {
    die("Lỗi truy vấn giỏ hàng: " . mysqli_error($kn));
}

if ($row_giohang = mysqli_fetch_assoc($result_giohang)) {
    $idgiohang = $row_giohang["idgiohang"];

    // Lấy chi tiết giỏ hàng của người dùng
    $sql_chitiet = "SELECT ct.*, s.tensach, s.gia FROM chitietgiohang ct JOIN sach s ON ct.idsach = s.idsach WHERE ct.idgiohang = '$idgiohang'";
    $result_chitiet = mysqli_query($kn, $sql_chitiet);

    // Kiểm tra nếu có lỗi khi truy vấn chi tiết giỏ hàng
    if (!$result_chitiet) {
        die("Lỗi truy vấn chi tiết giỏ hàng: " . mysqli_error($kn));
    }

    if (mysqli_num_rows($result_chitiet) > 0) {
        echo "<h2>Giỏ hàng của bạn:</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Tên sách</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng giá</th>
                </tr>";

        $total = 0;
        while ($row_chitiet = mysqli_fetch_assoc($result_chitiet)) {
            $tensach = $row_chitiet['tensach'];
            $soluongmua = $row_chitiet['soluongmua'];
            $gia = $row_chitiet['gia'];
            $tonggia = $soluongmua * $gia;

            // Tính tổng giá trị giỏ hàng
            $total += $tonggia;

            echo "<tr>
                    <td>$tensach</td>
                    <td>$soluongmua</td>
                    <td>$gia VND</td>
                    <td>$tonggia VND</td>
                </tr>";
        }
        echo "</table>";
        echo "<h3>Tổng giá trị giỏ hàng: $total VND</h3>";
    } else {
        echo "<p>Giỏ hàng của bạn hiện đang trống.</p>";
    }
} else {
    echo "<p>Không tìm thấy giỏ hàng của bạn.</p>";
}
?>

