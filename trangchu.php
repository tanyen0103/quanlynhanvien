
<div class="row">
	<div class="float-start" style="width: 35%;">
		<div class="card mt-3">
		  <div class="card-body overflow-auto" style="height: 300px";>
			<h5 class="card-title"><i class="bi bi-newspaper"></i> Tin tức - Sự kiện</h5>
			<ul class="list-group list-group-flush" id="HienThiTinTuc">
			  
			  
			</ul>
		  </div>
		</div>
		<div class="card mt-3" >
		  <div class="card-body overflow-auto" style="height: 300px">
			<h5 class="card-title"><i class="bi bi-bell"></i> Thông báo</h5>
			<ul class="list-group list-group-flush" id="HienThiThongBao">
			
			</ul>
		  </div>
		</div>
	</div>
	<div class="float-end" style="width: 65%;">	
		<div class="card mt-3" >
		  <div class="card-body">
			<h5 class="card-title"><i class="bi bi-globe2"></i> Tổng quan</h5>
			<p class="card-text"></p>
			
		  </div>
		</div>
		  <div class="card mt-3" >
		  <div class="card-body overflow-auto" style="height: 700px;">
			<h5 class="card-title"><i class="bi bi-list-ul"></i> Danh sách nhân viên</h5>
			
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th width="10%">STT</th>
							<th width="40%">Họ tên nhân viên</th>
							<th width="25%">Phòng ban</th>
							<th width="25%">Chức vụ</th>
						</tr>
					</thead>
					<tbody id="HienThi">
						
					</tbody>
				</table>
				
		  </div>
		</div>
	</div>	
</div>

		<script type="module">
			import { getFirestore, collection, getDocs, getDoc, query, orderBy } from 'https://www.gstatic.com/firebasejs/9.7.0/firebase-firestore.js';
			const db = getFirestore();
			
			async function getDanhSachNhanVien() {
				const q = query(collection(db, 'nhanvien'), orderBy('TenNhanVien'));
				const querySnapshot = await getDocs(q);
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
				var stt = 1;
				results.forEach((d) => {
					output += '<tr>';
						output += '<td class="align-middle">' + stt++ + '</td>';
						output += '<td class="align-middle">' + d.TenNhanVien + '</td>';
						output += '<td class="align-middle">' + d.Phong.TenPhongBan + '</td>';
						output += '<td class="align-middle">' + d.CV.TenChucVu + '</td>';
					output += '</tr>';
					
				});
				$('#HienThi').html(output);
			});
		</script>
		
		<script type="module">
			import { getFirestore, collection, getDocs, query, orderBy } from 'https://www.gstatic.com/firebasejs/9.7.0/firebase-firestore.js';
			const db = getFirestore();
			const q = query(collection(db, 'tintuc'), orderBy('NgayDang', 'desc'));
			const querySnapshot = await getDocs(q);
			var output = '';
			querySnapshot.forEach((doc) => {
				output += '<li class="list-group-item">';
					output += '<a href="tintuc_xem.php?id='+doc.id+'">'+doc.data().TieuDe+'</a>';
				output += '</li>';
			});
			$('#HienThiTinTuc').html(output);
		</script>
		
		<script type="module">
			import { getFirestore, collection, getDocs, query, orderBy } from 'https://www.gstatic.com/firebasejs/9.7.0/firebase-firestore.js';
			const db = getFirestore();
			const q = query(collection(db, 'thongbao'), orderBy('NgayDang', 'desc'));
			const querySnapshot = await getDocs(q);
			var output = '';
			querySnapshot.forEach((doc) => {
				output += '<li class="list-group-item">';
					output += '<a href="thongbao_xem.php?id='+doc.id+'">'+doc.data().TieuDe+'</a>';
				output += '</li>';
			});
			$('#HienThiThongBao').html(output);
		</script>