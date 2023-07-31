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
		<title>Quản lý nhân viên - Tìm</title>
	</head>
	<body>
		<div class="container">
			<!-- Menu: sử dụng navbar -->
			<?php include 'navbar.php'; ?>
			
			<!-- Nội dung: sử dụng card -->
			<div class="card mt-3">
				<div class="card-header">Nhân viên</div>
				<div class="card-body">
					<a href="nhanvien_them.php" class="btn btn-success mb-2">Thêm mới</a>
					<table class="table table-bordered table-hover table-sm mb-0">
						<thead>
							<tr>
								<th width="15%">Mã nhân viên</th>
								<th width="25%">Tên nhân viên</th>
								<th width="20%">Phòng ban</th>		
								<th width="20%">Chức vụ</th>									
								<th width="5%" class="align-middle text-center">Sửa</th>
								<th width="5%" class="align-middle text-center">Xóa</th>
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
			import { getFirestore, collection, getDocs, getDoc } from 'https://www.gstatic.com/firebasejs/9.7.0/firebase-firestore.js';
			const db = getFirestore();
			
			async function getDanhSachDiaDiem() {
				const querySnapshot = await getDocs(collection(db, 'nhanvien'));
				const promises = querySnapshot.docs.map(doc => getRefData(doc));
				return Promise.all(promises)
			}
			
			async function getRefData(doc) {
				var nhanVien = doc.data();
				nhanVien.id = doc.id;
				var phongBan = await getDoc( nhanVien.MaPhongBan);
				nhanVien.Phong = { ...phongBan.data() };
				var chucVu = await getDoc( nhanVien.MaChucVu);
				nhanVien.CV = { ...chucVu.data() };
				return  nhanVien;
			}
			
			await getDanhSachDiaDiem().then(results => {
				var output = '';
				
				results.forEach((d) => {
					var str = '<?php echo $_GET['timTen']; ?>';
					var ten = d.TenNhanVien;
					if(ten.toLowerCase().includes(str.toLowerCase()))
					{
						output += '<tr>';
						output += '<td class="align-middle">' + d.MaNhanVien + '</td>';
						output += '<td class="align-middle">' + d.TenNhanVien + '</td>';
						output += '<td class="align-middle">' + d.Phong.TenPhongBan + '</td>';
						output += '<td class="align-middle">' + d.CV.TenChucVu + '</td>';
						output += '<td class="align-middle text-center"><a href="nhanvien_sua.php?id=' + d.id + '"><i class="bi bi-pencil-square"></i></a></td>';
						output += '<td class="align-middle text-center"><a onclick="return confirm(\'Bạn có muốn xóa nhanvien ' + d.TenNhanVien + ' không?\')" href="nhanvien_xoa.php?id=' + d.id + '"><i class="bi bi-trash-fill"></i></a></td>';
						output += '</tr>';
					}
					
				});
				$('#HienThi').html(output);
			});
		</script>
	</body>
</html>