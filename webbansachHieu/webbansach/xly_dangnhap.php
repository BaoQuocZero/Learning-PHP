<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include("ketnoi.php");
    $user = $_POST["tendn"];
    $pass = $_POST["matkhau"];
    $pass_md5 = md5($pass); 
    $sql = "SELECT * FROM nguoi_dung WHERE username = '".$user."' AND password = '".$pass_md5."'";
    $kq = mysqli_query($kn, $sql) or die ("Không thể mở bảng admin".mysqli_error($kn));
    if ($row = mysqli_fetch_assoc($kq)) {
        $_SESSION["nguoidung"] = $user;
        header('Location: trangtt_canhan.php'); 
    } else {
        echo "<script>alert('Mật khẩu không đúng!'); window.location='index.php';</script>";
    }
    ?>
</body>
</html>