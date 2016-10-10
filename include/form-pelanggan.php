<?php 

include 'konfig.php';
if (isset($_GET['data-id'])) {
 // exit(':'.$_GET['data-id']);
}

$admintitle = "Karyawan";

include 'header.php';
if(isset($_GET['data-id'])){
	$id=$_GET['data-id'];
	$query=mysql_query("Select * from karyawan where ID='$id' ");
	while($row=mysql_fetch_array($query)){
		$nama=$row['NamaKaryawan'];
		$provinsi=$row["Propinsi"];
	}
}



?>


            <div class="modal-dialog">
                <div class="modal-content ">
                    <form id="tambah" role="form" data-toggle="validator"   method="post" class="form-horizontal" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-remove"></i></button>
                            <h4 class="modal-title">Dialog </h4>


                        </div>
                        <div class="modal-body">

                            <div class="form-group  has-feedback">
                                <label for="namaKaryawan" class="col-md-3 col-sm-2 control-label">Nama</label>
                                <div class="col-md-9 col-sm-10">
                                    <input data-error="Nama Harus diisi" value="<?php echo $nama; ?>"  name="nama" type="text" class="form-control" id="nama" placeholder="Nama Karyawan" required>
                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-2 control-label">Provinsi</label>
                                <div class="col-md-9 col-sm-10">
                                    <div class="help-block with-errors"></div>
                                    <select required name="provinsi" id="provinsi" class="form-control">
                                        <option value="">--Pilih Provinsi--</option>
										<option value="" ><?php provinsi(); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-2 control-label">Kota</label>
                                <div class="col-md-9 col-sm-10">
                                    <select required name="kota" id="kota" class="form-control">
                                        <option value="">Pilih Kota/Kabupaten...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan" class="col-md-3 col-sm-2 control-label">Kecamatan</label>
                                <div class="col-md-9 col-sm-10">
                                    <textarea required name="kecamatan" id="kecamatan" class="form-control"  style="resize: none" rows="2" cols="51" ></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="col-md-3 col-sm-2 control-label">Alamat</label>
                                <div class="col-md-9 col-sm-10">
                                    <textarea required name="alamat" id="alamat" class="form-control"   style="resize: none" rows="2" cols="51" ></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telpon" class=" col-md-3 col-sm-2 control-label">Telpon</label>
                                <div class="col-md-9 col-sm-10">
                                    <input required name="telpon" id="telpon" type="tel" class="form-control"     placeholder="No. Telpon Pelanggan" data-mask>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-2 control-label">Jenis ID</label>
                                <div class="col-md-9 col-sm-10">
                                    <select pattern="" required name="jenisId" id="jenisId" class="form-control">
                                        <option>Pilih Jenis Identitas...</option>
                                        <option>KTP</option>
                                        <option>SIM</option>
                                        <option>Paspor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="noId" class="col-md-3 col-sm-2 control-label">No. ID</label>
                                <div class="col-md-9 x    col-sm-10">
                                    <input required name="noId" id="noId" type="number" class="form-control"  placeholder="No. ID Pelanggan">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="reset" id="reset" class="btn btn-default pull-left" >Reset</button>
                            <button  type="submit" data-loading-text="<div style='text-align:center' class='overlay'><i class='fa fa-refresh fa-spin icon-large'></i> Wait...</div>" id="simpan"  class="btn btn-primary"><i  class="fa fa-save"></i> Save</button>
                            <input type="hidden" name="simpan"/>

                        </div>
                    </form>
                </div>

            </div>
<?php include("footer.php"); ?>
