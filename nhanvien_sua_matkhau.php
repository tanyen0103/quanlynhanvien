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
		<title>Đổi mật khẩu - Quản lý nhân viên</title>
		
	</head>
	<body>

		<div class="container">
			<!-- Menu: sử dụng navbar -->
			<?php include 'navbar.php'; ?>
			
			<!-- Nội dung: sử dụng card -->
			<div class="card mt-3">
				<div class="card-header">Đổi mật khẩu</div>
				<div class="card-body">
					<form action="nhanvien_sua_matkhau_xuly.php" method="post" class="needs-validation">	
						<div class="mb-3">
							<label for="MatKhau" class="form-label">Mật khẩu mới</label>
							<input type="password" class="form-control" id="MatKhau" name="MatKhau" required />
						</div>
						<div class="mb-3">
							<label for="NhapLaiMatKhau" class="form-label">Nhập lại mật khẩu mới</label>
							<input type="password" class="form-control" id="NhapLaiMatKhau" name="NhapLaiMatKhau" required />
						</div>
						
						
						<button type="submit" class="btn btn-primary" onclick="matchpass()">Cập nhật</button>
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
		<script type="text/javascript">  
			function matchpass()
			{  
				var firstpassword=MatKhau.value;  
				var secondpassword=NhapLaiMatKhau.value;  
				  
				if(firstpassword==secondpassword)
				{  
					return true;  
				}  
				else
				{  
					$('#MatKhau').val('');
					$('#NhapLaiMatKhau').val('');
					alert("Mật khẩu phải giống nhau!");  
					
					return false;  
				}  
			}  
		</script>
	</body>
</html>