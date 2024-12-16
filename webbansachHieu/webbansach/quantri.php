<?php
include("header.php"); 
?>

<?php  if(!isset($_SESSION["nguoiquantri"]))
{
echo "<script language=javascript>
alert('Bạn không có quyền trên trang này!'); window.location='dangnhapQT.php';
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
<table align="center">
<tr bgcolor="#CCCCCC">
<td	align="right">	Xin	chào admin	<?php	echo	$_SESSION["nguoiquantri"];	?>	&nbsp;&nbsp;|	<a href="thoatQT.php">Thoát</a></td>
</tr>
<tr>
<td align="center">THÔNG TIN NGƯỜI DÙNG
<table border="1">
<tr>

<th>Username</th>
<th>Họ và tên</th>
<th>Giới tính</th>
<th>Quốc gia</th>
<th>Hình đại diện</th>
<th>Sửa</th> <!-- Thêm cột này-->
<th>Xóa</th>
 
</tr>
<?php include("ketnoi.php");
$sql="select * from nguoi_dung ";
$kq=mysqli_query($kn,$sql) or die ("Không thể xuất thông tin người dùng ".mysqli_error($kn)); while($row=mysqli_fetch_array($kq))
{
echo "<tr>";
echo "<td> ".$row["username"]."</td>";
$usern=$row["username"];

echo "<td> ".$row["hoten"]."</td>";
echo "<td>".$row["gioitinh"]."</td>";
echo "<td>".$row["quocgia"]."</td>";
echo "<td><img src= '".$row["hinhdaidien"]."' height='50' width='50'></td>";
echo "<td><a href='sua.php?user=$usern'>Sửa</a></td>";//Thêm cột sửa tương ứng + truyền biến user (chứa thông tin về tên đăng nhập) sang file sua.php
echo "<td><a href='xoa.php?user=$usern'>Xóa</a></td>"; echo "</tr>";
}
?>


</table>
</body>
</html>
