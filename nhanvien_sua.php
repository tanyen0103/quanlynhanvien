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
		<title>Sửa nhân viên - Quản lý nhân viên</title>
		
	</head>
	<body>

		<div class="container">
			<!-- Menu: sử dụng navbar -->
			<?php include 'navbar.php'; ?>
			
			<!-- Nội dung: sử dụng card -->
			<div class="card mt-3">
				<div class="card-header">Sửa nhân viên</div>
				<div class="card-body">
					<form action="nhanvien_sua_xuly.php" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
						<input type="text" id="id" name="id" hidden />
						
						<div class="mb-3">
							<label for="MaNhanVien" class="form-label">Mã nhân viên</label>
							<input type="text" class="form-control" id="MaNhanVien" name="MaNhanVien" required />
						</div>
						<div class="mb-3">
							<label for="TenNhanVien" class="form-label">Tên nhân viên</label>
							<input type="text" class="form-control" id="TenNhanVien" name="TenNhanVien" required />
						</div>
						<div class="mb-3">
							<label for="NgaySinh" class="form-label">Ngày sinh</label>
							<input type="date" class="form-control" id="NgaySinh" name="NgaySinh" required />
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
						</div>
						<div class="mb-3">
							<label for="Email" class="form-label">Email</label>
							<input type="email" class="form-control" id="Email" name="Email" required />

						</div>
						<div class="mb-3">
							<label for="DiaChi" class="form-label">Địa chỉ</label>
							<textarea class="form-control" id="DiaChi" name="DiaChi" required></textarea>
						</div>
						<div class="mb-3">
							<label for="Avatar" class="form-label">Ảnh đại diện</label>
							<input type="file" id="Avatar" name="Avatar" accept=".jpg, .png" multiple required />
						</div>
						<div class="mb-3">
							<label for="MaPhongBan" class="form-label">Phòng Ban</label>
							<select class="form-select" id="MaPhongBan" name="MaPhongBan" required>
								<option value="">-- Chọn --</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="MaChucVu" class="form-label">Chức vụ</label>
							<select class="form-select" id="MaChucVu" name="MaChucVu" required>
								<option value="">-- Chọn --</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="LoaiTaiKhoan" class="form-label">Loại tài khoản</label>
							<select class="form-select" id="LoaiTaiKhoan" name="LoaiTaiKhoan" required>
								<option value="">-- Chọn --</option>
								<option value="1">Người dùng</option>
								<option value="0">Quản trị viên</option>
							</select>
						</div>
						
						<button type="submit" class="btn btn-primary">Cập nhật</button>
					</form>
				</div>
			</div>
			
			<!-- Footer: tự code -->
			<?php include 'footer.php'; ?>
		</div>
		
		<?php include 'javascript.php'; ?>
		<script type="module">
			import { getFirestore, doc, collection, getDocs, getDoc } from 'https://www.gstatic.com/firebasejs/9.7.0/firebase-firestore.js';
			const db = getFirestore();
			const phongBan = await getDocs(collection(db, 'phongban'));
			var output = '';
			phongBan.forEach((d) => {
				output += '<option value="' + d.id + '">' + d.data().TenPhongBan + '</option>';
			});
			$('#MaPhongBan').append(output);
			
			const chucVu = await getDocs(collection(db, 'chucvu'));
			var output = '';
			chucVu.forEach((d) => {
				output += '<option value="' + d.id + '">' + d.data().TenChucVu + '</option>';
			});
			$('#MaChucVu').append(output);
				
						
			const docRef = doc(db, 'nhanvien', '<?php echo $_GET['id']; ?>');
			const docSnap = await getDoc(docRef);
			if (docSnap.exists()) {
				const pb = await getDoc(docSnap.data().MaPhongBan);
				const cv = await getDoc(docSnap.data().MaChucVu);
				$('#id').val(docSnap.id);
				$('#MaNhanVien').val(docSnap.data().MaNhanVien);
				$('#MaPhongBan').val(pb.id);
				$('#MaChucVu').val(cv.id);
				$('#TenNhanVien').val(docSnap.data().TenNhanVien);
				$('#NgaySinh').val(docSnap.data().NgaySinh);
				$('#SDT').val(docSnap.data().SDT);
				$('#Email').val(docSnap.data().Email);
				$('#DiaChi').val(docSnap.data().DiaChi);
				$('#LoaiTaiKhoan').val(docSnap.data().LoaiTaiKhoan);
				if(docSnap.data().GioiTinh == 'Nam')
					$('#GioiTinh1').prop("checked", true);
				else
					$('#GioiTinh2').prop("checked", true);
			} else {
				console.log('No such document!');
			}
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