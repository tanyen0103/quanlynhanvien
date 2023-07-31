<nav class="navbar navbar-expand-lg navbar-dark bg-success">
	<div class="container-fluid">
		<a class="navbar-brand" href="index.php"><i class="bi bi-house-door-fill"></i> Trang chủ</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<?php
					
					session_start();
					if(!isset($_SESSION['uid'])){				
					
				?>		
				<li class="nav-item">
					<a class="nav-link" href="dangnhap.php">Đăng nhập</a>
				</li>
				</ul>
				<form class="d-flex" action="nhanvien_tim_chixem.php" method="get">
					<input id="timTen" name="timTen" class="form-control me-2" type="search" placeholder="Tìm nhân viên..." aria-label="Search">
					<button class="btn btn-outline-light" type="submit">Tìm</button>
				</form>
				<?php
					} else if ($_SESSION['loai']==1){
				?>
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="nhanvien_xemthongtin.php"><i class="bi bi-person-fill"></i> Thông tin nhân viên</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="dangxuat.php">Xin chào, <?php echo $_SESSION['TenNhanVien']; ?> [Đăng xuất]</a>
				</li>
				</ul>
				<form class="d-flex" action="nhanvien_tim_chixem.php" method="get">
					<input id="timTen" name="timTen" class="form-control me-2" type="search" placeholder="Tìm nhân viên..." aria-label="Search">
					<button class="btn btn-outline-light" type="submit">Tìm</button>
				</form>
				<?php
					} else {
				?>
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="nhanvien_xemthongtin.php"><i class="bi bi-person-fill"></i> Thông tin nhân viên</a>
				</li>
				
				<li class="nav-item dropdown">
					<a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="bi bi-gear-fill"></i> Quản lý
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="nhanvien.php">Nhân viên</a></li>
						<li><a class="dropdown-item" href="chucvu.php">Chức vụ</a></li>
						<li><a class="dropdown-item" href="phongban.php">Phòng ban</a></li><hr>
						<li><a class="dropdown-item" href="thongbao.php">Thông báo</a></li>
						<li><a class="dropdown-item" href="tintuc.php">Tin tức - sự kiện</a></li>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="dangxuat.php">Xin chào, <?php echo $_SESSION['TenNhanVien']; ?> [Đăng xuất]</a>
				</li>
				</ul>
				<form class="d-flex" action="nhanvien_tim.php" method="get">
					<input id="timTen" name="timTen" class="form-control me-2" type="search" placeholder="Tìm nhân viên..." aria-label="Search">
					<button class="btn btn-outline-light" type="submit">Tìm</button>
				</form>
				<?php
					}
				?>
			
		</div>
	</div>
</nav>