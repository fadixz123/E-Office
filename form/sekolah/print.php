<?php 
	require '../../include/koneksi.php'; 
	$pilih = $db->query('SELECT DISTINCT jenjang FROM e_sekolah order by jenjang desc');
	$data="";
	while($row = $pilih->fetch(PDO::FETCH_BOTH)) {
		$data.="<option>".$row['jenjang']."</option>";
	}
?>
<div class="row tambah" style="width:400px">
    <form id="form-print">
		<div class="col-sm-6">
            <div class="form-group">
                <label for="mulai" class="">Jenjang Sekolah</label>
				<select name="jenjang" class="form-control">
					<option value="">Semua Jenjang</option>
					<?php echo $data; ?>
				</select>
            </div>
        </div>
		<div class="col-sm-6">
            <div class="form-group">
                <label for="mulai" class="">Jumlah Data</label>
				<input min="5" step="5" class="form-control" type="number" name="jumlah"/>
            </div>
			<i class='text-warning'> Kosongi jumlah data untuk download semua</i>
        </div>
    </form>
	
</div>
<script>
$(function(){
	$(".tanggal").datepicker({dateFormat: 'dd MM yy' });
});
</script>