<?php
$conn = new mysqli("localhost", "root", "", "online_shop");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>