<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sách hay</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .short-desc {
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.5em;
        max-height: 4.5em;
    }

    .full-desc {
        display: none;
    }

    .card {
        display: flex;
        flex-direction: row;
        height: auto;
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }

    .card-body {
        flex: 2;
        text-align: left;
    }

    .image-container {
        flex: 1;
    }

    .right {
        display: flex;
        justify-content: right;
        gap: 5px;
    }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <?php
            // Kết nối cơ sở dữ liệu
            $conn = new mysqli("localhost", "root", "", "online_shop");
            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            // Xử lý xóa sách
            if (isset($_GET['delete'])) {
                $id_sach = $_GET['delete'];
                $stmt = $conn->prepare("DELETE FROM sach WHERE ID_SACH=?");
                $stmt->bind_param("i", $id_sach);
                $stmt->execute();
                $stmt->close();
            }

            // Hiển thị danh sách sách
            $result = $conn->query("SELECT s.*, ls.* FROM sach s JOIN loai_sanh ls ON ls.MA_LOAI = s.MA_LOAI");
            $counter = 0;
            while ($row = $result->fetch_assoc()) {
                if ($counter % 2 == 0 && $counter != 0) {
                    echo '</div><div class="row">'; // Kết thúc hàng cũ và bắt đầu hàng mới
                }
                echo '<div class="col-md-6 mb-3">'; 
                echo '<div class="card">';
                echo '<div class="image-container"><img src="hinhanh/' . $row['HINH_SACH'] . '" class="card-img-top" alt="Hình Sách"></div>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['TEN_SACH'] . '</h5>';
                echo '<p class="card-text"><strong>Loại Sách:</strong> ' . $row['TEN_LOAI'] . '</p>';
                echo '<p class="card-text"><strong>Tác Giả:</strong> ' . $row['TAC_GIA'] . '</p>';
                echo '<p class="card-text"><strong>Mô tả:</strong>';
                echo '<span class="short-desc">' . $row['MO_TA'] . '</span>';
                echo '<span class="full-desc">' . $row['MO_TA'] . '</span>';
                echo ' <button class="btn btn-link btn-sm toggle-desc">Xem thêm</button>';
                echo '</p>';
                echo '<p class="card-text"><strong>Số trang:</strong> ' . $row['SO_TRANG'] . '</p>';
                echo '<p class="card-text"><strong>Số lượng:</strong> ' . $row['SO_LUONG'] . '</p>';
                echo '<p class="card-text"><strong>Giá:</strong> ' . number_format($row['GIA'], 0, ',', '.') . ' VND</p>';
                echo '<div class="right">';
                echo '<a href="views/edit_book.php?edit=' . $row['ID_SACH'] . '" class="btn btn-warning btn-sm">Sửa</a>';
                echo '<a href="?delete=' . $row['ID_SACH'] . '" class="btn btn-danger btn-sm">Xóa</a>';
                echo '</div>';
                echo '</div>'; // card-body
                echo '</div>'; // card
                echo '</div>'; // col-md-6
                $counter++;
            }
            ?>
        </div> <!-- row -->
    </div> <!-- container -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-desc');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const cardText = this.parentElement;
                const shortDesc = cardText.querySelector('.short-desc');
                const fullDesc = cardText.querySelector('.full-desc');

                if (fullDesc.style.display === 'none') {
                    fullDesc.style.display = 'block';
                    shortDesc.style.display = 'none';
                    this.textContent = 'Thu gọn';
                } else {
                    fullDesc.style.display = 'none';
                    shortDesc.style.display = 'block';
                    this.textContent = 'Xem thêm';
                }
            });
        });
    });
    </script>
</body>

</html>