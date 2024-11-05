<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>--oO sachhay.com Oo--</title>
    <link rel="stylesheet" type="text/css" href="css.css" />

    <style>
    .odd {
        background-color: #FFBE98;
    }

    table {
        border-collapse: collapse;
    }

    td {
        border: 1px solid black;
        padding: 5px;
    }
    </style>
</head>

<body bgcolor="#999999">
    <center>
        <table width="1000" border="1" cellspacing="0" bordercolor="#003300" cellpadding="0"
            style="box-shadow: #6C0 0px 30px 150px;">
            <!-- Header -->
            <?php include 'header.php'?>
            <tr bgcolor="#92D84E">
                <td colspan="3">
                    <table border="0" width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="80"><a id="thuong" href="./">Trang chủ</a></td>
                            <td>
                                <font color="#FF6600">
                                    <marquee>Cùng bạn đi tìm tri thức!</marquee>
                                </font>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td width="200" align="left" valign="top" bgcolor="#92D84E">
                    <table border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#003300">
                        <tr>
                            <th>
                                <font color="#FF6600">Bài tập PHP căn bản</font>
                            </th>
                        </tr>
                        <tr>
                            <td><a href="?page=bt1">BT1 - Máy tính</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=bt2">BT2 - Giải PT bậc I một ẩn</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=bt3">BT3 - Giải PT bậc II một ẩn</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=bt4">BT4 - Tính diện tích</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=bt4">BT5 - Tam giác</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=bt6">BT6 - Số ngày trong tháng</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=bt7">BT7 - Phân loại và Kiểm tra biển số đẹp</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=bt8">BT8 - Thông tin người dùng</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=bt9">BT9 - Tính Diện Tích 1</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=bt10">BT10 - Tính Diện Tích 2</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=bt11">BT11 - Bảng cửu chương 1</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=bt12">BT12 - Bảng cửu chương 2</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=bt13">BT13 - Bảng cửu chương 3</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=bt14">BT14 - Số nguyên tố</a></td>
                        </tr>

                        <tr>
                            <th>
                                <font color="#FF6600">Bài tập PHP-MySQL</font>
                            </th>
                        </tr>
                        <tr>
                            <td><a href="#">Đăng ký thành viên</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">Chat với bạn bè</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">Tải sản phẩm miễn phí</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">Quản trị</a></td>
                        </tr>
                        <tr>
                            <th>
                                <font color="#FF6600">Bài tập PHP nâng cao</font>
                            </th>
                        </tr>
                        <tr>
                            <td><a href="#" target="_new">Đọc file trên Web</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">Đọc/ghi nội dung file với PHP</a></td>
                        </tr>
                    </table>
                </td>
                <td valign="top" bgcolor="#FFFFFF">

                    <?php
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        switch ($page) {
                            case 'bt1':
                                include 'maytinh.php'; // Tệp chứa nội dung cho BT1
                                break;
                            case 'bt2':
                                include 'pt1.php'; // Tệp chứa nội dung cho BT2
                                break;
                                case 'bt3':
                                    include 'pt2.php';
                                    break; 
                                case 'bt4':
                                    include 'bt4.php';
                                    break;
                                case 'bt6':
                                    include 'bt6.php';
                                    break;
                                case 'bt7':
                                    include 'bt7.php';
                                    break;
                                case 'bt8':
                                    include 'bt8.php';
                                    break;                                    
                                case 'bt9':
                                    include 'bt9.php';
                                    break;
                                case 'bt10':
                                    include 'bt10.php';
                                    break;                                          
                                case 'bt11':
                                    include 'bt11.php';
                                    break;
                                case 'bt12':
                                    include 'bt12.php';
                                    break;
                                case 'bt13':
                                    include 'bt13.php';
                                    break;
                                case 'bt14':
                                    include 'bt14.php';
                                    break;
                            // Thêm các case khác cho các trang khác
                            default:
                                echo "<p>Nội dung không tồn tại.</p>";
                        }
                    } else {
                        echo "<p>Chào mừng bạn đến với trang chủ.</p>";
                    }
                ?>

                    <!-- footer -->
                    <?php include 'footer.php'; ?>