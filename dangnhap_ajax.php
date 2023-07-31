<?php
	session_start();
	
	if(isset($_POST['uid']) && isset($_POST['TenNhanVien']))
	{
		$_SESSION['uid'] = $_POST['uid'];
		$_SESSION['TenNhanVien'] = $_POST['TenNhanVien'];
		$_SESSION['loai'] = $_POST['loai'];
		return true;
	}
	else
		return false;
?>