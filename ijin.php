<?php
include 'konfig.php';
$admintitle = "Ijin & Cuti";
include 'header.php';
?>
<div data-title="<?php echo $admintitle; ?>">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo "Data ".$admintitle; ?></h3>
                <div class="pull-right box-tools">
					<?php if($akses=="pegawai"){ ?>
					<button class="btn btn-info btn-sm"  id="import-ijin" title="" ><i class="fa  fa-file-excel-o"> Import</i></button>
                    <button class="btn btn-info btn-sm"  id="print-ijin" title="" ><i class="fa  fa-print"> Print</i></button>
                    <button class="btn btn-info btn-sm"  id="tambah-ijin" title="" ><i class="fa fa-file-text-o"> Tambah</i></button>
					<?php } ?>
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Ciutkan">
                        <i class="fa fa-minus"></i></button>

                </div>
            </div>
            <div class="box-body">
				<div class="table-responsive">
					<table id="tabel-ijin" class="table stripe table-hover">
						<thead>
							<tr>
								<th>NIP</th>
								<th>Nama</th>
								<th>Jabatan</th>
								<th>Perihal</th>
								<th>Mulai</th>
								<th>Berakhir</th>
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



