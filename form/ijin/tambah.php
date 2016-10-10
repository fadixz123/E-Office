<div class="row" style="width:400px">
                    <form id="form-tambah-ijin">
                        <div class="col-md-12">
							<div class="form-group">
                                <p class="status"></p> 
                                <label for="nip">NIP</label>
                                <input type="text" class="form-control" id="nip" name='nip'>
                            </div>
                            <div class="form-group">
                                <p class="status"></p> 
                                <label for="nama-pegawai">Nama</label>
                                <input type="text" class="form-control" id="nama-pegawai" name="nama-pegawai" >
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input name="jabatan" type="jabatan" class="form-control" id="jabatan">
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Perihal</label>
                                <select name="perihal" class="form-control">
                                    <option>Izin</option>
                                    <option>Cuti</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jabatan">Mulai</label>
                                        <input name="mulai"  type="text" class="form-control"  id="mulai">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jabatan">Berakhir</label>
                                        <input name="berakhir" type="text" class="form-control"  id="berakhir">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
                            </div>
							<i class="error text-danger"></i>
                        </div>
                    </form>
                </div>
				<script>
				$(function(){
					$("#mulai").datepicker({dateFormat: 'dd MM yy' });
					$("#berakhir").datepicker({dateFormat: 'dd MM yy' });

				     			 
				});
				</script>