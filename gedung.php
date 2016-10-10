<?php
include 'konfig.php';
$admintitle = "Penggunaan Gedung";
include 'header.php';
?>
<div data-title="<?php echo $admintitle; ?>">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo "Data ".$admintitle; ?></h3>
                <div class="pull-right box-tools">
					<?php if($akses=="pegawai"){ ?>
					<button class="btn btn-info btn-sm"  id="import-gedung" title="" ><i class="fa  fa-file-excel-o"> Import</i></button>
                    <button class="btn btn-info btn-sm"  id="print-gedung" title="" ><i class="fa  fa-print"> Print</i></button>
                    <button class="btn btn-info btn-sm"  id="tambah-gedung" title="" ><i class="fa fa-file-text-o"> Tambah</i></button>
					<?php } ?>
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Ciutkan">
						<i class="fa fa-minus"></i>
					</button>
                </div>
            </div>
            <div class="box-body">
				<div class="table-responsive">
					<table id="tabel-gedung" class="table stripe table-hover">
						<thead>
							<tr>
								<th>HARI/TANGGAL</th>
								<th>WAKTU</th>
								<th>TEMPAT</th>
								<th>PELAKSANA</th>
								<th>KEPERLUAN</th>
								<th>KETERANGAN</th>
								<th>TINDAKAN</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
            </div>
        </div>
 </div>
<?php include 'footer.php'; ?>