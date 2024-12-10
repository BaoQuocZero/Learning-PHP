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
               if (session_status() === PHP_SESSION_NONE) {
                session_start();                
            }
            $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] == 'admin';      
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
                    <table border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#003300">
                        <tr>
                            <th>
                                <font color="#FF6600">Quản lý sách</font>
                            </th>
                        </tr>
                        <tr>
                            <td><a href="?page=DangKy">Đăng ký</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=getSach">Tất cả Sách</a></td>
                        </tr>
                        <?php
                        if ($isAdmin) {
                        echo '<tr><td><a href="?page=create_book">Thêm Sách</a></td></tr>';
                        }
                        ?>
                        <tr>
                            <td><a href="?page=getGioHang">Giỏ hàng</a></td>
                        </tr>
                    </table>
                </td>
                <td valign="top" bgcolor="#FFFFFF"
                    style="text-align: center; vertical-align: middle; background-color: white;">
                    <?php
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];

                        // Kiểm tra giá trị của $page
                        switch ($page) {
                            case 'DangKy':
                                include 'views/DangKy.php';
                                break;

                            case 'getSach':
                                include 'views/getSach.php';
                                break;

                            case 'create_book':
                                include 'views/create_book.php';
                                break;
                            
                            case 'getGioHang':
                                include 'views/getGioHang.php';
                                break;

                            // Thêm các case khác nếu cần
                            default:
                                echo "<p>Nội dung không tồn tại.</p>";
                                break;
                        }
                    } else {
                        include 'views/getSach.php'; // Trang mặc định
                    }
                    ?>
                    <!-- footer -->
                    <?php include 'footer.php'; ?>