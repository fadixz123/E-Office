<?php
require '../../include/koneksi.php'; 
$kode=isset($_GET['kode'])?$_GET['kode']:'';
$pilih = $db->prepare('SELECT * FROM e_cuti where id=?');
$pilih->bindValue(1, $kode, PDO::PARAM_STR);
$pilih->execute();
$row = $pilih->fetch(PDO::FETCH_BOTH);


?>
<div class="row" style="width:400px">
                    <form id="form-edit-ijin">
                        <div class="col-md-12">
							<div class="form-group">
                                <p class="status"></p> 
                                <label for="nip">NIP</label>
                                <input value="<?php echo $row['nip']; ?>" type="text" class="form-control" id="nip" name='nip'>
                            </div>
                            <div class="form-group">
                                <p class="status"></p> 
                                <label for="nama-pegawai">Nama</label>
                                <input value="<?php echo $row['nama']; ?>" type="text" class="form-control" id="nama-pegawai" name="nama-pegawai" >
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input value="<?php echo $row['jabatan']; ?>" name="jabatan" type="jabatan" class="form-control" id="jabatan">
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Perihal</label>
                                <select name="perihal" class="form-control">
									<option><?php echo $row['perihal']; ?></option>
                                    <option>Izin</option>
                                    <option>Cuti</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mulai">Mulai</label>
                                        <input value="<?php echo $row['mulai']; ?>" name="mulai"  type="text" class="form-control tanggal"  id="mulai">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="berakhir">Berakhir</label>
                                        <input value="<?php echo $row['berakhir']; ?>" name="berakhir" type="text" class="form-control tanggal"  id="berakhir">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="keterangan"><?php echo $row['keterangan']; ?></textarea>
                            </div>
							<i class="error text-danger"></i>
                        </div>
                    </form>
                </div>
				<script>
				$(function(){
					$(".tanggal").datepicker({dateFormat: 'dd MM yy' });
				});
				</script>
	