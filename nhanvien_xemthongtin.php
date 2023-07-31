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
		<title>Quản lý nhân viên - Xem thông tin</title>
		<style>
			p {
			  font-size: 16pt;
			  margin: 10px;
			}
			img {
			 margin: 20px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<!-- Menu: sử dụng navbar -->
			<?php include 'navbar.php'; ?>
			
			<!-- Nội dung: sử dụng card -->
			<div class="card mt-3">
				<div class="card-header bg-success text-dark bg-opacity-10"><b>THÔNG TIN NHÂN VIÊN</b></div>
				<div class="card-body">	
					<div id = "HienThi">			
					</div>	
					<hr>
					<a href="nhanvien_sua_nguoidung.php?id=<?php echo $_SESSION['uid']; ?>" class="btn btn-success mb-2 position-relative"><i class="bi bi-pencil-square"></i> Sửa thông tin</a>
					<a href="nhanvien_sua_matkhau.php" class="btn btn-success mb-2 position-relative"><i class="bi bi-arrow-repeat"></i> Đổi mật khẩu</a>
					
				</div>	
					
			</div>
			
			<!-- Footer: tự code -->
			<?php include 'footer.php'; ?>
		</div>
		<?php include 'javascript.php'; ?>
		<script type="module">
			import { getFirestore, collection, getDocs, getDoc } from 'https://www.gstatic.com/firebasejs/9.7.0/firebase-firestore.js';
			const db = getFirestore();
			
			async function getDanhSachNhanVien() {
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
			
			await getDanhSachNhanVien().then(results => {
				var output = '';
				
				results.forEach((d) => {
					if(d.id == '<?php echo $_SESSION['uid']; ?>')
					{
						output += '<img class = "AnhDaiDien" src="images/' + d.Avatar + '" align="left" width="250" alt="Hình đại diện">';
						output += '<p><b>Mã nhân viên: </b>' + d.MaNhanVien + '</p>';
						output += '<p><b>Họ và tên: </b>' + d.TenNhanVien + '</p>';
						output += '<p><b>Ngày sinh: </b>' + d.NgaySinh + '</p>';
						output += '<p><b>Giới Tính: </b>' + d.GioiTinh + '</p>';
						output += '<p><b>Số điện thoại: </b>' + d.SDT + '</p>';
						output += '<p><b>Email: </b>' + d.Email + '</p>';
						output += '<p><b>Địa chỉ: </b>' + d.DiaChi + '</p>';
						output += '<p><b>Phòng ban: </b>' + d.Phong.TenPhongBan + '</p>';
						output += '<p><b>Chức vụ: </b>' + d.CV.TenChucVu + '</p>';
					
					$('#HienThi').html(output);
					}					
				});
				
			});
		</script>
		
	</body>
</html>