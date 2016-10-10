<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include 'konfig.php';

$admintitle = "Surat Masuk";

include 'header.php';
if($akses!='pegawai'){echo("Anda tidak memiliki hak akses halaman ini. Silahkan hubungi administrator jika ini merupakan kesalahan! <a style='text-decoration:none;color:green' href='http://localhost/wordpress'> <<< Kembali Ke Beranda</a>");exit;}
?>
<div data-title="<?php echo $admintitle; ?>">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Arsip Surat Masuk</h3>
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm"  id="tambah" title="" data-original-title="Tambah">
                        <i class="fa fa-file-text-o"> Tambah</i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Ciutkan">
                        <i class="fa fa-minus"></i></button>

                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <table id="example2" class="table stripe table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>No. Surat</th>
                            <th>Perihal</th>
							<th>Dari</th>
                            <th>Penjelasan</th>
                            <th>Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box -->




    </div>
</div>



<script>
    $(function () {
        load_data();
		$("#tambah").click(function(){
			$.ajax({
				url: 'form/surat-masuk.php',
				success: function(s){
					dialog("<i class='text-info glyphicon glyphicon-info-sign'> Tambah Data</i>",s);
					$("#dialog").dialog({
						buttons: [
									{
									  text: "Batal",
									  'class':'btn btn-warning',
									  click: function() {
										  tutup_dialog();
									  }
									},
									{
									  text: "Kirim",
									  'class':'btn btn-info button-tambah',
									  click: function() {
										  tambah_data();
									  }
									}
						]
					});
				}
			});
		});
    });
</script>
<?php include 'footer.php'; ?>



