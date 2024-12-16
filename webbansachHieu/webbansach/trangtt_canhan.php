<?php
include("header.php"); 
?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["nguoidung"])) {
    echo "<script language='javascript'>
        alert('Bạn không có quyền trên trang này!');
        window.location='dangky.php';
    </script>";
    exit();
}
?>


<table align="center">
<tr bgcolor="#CCCCCC">
<td align="right"> Xin chào <?php echo $_SESSION["nguoidung"]; ?> &nbsp;&nbsp;| <a href="thoat.php">Thoát</a> 
| <a href="frmdoimk.php">Thay đổi mật khẩu</td>
</tr>
<tr>
<td>THÔNG TIN CỦA BẠN</td>
</tr>
<?php include("ketnoi.php");
$user=$_SESSION["nguoidung"];
$sql="select * from nguoi_dung where username='".$user."'";
$kq=mysqli_query($kn,$sql) or die ("Không thể xuất thông tin người dùng ".mysqli_error($kn)); 
while($row=mysqli_fetch_array($kq))
{
echo "<tr>";
echo "<td>Họ và tên: ".$row["hoten"]."</td>"; echo "</tr>";
echo "<tr>";
echo "<td>Giới tính: ";
if ($row["gioitinh"]==0)
echo "Nam"; else echo "Nữ"; echo "</td>";
echo "</tr>"; echo "<tr>";
echo "<td>Thuộc quốc tịch: ".$row["quocgia"]."</td>"; echo "</tr>";
echo "<tr>";
echo "<td>Ảnh đại diện: <img src= ".$row["hinhdaidien"]."></td>"; echo "</tr>";
 
}
?>

</table>
<?php include 'footer.php'; ?>