<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include 'konfig.php';

$admintitle = "Publikasi Berita";

include 'header.php';
?>
<div data-title="<?php echo $admintitle; ?>">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Pengelola Berita</h3>
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#myModal" title="" data-original-title="Tambah">
                        <i class="fa fa-file-text-o"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Ciutkan">
                        <i class="fa fa-minus"></i></button>

                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            	<style>

#loader1 {
    position:absolute;
    left:40%;
    top:35%;
   padding:25px;
     background:#ffffff;
 }		</style>
            <div class="box-body">
			<div id="frameWrap">
				<i id="loader1" style="font-size:100px;" class="fa fa-spin fa-spinner"></i>
                <iframe id="iframe1" style="width:100%;height:600px" src="http://localhost/wordpress/wp-admin/edit.php" frameborder="0" allowfullscreen></iframe>
            </div>
			</div>
			<script>
    $(document).ready(function () {
        $('#iframe1').on('load', function () {
            $('#loader1').hide();
        });
    });
</script>
        </div>
        <!-- /.box -->




    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog data">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Data Surat Masuk</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Nama Peminjam:</label>
                                <input type="text" value="" class="form-control" id="nama" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="identitas">Scan Identitas</label>
                                <input type="file" class="form-control" id="identitas">
                            </div>
                        </div>
                </div>

                <div class="form-group">
                    <label for="jabatan">Alamat</label>
                    <input type="text" class="form-control" id="alamat">
                </div>
                <div class="form-group">
                    <label for="jabatan">Tujuan Penggunaan</label>
                    <input type="text" class="form-control" id="penggunaan">
                </div>
                <div class="form-group">
                    <label for="jabatan">Keterangan</label>
                    <textarea  class="form-control" id="jabatan"></textarea>
                </div>
                <div class="form-group">
                    <label for="gedung">Gedung/Ruang</label>
                    <select class="form-control">
                        <option>Ruang Aula</option>
                        <option>Ruang Sekretariat</option>
                        <option>Gedung Pramuka</option>
                        <option>GOR</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mulai">Mulai</label>
                            <input  data-provide="datepicker" type="text" class="form-control" data-date-format="dd MM yyyy" id="mulai">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="berakhir">Berakhir</label>
                            <input data-provide="datepicker" type="text" class="form-control" data-date-format="dd MM yyyy" id="berakhir">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info pull-right">Kirim</button>
            </div>
        </div>

    </div>
</div>


<?php include 'footer.php'; ?>



