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

                            case 'profile':
                                include 'views/profile.php';
                                break;

<<<<<<< HEAD
                            case 'logout':
                                include 'views/logout.php';
                                break;

=======
>>>>>>> 241fe5b55f4431084a04ec2e836ab87306f0f38d
                            // Thêm các case khác nếu cần
                            default:
                                echo "<p>Nội dung không tồn tại.</p>";
                                break;
                        }
                    } else {
                        include 'views/getSach.php'; // Trang mặc định
                    }
                    ?>