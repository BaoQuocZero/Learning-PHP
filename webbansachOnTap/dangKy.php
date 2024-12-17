<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<section class="mb-4">
    <h2 class="mb-3">Đăng ký</h2>
    <form method="POST" action="xly_dangky.php" enctype="multipart/form-data">
        <!-- Email Input -->
        <div class="mb-3">
            <label for="exampleInputEmail" class="form-label">Nhập username (email)</label>
            <input type="text" class="form-control" name="username" id="exampleInputEmail" placeholder="Nhập email"
                required>
        </div>

        <!-- Password Input -->
        <div class="mb-3">
            <label for="exampleInputPassword" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword"
                placeholder="Nhập mật khẩu" required>
        </div>

        <!-- Họ Tên Input -->
        <div class="mb-3">
            <label for="fullName" class="form-label">Họ và tên</label>
            <input type="text" class="form-control" name="hoten" id="fullName" placeholder="Nhập họ và tên" required>
        </div>

        <!-- Giới Tính -->
        <div class="mb-3">
            <label class="form-label">Giới tính</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gioitinh" id="male" value="Nam" checked>
                <label class="form-check-label" for="male">Nam</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gioitinh" id="female" value="Nữ">
                <label class="form-check-label" for="female">Nữ</label>
            </div>
        </div>

        <!-- Quốc Gia Input -->
        <div class="mb-3">
            <label for="country" class="form-label">Quốc gia</label>
            <select class="form-select" name="quocgia" id="exampleSelect">
                <option value="Việt Nam" selected>Việt Nam</option>
                <option value="Sao Hỏa">Sao Hỏa</option>
            </select>
        </div>

        <!-- Hình Đại Diện Input -->
        <div class="mb-3">
            <label for="profileImage" class="form-label">Hình đại diện</label>
            <input type="file" class="form-control" name="hinhdaidien" id="profileImage" accept="image/*" required>
        </div>

        <!-- Chọn Quyền -->
        <div class="mb-3">
            <label for="exampleSelect" class="form-label">Chọn quyền của bạn</label>
            <select class="form-select" name="role" id="exampleSelect">
                <option value="user" selected>Người dùng</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Đăng ký</button>
    </form>
</section>