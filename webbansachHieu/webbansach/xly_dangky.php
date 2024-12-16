<?php 
    session_start();
?>


<?php
include ("ketnoi.php");
$tdn=$_POST["tendn"];
$mk=$_POST["matkhau"];
$mk_md5 = md5($mk);
$ht=$_POST["hoten"];
$gt=$_POST["gioitinh"];
$qg=$_POST["quocgia"];

/*Kiểm tra tên người dùng này có hợp lệ không*/
$sql_1="select * from nguoi_dung where username='".$tdn."'";
$kq_1=mysqli_query($kn,$sql_1) or die ("Không thể truy xuất bảng nguoi_dung".mysqli_error($kn)); if(mysqli_fetch_array($kq_1))
{
echo "<script language=javascript>
alert('Đã có tên đăng nhập này. Bạn hãy chọn tên đăng nhập khác!'); window.location='dangky.php';
</script>";
}/*hết phần kiểm tra*/

$duongdan="HINHANH/"; 
$duongdan=$duongdan.basename($_FILES["hinhanh"]["name"]);
$file_tam=$_FILES["hinhanh"]["tmp_name"];
move_uploaded_file($file_tam,$duongdan);

$sql_2="insert into nguoi_dung values('".$tdn."','".$mk_md5."','".$ht."',".$gt.",'".$qg."','".$duongdan."')";
$kq_2=mysqli_query($kn,$sql_2) or die ("Không thể thêm người dùng này".mysqli_error($kn));
$_SESSION["nguoidung"]=$tdn; echo "<script language=javascript>
alert('Đăng ký thành công'); window.location='trangtt_canhan.php';
</script>";
?>

