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
		<title>Thêm nhân viên - Quản lý nhân viên</title>
	</head>
	<body>
		<div class="container">
			<!-- Menu: sử dụng navbar -->
			<?php include 'navbar.php'; ?>
			
			<!-- Nội dung: sử dụng card -->
			<div class="card mt-3">
				<div class="card-header">Thêm nhân viên</div>
				<div class="card-body">
					<form action="nhanvien_them_xuly.php" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
						<div class="mb-3">
							<label for="MaNhanVien" class="form-label">Mã nhân viên</label>
							<input type="text" class="form-control" id="MaNhanVien" name="MaNhanVien" required />
							<div class="invalid-feedback">Mã nhân viên không được bỏ trống.</div>
						</div>
						<div class="mb-3">
							<label for="TenNhanVien" class="form-label">Tên nhân viên</label>
							<input type="text" class="form-control" id="TenNhanVien" name="TenNhanVien" required />
							<div class="invalid-feedback">Tên nhân viên không được bỏ trống.</div>
						</div>
						<div class="mb-3">
							<label for="NgaySinh" class="form-label">Ngày sinh</label>
							<input type="date" class="form-control" id="NgaySinh" name="NgaySinh" required />
							<div class="invalid-feedback">Ngày sinh không được bỏ trống.</div>
						</div>
						<div class="mb-3">
							<label for="GioiTinh" class="form-label">Giới Tính</label>
							<div class="form-check form-check-inline">
							  <input checked class="form-check-input" type="radio" name="GioiTinh" id="GioiTinh1" value="Nam">
							  <label class="form-check-label" for="GioiTinh1">Nam</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="GioiTinh" id="GioiTinh2" value="Nữ">
							  <label class="form-check-label" for="GioiTinh2">Nữ</label>
							</div>
						</div>
						
						<div class="mb-3">
							<label for="SDT" class="form-label">Số điện thoại</label>
							<input type="text" class="form-control" id="SDT" name="SDT" required />
							<div class="invalid-feedback">Điện thoại không được bỏ trống.</div>
						</div>
						<div class="mb-3">
							<label for="Email" class="form-label">Email</label>
							<input type="email" class="form-control" id="Email" name="Email" required />
							<div class="invalid-feedback">Email không được bỏ trống.</div>
						</div>
						<div class="mb-3">
							<label for="DiaChi" class="form-label">Địa chỉ</label>
							<textarea class="form-control" id="DiaChi" name="DiaChi" required></textarea>
							<div class="invalid-feedback">Địa chỉ không được bỏ trống.</div>
						</div>
						<div class="mb-3">
							<label for="Avatar" class="form-label">Ảnh đại diện</label>
							<input type="file" id="Avatar" name="Avatar" accept=".jpg, .png" multiple required />
							<!--<input type="text" class="form-control" id="Avatar" name="Avatar" required />-->
							<div class="invalid-feedback">Ảnh không được bỏ trống.</div>
						</div>
						<div class="mb-3">
							<label for="MaPhongBan" class="form-label">Phòng Ban</label>
							<select class="form-select" id="MaPhongBan" name="MaPhongBan" required>
								<option value="">-- Chọn --</option>
							</select>
							<div class="invalid-feedback">Phòng ban không được bỏ trống.</div>
						</div>
						<div class="mb-3">
							<label for="MaChucVu" class="form-label">Chức vụ</label>
							<select class="form-select" id="MaChucVu" name="MaChucVu" required>
								<option value="">-- Chọn --</option>
							</select>
							<div class="invalid-feedback">Chức vụ không được bỏ trống.</div>
						</div>
						
						<button type="submit" class="btn btn-primary">Thêm mới</button>
					</form>
				</div>
			</div>
			
			<!-- Footer: tự code -->
			<?php include 'footer.php'; ?>
		</div>
		
		<?php include 'javascript.php'; ?>
		<script type="module">
			import { getFirestore, collection, getDocs } from 'https://www.gstatic.com/firebasejs/9.7.0/firebase-firestore.js';
			const db = getFirestore();
			const querySnapshot = await getDocs(collection(db, 'phongban'));
			var output = '';
			querySnapshot.forEach((doc) => {
				output += '<option value="' + doc.id + '">' + doc.data().TenPhongBan + '</th>';
			});
			$('#MaPhongBan').append(output);			
		</script>
		<script type="module">
			import { getFirestore, collection, getDocs } from 'https://www.gstatic.com/firebasejs/9.7.0/firebase-firestore.js';
			const db = getFirestore();
			const querySnapshot = await getDocs(collection(db, 'chucvu'));
			var output = '';
			querySnapshot.forEach((doc) => {
				output += '<option value="' + doc.id + '">' + doc.data().TenChucVu + '</th>';
			});
			$('#MaChucVu').append(output);			
		</script>
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