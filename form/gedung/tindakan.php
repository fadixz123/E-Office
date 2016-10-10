<?php
require '../../include/koneksi.php'; 
$kode=isset($_GET['kode'])?$_GET['kode']:'';
$pilih = $db->prepare('SELECT * FROM e_gedung where id=?');
$pilih->bindValue(1, $kode, PDO::PARAM_STR);
$pilih->execute();
$row = $pilih->fetch(PDO::FETCH_BOTH);


?>
<div class="row" style="width:400px">
    <form id="form-edit-tindakan">
		<div class="col-sm-12">
			<div class="form-group">
				<label for="id" class="">ID</label>
				<input type="text" value="<?php echo $row['id']; ?>"  class="form-control" name="id" readonly/>
			</div>
			<div class="form-group">
				<label for="putusan" class="">Putusan</label>
				<select class="form-control" id="putusan" name="putusan">
				<option><?php echo $row['status']; ?></option>
				<option>Pending</option>
				<option>Approve</option>
				<option>Reject</option>
				</select>
			</div>
			<div class="form-group">
				<label for="catatan" class="">Catatan</label>
				<textarea  class="form-control" name="catatan"><?php echo $row['catatan']; ?></textarea>
			</div>
		<i class="error text-danger"></i>
		</div>
	</form>
</div>