<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phân loại và Kiểm tra biển số đẹp</title>
</head>
<body>
    <h1>Nhập biển số xe để phân loại</h1>
    
    <!-- Form nhập biển số xe -->
    <form method="POST" action="">
        <label for="bienSo">Biển số xe (4 chữ số):</label>
        <input type="text" id="bienSo" name="bienSo" maxlength="4" pattern="\d{4}" required>
        <button type="submit">Phân loại</button>
    </form>

    <?php
    // Hàm tính tổng các chữ số trong biển số
    function tongCacChuSo($bienSo) {
        $tong = 0;
        // Duyệt qua từng ký tự trong biển số
        for ($i = 0; $i < strlen($bienSo); $i++) {
            if (is_numeric($bienSo[$i])) {
                $tong += intval($bienSo[$i]);
            }
        }
        return $tong;
    }


    // Hàm kiểm tra xem biển số có phải là dãy số giống nhau
    function kiemTraSoGiongNhau($bienSo) {
        $firstDigit = '';
        for ($i = 0; $i < strlen($bienSo); $i++) {
            if (is_numeric($bienSo[$i])) {
                if ($firstDigit == '') {
                    $firstDigit = $bienSo[$i];
                } elseif ($bienSo[$i] != $firstDigit) {
                    return false;
                }
            }
        }
        return true;
    }

    function phanLoaiXe($bienSo) {
        $tong = tongCacChuSo($bienSo);

        // Nếu tổng là số lẻ thì là xe tốt
        if ($tong == 9) {
            return "Biển số xe đẹp";
        }

        // Kiểm tra các quy tắc cho xe đẹp
        if (kiemTraSoGiongNhau($bienSo)) {
            return "Biển số xe đẹp";
        }
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $bienSo = $_POST['bienSo'];

        if (preg_match('/^\d{4}$/', $bienSo)) {
            $loaiXe = phanLoaiXe($bienSo);
            // Hiển thị kết quả
            echo "<h2>Kết quả:</h2>";
            echo "<p>Biển số xe $bienSo thuộc loại: $loaiXe</p>";
            
        }
}

    ?>
</body>
</html>