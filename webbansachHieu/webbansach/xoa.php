<?php session_start(); if(!isset($_SESSION["nguoiquantri"]))
{
echo "<script language=javascript>
alert('Bạn không có quyền trên trang này!'); window.location='dangkyQT.php';
</script>";
}
?>
<!DOCTYPE	html	PUBLIC	"-//W3C//DTD	XHTML	1.0	Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
 
<?php include("ketnoi.php");
$user_xoa=$_REQUEST["user"]; //Nhận giá trị user từ link xóa của quantri.php
$sql="delete from nguoi_dung where username='".$user_xoa."'";
$kq=mysqli_query($kn,$sql) or die ("Không thể xuất thông tin người dùng ".mysqli_error($kn)); echo ("<script language=javascript>
{
alert('Xóa thành công'); window.location='quantri.php';
}
</script> ");
?>


</table>
</body>
</html>
