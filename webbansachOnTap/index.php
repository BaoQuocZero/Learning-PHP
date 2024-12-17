<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>--oO sachhay.com Oo--</title>
    <link rel="stylesheet" type="text/css" href="css.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
                            <td><a href="?page=getSach">Tất cả Sách</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=themSach">Thêm sách</a></td>
                        </tr>
                        <tr>
                            <td><a href="?page=gioHang">Giỏ hàng</a></td>
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
                            case 'getSach':
                                include 'getSach.php';
                                break;
                            case 'themSach':
                                include 'themSach.php';
                                break;
                            case 'suaSach':
                                include 'suaSach.php';
                                break;
                            case 'dangKy':
                                include 'dangKy.php';
                                break;
                            case 'gioHang':
                                include 'gioHang.php';
                                break;
                            case 'themGioHang':
                                include 'themGioHang.php';
                                break;
                            // Thêm các case khác nếu cần
                            default:
                                echo "
                            <div class='container mt-5'>
                                <div class='text-center'>
                                    <h3 class='display-4 text-danger'>404 Không tìm thấy</h3>
                                    <p class='lead text-muted'>Chào mừng, lữ khách. Bạn đã đến một trang không tồn tại, một nơi mà nội dung từng tồn tại—hoặc có thể chưa bao giờ tồn tại. Hãy dành thời gian này để dừng lại và suy ngẫm.</p>
                                </div>
                                <div class='card p-4'>
                                    <p class='text-justify'>Hít một hơi thật sâu và thở ra từ từ. Lưu ý không gian xung quanh bạn, trống rỗng nhưng đầy khả năng. Hãy tưởng tượng rằng mỗi lần thở ra sẽ xóa tan sự bối rối, tạo không gian cho sự sáng suốt.</p>
                                    <p class='text-justify'>Khi bạn ngồi với trang giấy trắng này, hãy biết rằng việc ở đây là điều bình thường. Bạn đã khám phá ra điều gì đó bất ngờ và đó là một phần của hành trình. Hãy nhẹ nhàng giải tỏa mọi sự thất vọng, biết rằng mọi con đường đều dẫn đến một nơi nào đó—kể cả con đường này.</p>
                                    <p class='text-justify'>Bây giờ, khi bạn đã sẵn sàng, hãy từ từ quay lại tìm kiếm của mình. Tin rằng đúng trang, đúng thông tin, sẽ xuất hiện khi bạn cần. Hít một hơi thật sâu nữa và khi bạn thở ra, hãy nhấp vào nút quay lại hoặc thử lại. Internet, giống như cuộc sống, luôn đầy bất ngờ.</p>
                                    <p class='text-justify'>Cảm ơn bạn đã dành thời gian bình tĩnh này. Hành trình của bạn vẫn tiếp tục.</p>
                                </div>
                            </div>
                            ";
                                break;
                        }
                    } else {
                        include 'getSach.php'; // Trang mặc định
                    }
                    ?>
                    <!-- footer -->
                    <?php include 'footer.php'; ?>