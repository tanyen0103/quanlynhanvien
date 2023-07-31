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
	<title>Xử lý sửa nhân viên- Quản lý nhân viên</title>
</head>

<body>
	<div class="container">
		<!-- Menu: sử dụng navbar -->
		<?php include 'navbar.php'; ?>

		<!-- Nội dung: sử dụng card -->
		<div class="card mt-3">
			<div class="card-header">Xử lý sửa nhân viên</div>
			<div class="card-body">

			</div>
		</div>

		<!-- Footer: tự code -->
		<?php include 'footer.php'; ?>
	</div>

	<?php include 'javascript.php'; ?>

	<?php
	// Đã có dữ liệu upload, thực hiện xử lý file upload

	//Thư mục bạn sẽ lưu file upload
	$target_dir    = "images/";
	//Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
	$target_file   = $target_dir . basename($_FILES["Avatar"]["name"]);

	$allowUpload   = true;

	//Lấy phần mở rộng của file (jpg, png, ...)
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

	// Cỡ lớn nhất được upload (bytes)
	$maxfilesize   = 800000;

	////Những loại file được phép upload
	$allowtypes    = array('jpg', 'png');

	// Bạn có thể phát triển code để lưu thành một tên file khác
	if (file_exists($target_file)) {
		echo "Tên file đã tồn tại trên server, không được ghi đè";
		$allowUpload = false;
	}

	if ($allowUpload) {
		// Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
		if (move_uploaded_file($_FILES["Avatar"]["tmp_name"], $target_file)) {
			echo "File " . basename($_FILES["Avatar"]["name"]) .
				" Đã upload thành công.";

			echo "File lưu tại " . $target_file;
		} else {
			echo "Có lỗi xảy ra khi upload file.";
		}
	} else {
		echo "Không upload được file, có thể do file lớn, kiểu file không đúng ...";
	}
	?>

	<script type="module">
		import {
			getFirestore,
			doc,
			updateDoc
		} from 'https://www.gstatic.com/firebasejs/9.7.0/firebase-firestore.js';
		const db = getFirestore();
		const docRef = doc(db, 'nhanvien', '<?php echo $_POST['id']; ?>');

		await updateDoc(docRef, {
			MaNhanVien: '<?php echo $_POST['MaNhanVien']; ?>',
			MaPhongBan: doc(db, 'phongban', '<?php echo $_POST['MaPhongBan']; ?>'),
			TenNhanVien: '<?php echo $_POST['TenNhanVien']; ?>',
			GioiTinh: '<?php echo $_POST['GioiTinh']; ?>',
			Avatar: '<?php echo basename($_FILES["Avatar"]["name"]); ?>',
			NgaySinh: '<?php echo $_POST['NgaySinh']; ?>',
			MaChucVu: doc(db, 'chucvu', '<?php echo $_POST['MaChucVu']; ?>'),
			SDT: '<?php echo $_POST['SDT']; ?>',
			Email: '<?php echo $_POST['Email']; ?>',
			DiaChi: '<?php echo $_POST['DiaChi']; ?>',
		});
		location.href = 'nhanvien_xemthongtin.php';
	</script>
</body>

</html>