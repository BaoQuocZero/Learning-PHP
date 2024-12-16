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

    /* Đảm bảo ảnh giữ tỷ lệ đúng và có chiều cao cố định */
    .card-img-top {
        height: 200px;
        width: 100%;
        object-fit: cover;
        /* Giữ tỷ lệ ảnh, cắt phần dư */
    }

    .card-body {
        text-align: initial;
    }

    .right {
        width: 100%;
        display: flex;
        justify-content: right;
        gap: 5px;
    }
    </style>
</head>

<body>

    <div class="container mt-4">
        <!-- Nút Thêm Sách -->
        <!-- <a href="create_book.php" class="btn btn-success mb-3">Thêm Sách</a> -->

        <div class="row">
            <?php
            // Kết nối cơ sở dữ liệu
            $conn = new mysqli("localhost", "root", "", "online_shop");
            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            // Xử lý xóa sách
            if (isset($_GET['deletee'])) {
                $id_sach = $_GET['deletee'];
                $stmt = $conn->prepare("DELETE FROM sach WHERE ID_SACH=?");
                $stmt->bind_param("i", $id_sach);
                $stmt->execute();
                $stmt->close();
            }

            // Đặt số sách trên mỗi trang
            $books_per_page = 4;

            // Tính số sách tổng cộng
            $total_books_result = $conn->query("SELECT COUNT(*) AS total FROM sach");
            $total_books_row = $total_books_result->fetch_assoc();
            $total_books = $total_books_row['total'];

            // Tính số trang
            $page = isset($_GET['page_number']) ? (int)$_GET['page_number'] : 1; // Trang hiện tại

            // Giả sử có tổng số trang
            $total_pages = ceil($total_books / $books_per_page); // Tính số trang dựa trên tổng sách

            // Nếu trang nhỏ hơn 1, đặt lại thành trang 1
            if ($page < 1) {
                $page = 1;
            }

            // Tính toán OFFSET
            $offset = ($page - 1) * $books_per_page;

            // Lấy danh sách sách với phân trang
            $query = "SELECT s.*, ls.* FROM sach s JOIN loai_sanh ls ON ls.MA_LOAI = s.MA_LOAI LIMIT ?, ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $offset, $books_per_page);
            $stmt->execute();
            $result = $stmt->get_result();

            // Hiển thị danh sách sách
            $counter = 0;
            while ($row = $result->fetch_assoc()) {
                // Mỗi sách sẽ được hiển thị trong một cột
                echo '<div class="col-md-6 mb-3">'; // Mỗi sách chiếm 6 cột (50% chiều rộng)
                echo '<div class="card" style="width: 100%;">';
                echo '<div><img src="hinhanh/' . $row['HINH_SACH'] . '" class="card-img-top" style="height: 200px; width: auto; max-width: 100%;" alt="Hình Sách"></div>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['TEN_SACH'] . '</h5>';
                echo '<p class="card-text"><strong>Loại Sách:</strong> ' . $row['TEN_LOAI'] . '</p>';
                echo '<p class="card-text"><strong>Tác Giả:</strong> ' . $row['TAC_GIA'] . '</p>';
                echo '<p class="card-text"><strong>Mô tả:</strong> ';
                echo '<span class="short-desc">' . $row['MO_TA'] . '</span>';
                echo '<span class="full-desc" style="display: none;">' . $row['MO_TA'] . '</span>';
                echo ' <button class="btn btn-link btn-sm toggle-desc">Xem thêm</button>';
                echo '</p>';

                echo '<p class="card-text"><strong>Số trang:</strong> ' . $row['SO_TRANG'] . '</p>';
                echo '<p class="card-text"><strong>Số lượng:</strong> ' . $row['SO_LUONG'] . '</p>';
                echo '<p class="card-text"><strong>Giá:</strong> ' . number_format($row['GIA'], 0, ',', '.') . ' VND</p>';
                echo '<div class="right">';

                if (isset($_SESSION['nguoidung']) && !empty($_SESSION['nguoidung'])) {
                    echo '<a href="xly_giohang.php?giohang=' . $row['ID_SACH'] . '&username=' . $_SESSION['nguoidung'] . '" class="btn btn-success btn-sm">Thêm giỏ hàng</a>';
                }
                if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
                    echo '<a href="edit_book.php?edit=' . $row['ID_SACH'] . '" class="btn btn-warning btn-sm">Sửa</a>';
                    echo '<a href="?deletee=' . $row['ID_SACH'] . '" class="btn btn-danger btn-sm">Xóa</a>';
                }

                echo '</div>';
                echo '</div>'; // card-body
                echo '</div>'; // card
                echo '</div>'; // col-md-6
            }

            ?>
        </div> <!-- row -->

        <!-- Phân trang -->
        <div class="pagination">
            <?php
            // Hiển thị phân trang
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    echo '<span class="btn btn-secondary btn-sm">' . $i . '</span>';
                } else {
                    echo '<a href="?page_number=' . $i . '" class="btn btn-primary btn-sm">' . $i . '</a>';
                }
            }
            ?>
        </div>

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