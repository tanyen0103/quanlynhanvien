<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
		<link rel="stylesheet" href="css/style.css">
		<link rel="shortcut icon" href="images/icon.png">
		<title>Đăng nhập - Quản lý nhân viên</title>
	</head>
	<body>
		<div class="container">
			<!-- Menu: sử dụng navbar -->
			<?php include 'navbar.php'; ?>
			
			<!-- Nội dung: sử dụng card -->
			<div class="card mt-3">
				<div class="card-header">Đăng nhập</div>
				<div class="card-body">
					<form action="dangnhap_xuly.php" method="post" class="needs-validation" novalidate>
						<div class="mb-3">
							<label for="TenDangNhap" class="form-label">Tên đăng nhập</label>
							<input type="text" class="form-control" id="TenDangNhap" name="TenDangNhap" required />
							<div class="invalid-feedback">Tên đăng nhập không được bỏ trống.</div>
						</div>
						<div class="mb-3">
							<label for="password" class="form-label">Mật khẩu</label>
							<input type="password" class="form-control" id="password" name="password" required />
							<div class="invalid-feedback">Mật khẩu không được bỏ trống.</div>
						</div>
						
						<button type="submit" class="btn btn-primary">Đăng nhập</button>
					</form>
				</div>
			</div>
			
			<!-- Footer: tự code -->
			<?php include 'footer.php'; ?>
		</div>
		
		<?php include 'javascript.php'; ?>
		<script>
			(function() {
				'use strict';
				var forms = document.querySelectorAll('.needs-validation');
				Array.prototype.slice.call(forms).forEach(function(form) {
					form.addEventListener('submit', function(event) {
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