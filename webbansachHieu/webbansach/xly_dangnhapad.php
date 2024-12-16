<?php session_start(); ?>
<!DOCTYPE	html	PUBLIC	"-//W3C//DTD	XHTML	1.0	Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include("ketnoi.php");
$user=$_POST["tendn"];//nhận giá trị từ ô nhập liệu Tên đăng nhập của file dangnhapQT.php
$pass=$_POST["matkhau"];//nhận giá trị từ ô nhập liệu Mật khẩu của file dangnhapQT.php
$pass_md5 = md5($pass); 
$sql="select * from admin where username='".$user ."' and password ='". $pass_md5."'"; // câu lệnh SQL 
$kq=mysqli_query($kn, $sql) or die ("Không thể mở bảng admin".mysqli_error($kn));// thực thi câu lệnh SQL 
if (mysqli_fetch_array($kq))
{
    $_SESSION["nguoiquantri"]=$user; 
    echo ("<script language=javascript>
    alert('Đăng nhập thành công'); 
    window.location='quantri.php';
    </script> ");}

else
{
    echo ("<script language=javascript>
    alert('Sai tên đăng nhập hoặc mật khẩu'); 
    window.location='dangnhapQT.php';
    </script> ");
}


?>
</body>
</html>
