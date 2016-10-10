<?php
require '../../include/koneksi.php'; 
$kode=isset($_GET['kode'])?$_GET['kode']:'';
$pilih = $db->prepare('SELECT * FROM e_gedung where id=?');
$pilih->bindValue(1, $kode, PDO::PARAM_STR);
$pilih->execute();
$row = $pilih->fetch(PDO::FETCH_BOTH);


?>
<div class="row" style="width:400px">
    <form id="form-edit-gedung">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tanggal" class="">Tanggal</label>
                                <input value="<?php echo $row['tanggal']; ?>" type="text" id="tanggal" name="tanggal" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="mulai" class="">Mulai</label>
                                <input value="<?php echo $row['mulai']; ?>" type="text" name="mulai" id="mulai" class="form-control waktu"/>
                            </div>
                        </div>
						<div class="col-sm-3">
                            <div class="form-group">
                                <label for="selesai" class="">Selesai</label>
                                <input value="<?php echo $row['selesai']; ?>" type="text" name="selesai" id="selesai" class="form-control waktu"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="tempat" class="">Tempat</label>
                                <input value="<?php echo $row['tempat']; ?>" type="text" name="tempat" id="tempat" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="pelaksana" class="">Pelaksana</label>
                                <input value="<?php echo $row['pelaksana']; ?>" type="text" name="pelaksana" id="pelakasana" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="keperluan" class="">Keperluan</label>
                                <input value="<?php echo $row['keperluan']; ?>" type="text" name="keperluan" id="keperluan" class="form-control"/>
                            </div>
                        </div>
						<div class="col-sm-12">
                            <div class="form-group">
                                <label for="keterangan" class="">Keterangan</label>
                                <textarea type="text" name="keterangan" id="keteranagan" class="form-control"><?php echo $row['keterangan']; ?></textarea>
                            </div>
							<i class="error text-danger"></i>
                        </div>
                    </form>
                </div>
				<script>
				$(function(){
					$("#tanggal").datepicker({dateFormat: 'dd MM yy' });
					$('.waktu').datetimepicker({
						datepicker:false,
						format:'H:i'
					});
				});
				</script>