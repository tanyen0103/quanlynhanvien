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
		<title>Sửa phòng ban - Quản lý nhân viên</title>
	</head>
	<body>
		<div class="container">
			<!-- Menu: sử dụng navbar -->
			<?php include 'navbar.php'; ?>
			
			<!-- Nội dung: sử dụng card -->
			<div class="card mt-3">
				<div class="card-header">Sửa phòng ban</div>
				<div class="card-body">
					<form action="phongban_sua_xuly.php" method="post" class="needs-validation" novalidate>
						<input type="text" id="id" name="id" hidden />
						<div class="mb-3">
							<label for="MaPhongBan" class="form-label">Mã phòng ban</label>
							<input type="text" class="form-control" id="MaPhongBan" name="MaPhongBan" required />
							<div class="invalid-feedback">Mã phòng ban không được bỏ trống.</div>
						</div>
						<div class="mb-3">
							<label for="TenPhongBan" class="form-label">Tên phòng ban</label>
							<input type="text" class="form-control" id="TenPhongBan" name="TenPhongBan" required />
							<div class="invalid-feedback">Tên phòng ban không được bỏ trống.</div>
						</div>
						
						<button type="submit" class="btn btn-primary">Cập nhật</button>
					</form>
				</div>
			</div>
			
			<!-- Footer: tự code -->
			<?php include 'footer.php'; ?>
		</div>
		
		<?php include 'javascript.php'; ?>

		<!--Xử lý tìm theo id trên cơ sở dữ liệu -->
		<script type="module">
			import { getFirestore, doc, getDoc } from 'https://www.gstatic.com/firebasejs/9.7.0/firebase-firestore.js';
			const db = getFirestore();
			const docRef = doc(db, 'phongban', '<?php echo $_GET['id']; ?>');
			const docSnap = await getDoc(docRef);
			if (docSnap.exists()) {
				$('#id').val(docSnap.id);
				$('#MaPhongBan').val(docSnap.data().MaPhongBan);
				$('#TenPhongBan').val(docSnap.data().TenPhongBan);
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