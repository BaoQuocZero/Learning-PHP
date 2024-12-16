<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    session_destroy();
    echo"<script language=javascript>
        alert('Bạn đã thoát khỏi hệ thống');
        window.location='index.php';
        </script>";
    ?>
</body>
</html>