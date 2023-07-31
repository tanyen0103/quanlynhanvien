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
		<title>Quản lý nhân viên - Chức vụ</title>
	</head>
	<body>
		<div class="container">
			<!-- Menu: sử dụng navbar -->
			<?php include 'navbar.php'; ?>
			
			<!-- Nội dung: sử dụng card -->
			<div class="card mt-3">
				<div class="card-header">Chức vụ</div>
				<div class="card-body">
					<a href="chucvu_them.php" class="btn btn-success mb-2">Thêm mới</a>
					<table class="table table-bordered table-hover table-sm mb-0">
						<thead>
							<tr>
								<th width="35%">Mã chức vụ</th>
								<th width="55%">Tên chức vụ</th>
								<th width="5%">Sửa</th>
								<th width="5%">Xóa</th>
							</tr>
						</thead>
						<tbody id="HienThi">
							
						</tbody>
					</table>
				</div>
			</div>
			
			<!-- Footer: tự code -->
			<?php include 'footer.php'; ?>
		</div>
		
		<?php include 'javascript.php'; ?>
		<script type="module">
			import { getFirestore, collection, getDocs, query, orderBy } from 'https://www.gstatic.com/firebasejs/9.7.0/firebase-firestore.js';
			const db = getFirestore();
			const q = query(collection(db, 'chucvu'), orderBy('MaChucVu'));
			const querySnapshot = await getDocs(q);
			var output = '';
			querySnapshot.forEach((doc) => {
				output += '<tr>';
					output += '<td class="align-middle">' + doc.data().MaChucVu + '</td>';
					output += '<td class="align-middle">' + doc.data().TenChucVu + '</td>';
					output += '<td class="align-middle text-center"><a href="chucvu_sua.php?id=' + doc.id + '"><i class="bi bi-pencil-square"></i></a></td>';
					output += '<td class="align-middle text-center"><a onclick="return confirm(\'Bạn có muốn xóa chức vụ? ' + doc.data().TenChucVu + ' không?\')" href="chucvu_xoa.php?id=' + doc.id + '"><i class="bi bi-trash-fill"></i></a></td>';
				output += '</tr>';
			});
			$('#HienThi').html(output);
		</script>
	</body>
</html>