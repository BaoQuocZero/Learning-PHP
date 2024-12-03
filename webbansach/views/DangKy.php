<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Đăng Ký Thành Viên</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Trang Đăng Ký Thành Viên</h1>
        <form enctype="multipart/form-data" action="xly_dangky.php" name="frmdk" method="post" class="needs-validation"
            novalidate>
            <div class="mb-3">
                <label for="tendn" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="tendn" name="tendn" required>
                <div class="invalid-feedback">Vui lòng nhập tên đăng nhập.</div>
            </div>

            <div class="mb-3">
                <label for="matkhau" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="matkhau" name="matkhau" required>
                <div class="invalid-feedback">Vui lòng nhập mật khẩu.</div>
            </div>

            <div class="mb-3">
                <label for="hoten" class="form-label">Họ tên</label>
                <input type="text" class="form-control" id="hoten" name="hoten" required>
                <div class="invalid-feedback">Vui lòng nhập họ tên.</div>
            </div>

            <div class="mb-3">
                <label for="quocgia" class="form-label">Quốc gia</label>
                <select class="form-select" id="quocgia" name="quocgia">
                    <option value="Viet Nam" selected>Viet Nam</option>
                    <option value="China">China</option>
                    <option value="Japan">Japan</option>
                    <option value="Deutsches Reich">Deutsches Reich</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="hinhanh" class="form-label">Ảnh đại diện</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                <input type="file" class="form-control" id="hinhanh" name="hinhanh">
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" name="dangky" class="btn btn-primary">Đăng Ký</button>
                <button type="reset" class="btn btn-secondary">Làm Lại</button>
            </div>
        </form>
    </div>

    <!-- Link Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript validation -->
    <script>
    (function() {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
    </script>
</body>

</html>