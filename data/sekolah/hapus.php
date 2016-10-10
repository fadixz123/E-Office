<?php
require '../../include/koneksi.php';
$kode = isset($_GET['kode'])?$_GET['kode']:'';
$stmt = $db->prepare("DELETE FROM e_sekolah WHERE npsn=:kode");
$stmt->bindValue(':kode', $kode, PDO::PARAM_STR);
$stmt->execute();
$affected_rows = $stmt->rowCount();