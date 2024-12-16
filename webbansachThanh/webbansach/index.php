<?php
session_start(); // Bắt đầu session hoặc tiếp tục session hiện tại
?>
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
        <table width="90%" border="1" cellspacing="0" bordercolor="#003300" cellpadding="0"
            style="box-shadow: #6C0 0px 30px 150px;">
            <!-- Header -->
            <?php include 'header.php';
            
            // print_r($_SESSION); // Hiển thị tất cả session hiện tại            
            ?>

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
                    <?php 
    // Kiểm tra nếu người dùng là admin (kiểm tra session)
    if (isset($_SESSION['admin'])) { 
    ?>
                    <table border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#003300">
                        <tr>
                            <th>
                                <font color="#FF6600">Quản lý sách</font>
                            </th>
                        </tr>
                        <tr>
                            <td><a href="?page=getSach">Tất cả Sách</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=create_book">Thêm Sách</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=quantri">Quản trị user</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=giohang">quản lý giỏ hàng</a></td>
                        </tr>
                    </table>
                    <?php 
    }
    ?>
                    <?php 
    // Kiểm tra nếu người dùng là admin (kiểm tra session)
    if (isset($_SESSION['nguoidung'])) { 
    ?>
                    <table border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#003300">

                        <tr>
                            <td><a href="?page=giohang">giỏ hàng của bạn</a></td>
                        </tr>
                    </table>
                    <?php 
    }
    ?>
                </td>
                <td valign="top" bgcolor="#FFFFFF"
                    style="text-align: center; vertical-align: middle; background-color: white;">

                    <?php
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        switch ($page) {
                            case 'getSach':
                                include 'getSach.php';
                                break;
                            case 'create_book':
                                include 'create_book.php'; 
                                break;                            
                            // Thêm các case khác cho các trang khác
                            case 'register':
                                include 'dangky.php'; 
                                break;  
                            case 'profile':
                                include 'trangtt_canhan.php'; 
                                break;
                            case 'doimatkhau':
                                include 'doimatkhau.php'; 
                                break;
                            case 'quantri':
                                include 'quantri.php'; 
                                break;  
                            case 'giohang':
                                include 'giohang.php'; 
                                break;          
                            default:
                                echo "<p>Nội dung không tồn tại.</p>";
                        }
                    } else 
                        include 'getSach.php'
                ?>
                    <!-- footer -->
                    <?php include 'footer.php'; ?>