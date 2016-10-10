<?php
require '../../include/koneksi.php';
if(isset($_GET['diagram-surat'])){
	$pilih = $db->query("SELECT 
	(SELECT COUNT(tanggal) FROM e_surat_masuk where tanggal LIKE '%januari 2016') as Januari,
	(SELECT COUNT(tanggal) FROM e_surat_masuk where tanggal LIKE '%februari 2016') as Februari,
	(SELECT COUNT(tanggal) FROM e_surat_masuk where tanggal LIKE '%maret 2016') as Maret,
	(SELECT COUNT(tanggal) FROM e_surat_masuk where tanggal LIKE '%april 2016') as April,
	(SELECT COUNT(tanggal) FROM e_surat_masuk where tanggal LIKE '%mei 2016') as mei,
	(SELECT COUNT(tanggal) FROM e_surat_masuk where tanggal LIKE '%juni 2016') as Juni,
	(SELECT COUNT(tanggal) FROM e_surat_masuk where tanggal LIKE '%juli 2016') as Juli,
	(SELECT COUNT(tanggal) FROM e_surat_masuk where tanggal LIKE '%agustus 2016') as agustus,
	(SELECT COUNT(tanggal) FROM e_surat_masuk where tanggal LIKE '%september 2016') as September,
	(SELECT COUNT(tanggal) FROM e_surat_masuk where tanggal LIKE '%oktober 2016') as Oktober,
	(SELECT COUNT(tanggal) FROM e_surat_masuk where tanggal LIKE '%november 2016') as November,
	(SELECT COUNT(tanggal) FROM e_surat_masuk where tanggal LIKE '%desember 2016') as Desember,
	(SELECT COUNT(tanggal) FROM e_surat_keluar where tanggal LIKE '%januari 2016') as Januari,
	(SELECT COUNT(tanggal) FROM e_surat_keluar where tanggal LIKE '%februari 2016') as Februari,
	(SELECT COUNT(tanggal) FROM e_surat_keluar where tanggal LIKE '%maret 2016') as Maret,
	(SELECT COUNT(tanggal) FROM e_surat_keluar where tanggal LIKE '%april 2016') as April,
	(SELECT COUNT(tanggal) FROM e_surat_keluar where tanggal LIKE '%mei 2016') as mei,
	(SELECT COUNT(tanggal) FROM e_surat_keluar where tanggal LIKE '%juni 2016') as Juni,
	(SELECT COUNT(tanggal) FROM e_surat_keluar where tanggal LIKE '%juli 2016') as Juli,
	(SELECT COUNT(tanggal) FROM e_surat_keluar where tanggal LIKE '%agustus 2016') as agustus,
	(SELECT COUNT(tanggal) FROM e_surat_keluar where tanggal LIKE '%september 2016') as September,
	(SELECT COUNT(tanggal) FROM e_surat_keluar where tanggal LIKE '%oktober 2016') as Oktober,
	(SELECT COUNT(tanggal) FROM e_surat_keluar where tanggal LIKE '%november 2016') as November,
	(SELECT COUNT(tanggal) FROM e_surat_keluar where tanggal LIKE '%desember 2016') as Desember");

	$pilih->execute();
	$data = array();
	foreach ($pilih as $row) {
		$data[] = $row;
	}
	print json_encode($data);
}
if(isset($_GET['info-box'])){
	$pilih = $db->query("SELECT 
(SELECT COUNT(*) FROM e_surat_masuk) as masuk,
(SELECT COUNT(*) FROM e_surat_masuk where tanggal_disposisi='') as pending_masuk,
(SELECT COUNT(*) FROM e_surat_keluar) as keluar,
(SELECT COUNT(*) FROM e_surat_keluar where tanggal_disposisi='') as pending_kluar,
(SELECT COUNT(*) FROM e_cuti) as cuti,
(SELECT COUNT(*) FROM e_cuti where status='Pending') as pending_cuti,
(SELECT COUNT(*) FROM e_gedung) as gedung,
(SELECT COUNT(*) FROM e_gedung where status='Pending') as pending_gedung
");
	$pilih->execute();
	$data = array();
	foreach ($pilih as $row) {
		$data[] = $row;
	}
	print json_encode($data);
}

if(isset($_GET['jumlah-sekolah'])){
	$pilih = $db->query("SELECT 
(SELECT COUNT(jenjang) FROM e_sekolah where jenjang='SD') as sd,
(SELECT COUNT(jenjang) FROM e_sekolah where jenjang='SDLB') as sdlb,
(SELECT COUNT(jenjang) FROM e_sekolah where jenjang='SLB') as slb,
(SELECT COUNT(jenjang) FROM e_sekolah where jenjang='SMP') as smp,
(SELECT COUNT(jenjang) FROM e_sekolah where jenjang='SMA') as sma,
(SELECT COUNT(jenjang) FROM e_sekolah where jenjang='SMK') as smk");
	$pilih->execute();
	$data = array();
	foreach ($pilih as $row) {
		$data[] = $row;
	}
	print json_encode($data);
}

if(isset($_GET['akreditasi'])){
	$pilih = $db->query("SELECT 
(SELECT COUNT(*) FROM e_sekolah where jenjang='SD' AND akreditasi='a' ) as sd_a,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SD' AND akreditasi='b' ) as sd_b,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SD' AND akreditasi='c' ) as sd_c,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SD' AND akreditasi='Belum Terakreditasi' ) as sd_belum,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SD' AND akreditasi='Tidak Terakreditasi' ) as sd_tidak,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SDLB' AND akreditasi='a' ) as SDLB_a,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SDLB' AND akreditasi='b' ) as SDLB_b,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SDLB' AND akreditasi='c' ) as SDLB_c,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SDLB' AND akreditasi='Belum Terakreditasi' ) as SDLB_belum,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SDLB' AND akreditasi='Tidak Terakreditasi' ) as SDLB_tidak,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SLB' AND akreditasi='a' ) as SLB_a,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SLB' AND akreditasi='b' ) as SLB_b,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SLB' AND akreditasi='c' ) as SLB_c,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SLB' AND akreditasi='Belum Terakreditasi' ) as SLB_belum,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SLB' AND akreditasi='Tidak Terakreditasi' ) as SLB_tidak,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SMP' AND akreditasi='a' ) as SMP_a,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SLB' AND akreditasi='b' ) as SMP_b,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SMP' AND akreditasi='c' ) as SMP_c,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SMP' AND akreditasi='Belum Terakreditasi' ) as SMP_belum,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SMP' AND akreditasi='Tidak Terakreditasi' ) as SMP_tidak,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SMA' AND akreditasi='a' ) as SMA_a,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SMA' AND akreditasi='b' ) as SMA_b,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SMA' AND akreditasi='c' ) as SMA_c,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SMA' AND akreditasi='Belum Terakreditasi' ) as SMA_belum,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SMA' AND akreditasi='Tidak Terakreditasi' ) as SMA_tidak,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SMK' AND akreditasi='a' ) as SMK_a,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SMK' AND akreditasi='b' ) as SMK_b,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SMK' AND akreditasi='c' ) as SMK_c,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SMK' AND akreditasi='Belum Terakreditasi' ) as SMK_belum,
(SELECT COUNT(*) FROM e_sekolah where jenjang='SMK' AND akreditasi='Tidak Terakreditasi' ) as SMK_tidak");
	$pilih->execute();
	$data = array();
	foreach ($pilih as $row) {
		$data[] = $row;
	}
	print json_encode($data);
}
