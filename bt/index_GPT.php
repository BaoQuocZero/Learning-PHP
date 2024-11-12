<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tri Thức</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Định dạng cho phần trên cùng */
        .header {
            background-color: #99cc66;
            text-align: center;
            padding: 20px;
        }
        .header h1 {
            color: orange;
            font-family: 'Arial', sans-serif;
        }
        .subtitle {
            text-align: center;
            color: orange;
            font-weight: bold;
        }
        
        /* Sidebar trái */
        .sidebar-left {
            background-color: #ccff99;
            height: 100%;
            padding-top: 20px;
        }
        .sidebar-left a {
            display: block;
            padding: 10px;
            color: green;
            font-weight: bold;
        }
        .sidebar-left a:hover {
            color: red;
        }

        /* Phần nội dung chính */
        .content {
            background-color: #ffffff;
            height: 100%;
            padding: 20px;
        }

        /* Sidebar phải */
        .sidebar-right {
            background-color: #ccff99;
            padding: 20px;
        }
        .sidebar-right label {
            color: orange;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #99cc66;
            color: #333;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row header">
        <div class="col-12">
            <h1>Tri Thức</h1>
            <p class="subtitle">Cùng bạn đi tìm tri thức!</p>
        </div>
    </div>
    <div class="row" style="height: 600px;">
        <div class="col-2 sidebar-left">
            <a href="#">Trang chủ</a>
            <a href="#" style="color: red;">Bài tập PHP căn bản</a>
            <a href="#">BT1 - Máy tính</a>
            <a href="#">BT2 - Giải PT bậc I một ẩn</a>
            <a href="#">BT3 - Giải PT bậc II một ẩn</a>
            <a href="#">BT4 - Tính diện tích</a>
            <a href="#">BT5 - Tam giác</a>
            <a href="#">BT6 - Số ngày trong tháng</a>
            <a href="#">BT7 - Bảng cửu chương</a>
            <a href="#">BT8 - Bảng cửu chương NC</a>
            <a href="#">BT9 - Số nguyên tố</a>
            <a href="#">BT10 - Ngày tháng hiện tại</a>
            <a href="#" style="color: red;">Bài tập PHP-MySQL</a>
            <a href="#">Đăng ký thành viên</a>
            <a href="#">Quản trị</a>
        </div>
        <div class="col-8 content">
            <h5>Trang chủ</h5>
            <p>Nội dung sẽ hiển thị ở đây.</p>
        </div>
        <div class="col-2 sidebar-right">
            <form>
                <div class="form-group">
                    <label for="username">Đăng nhập</label>
                    <input type="text" class="form-control" id="username" placeholder="Tên đăng nhập">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Mật khẩu">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                <button type="reset" class="btn btn-secondary btn-block">Hủy bỏ</button>
            </form>
        </div>
    </div>
    <div class="footer">
        <p>CopyRight© sachhay.com | Design by TrucMaiPham</p>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>