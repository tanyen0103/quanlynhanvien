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
		<title>Xử lý thêm tin tức - Quản lý nhân viên</title>
	</head>
	<body>
		<div class="container">
			<!-- Menu: sử dụng navbar -->
			<?php include 'navbar.php'; ?>
			
			<!-- Nội dung: sử dụng card -->
			<div class="card mt-3">
				<div class="card-header">Xử lý thêm tin tức</div>
				<div class="card-body">
					
				</div>
			</div>
			
			<!-- Footer: tự code -->
			<?php include 'footer.php'; ?>
		</div>
		
		<?php include 'javascript.php'; ?>
		<script type="module">
			import { getFirestore, collection, addDoc, doc, Timestamp } from"https://www.gstatic.com/firebasejs/9.7.0/firebase-firestore.js";
			var db = getFirestore();
			var presentDate = new Date();
			var data = {
				TieuDe:`<?php echo $_POST['TieuDe']; ?>`,
				NoiDung:`<?php echo $_POST['NoiDung']; ?>`,
				NgayDang: Timestamp.fromDate(new Date()),
				MaNguoiDang: doc(db, 'nhanvien', '<?php echo $_SESSION['uid']; ?>'),
			};
			//Lệnh thêm
			await addDoc(collection(db, 'tintuc'), data);
			
			location.href = 'tintuc.php';
		</script>
	</body>
</html>