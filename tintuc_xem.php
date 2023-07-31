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
		<title>Quản lý nhân viên - Xem tin tức</title>
		
	</head>
	<body>
		<div class="container">
			<!-- Menu: sử dụng navbar -->
			<?php include 'navbar.php'; ?>
			
			<!-- Nội dung: sử dụng card -->
			<div class="card mt-3">
				<div class="card-header bg-success text-dark bg-opacity-10" id = "TieuDe"></div>
				<div class="card-body">	
					<div id = "HienThi">			
					</div>	
					
				</div>	
					
			</div>
			
			<!-- Footer: tự code -->
			<?php include 'footer.php'; ?>
		</div>
		<?php include 'javascript.php'; ?>
		<script type="module">
			import { getFirestore, doc, getDoc } from 'https://www.gstatic.com/firebasejs/9.7.0/firebase-firestore.js';
			const db = getFirestore();
			const docRef = doc(db, 'tintuc', '<?php echo $_GET['id']; ?>');
			const docSnap = await getDoc(docRef);
			var output = '';
			var tieuDe = '';
			if (docSnap.exists()) {
				tieuDe += '<b>'+docSnap.data().TieuDe+'</b>';
				output += '<pre>'+docSnap.data().NoiDung+'</pre>';
				var ngay = docSnap.data().NgayDang.toDate().toDateString();
				output += '<br><p>Ngày đăng: '+ngay+'</p>';
			} else {
				console.log('No such document!');
			}
			$('#TieuDe').html(tieuDe);
			$('#HienThi').html(output);
		</script>
	</body>
</html>