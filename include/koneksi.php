<?php
try{
	$db=new PDO("mysql:host=139.162.15.67;dbname=e_office;charset=utf8mb4","root","Allahcintaku99");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $ex){
	exit("Tidak dapat menyambungkan dengan database! ".$ex->getMessage());
}

function pos_kosong($label, &$var = null) {
	return empty($_POST[$label]) || ''===($var = trim($_POST[$label]));
}
