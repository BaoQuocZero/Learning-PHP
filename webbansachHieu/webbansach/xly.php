<?php
include("header.php")
?>

    <?php
    $ten = $_POST["txtTen"];
    $tuoi = $_POST["txtTuoi"];
    $nam = date("Y");


    if ($ten && $tuoi && $tuoi >= 0) {
        echo ("Chào bạn " . $ten .  "<br>");
        echo ("Tên bạn dài " . strlen($ten) .  "<br>");
        echo ("Vậy là bạn đã " . $tuoi . " tuổi rồi." . "<br>");
        if (((($nam - $tuoi) % 4 == 0) && (($nam - $tuoi) % 100 !== 0)) || (($nam - $tuoi) % 400 == 0)) {
            echo ("Bạn sinh năm nhuần " . $nam - $tuoi .  "<br>");
        } else
            echo ("Bạn sinh năm " . $nam - $tuoi .  " không phải năm nhuận<br>");
    } else
        echo ("Bạn chưa nhập đủ thông tin hoặc thông tin không đúng<br>");
    ?>
<?php
include("footer.php")
?>