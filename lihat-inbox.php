<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include 'konfig.php';

$admintitle = "Surat Masuk";

include 'header.php';
$kode=isset($_GET['kode'])?$_GET['kode']:'';
$pilih = $db->prepare('SELECT * FROM e_surat_masuk where nomor_surat=?');
$pilih->bindValue(1, $kode, PDO::PARAM_STR);
$pilih->execute();
$row = $pilih->fetch(PDO::FETCH_BOTH);

// Cek peranan
$user_role = $db->query('select user_role from e_user where user_id="'.(int)get_current_user_id().'" limit 1');
$user_role = $user_role ? $user_role->fetchObject()->user_role : null;
$dispo = array(
	'status'	=> '',
	'tanggal'	=> '',
	'keterangan'	=> ''
);

if ($user_role === 'kadin') {
	if ($row['disposisi_kadin']) $dispo = array_merge($dispo, unserialize($row['disposisi_kadin']));
}
else if ($user_role === 'kabid') {
	if ($row['disposisi_kabid']) $dispo = array_merge($dispo, unserialize($row['disposisi_kabid']));
}
else exit("Pastikan Anda memiliki hak untuk tindakan ini");
?>
<div data-title="<?php echo $admintitle; ?>">
    <div class="tabs">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" ><i class="glyphicon glyphicon-eye-open"></i></a></li>
            <li class=""><a  href="#tab_2" ><i class='glyphicon glyphicon-file'></i></a></li>
            <li class=""><a  href="#tab_3" ><i class='fa fa-legal'></i></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class='text-center'><b><u><?php echo $row['perihal']; ?></u></b></div>
                <div class='text-center'><small><?php echo $row['nomor_surat']; ?></small></div><br/>
                <p><?php echo $row['keterangan']; ?></p><br/><br/>
                <div class="text-right">
                    <?php echo $row['tanggal']; ?><br/>
                    <b><?php echo $row['pengirim']; ?></b>
                </div>
            </div>
            <div class="tab-pane" id="tab_2">
                <img class="img-responsive" src="data/surat-masuk/file/<?php echo md5($row['nomor_surat']) . '.jpg'; ?>"/>
            </div>
            <div class="tab-pane" id="tab_3">
                <div class="row edit">
    <form id="form-disposisi" method="post" action="data/surat-masuk/disposisi.php">
		<div class="col-sm-12">
			<div class="form-group">
				<label for="nosurat" class="">No. Surat</label>
				<input type="text" name="nosurat" id="nosurat" value="<?php echo @$row['nomor_surat']; ?>" class="form-control" readonly="readonly"/>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				<label for="tanggal-disposisi" class="">Tanggal Disposisi</label>
				<input type="text" id="tanggal-disposisi" value="<?php echo $dispo['tanggal']; ?>" name="tanggal-disposisi" class="form-control tanggal" />
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				<label for="disposisi-status-terima" class="col-sm-2">
					<input id="disposisi-status-terima" type="radio" name="disposisi_status" class="form-control" value="terima" <?php
						echo $dispo['status'] === 'terima' ? 'checked' : ''
					?>>
					Terima
				</label>
				<label for="disposisi-status-tolak" class="col-sm-2">
					<input id="disposisi-status-tolak" type="radio" name="disposisi_status" class="form-control" value="tolak" <?php
						echo $dispo['status'] === 'tolak' ? 'checked' : ''
					?>>
					Tolak
				</label>
				<label for="tanggal-disposisi-lain" class="">
					<input type="radio" name="disposisi_status" class="form-control" value="tinjau" <?php
						echo $dispo['status'] === 'tinjau' ? 'checked' : ''
					?>>
					Lainnya
				</label>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				<label for="keterangan" class="">Keterangan</label>
				<textarea type="text" name="keterangan" id="keterangan" class="form-control"><?php echo $dispo['keterangan']; ?></textarea>
			</div>
			<input type="submit" value="Disposisi" class="btn btn-info"/>
		</div>
		<i class="error text-danger"></i>
		<input type="hidden" name="form-data-disposisi" value="1"/>
		
	</form>
</div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $(".tabs").tabs();
            $(".tanggal").datepicker({dateFormat: 'dd MM yy'});
            function split(val) {
                return val.split(/,\s*/);
            }
            function akhiran(term) {
                return split(term).pop();
            }
            $("#tujuan-disposisi").on("keydown", function (event) {
                if (event.keyCode == $.ui.TAB && $(this).autocomplete("instance").menu.active) {
                    event.preventDefault();
                }
            })
                    .autocomplete({
                        minLength: 0,
                        source: function (request, response) {
                            $.getJSON("form/surat-masuk/disposisi.php?term", {
                                term: akhiran(request.term)
                            }, response);
                        },
                        focus: function () {
                            return false;
                        },
                        select: function (event, ui) {
                            var terms = split(this.value);
                            terms.pop();
                            terms.push(ui.item.value);
                            terms.push("");
                            this.value = terms.join(", ");
                            return false;
                        }
                    });
        });
    </script>
    <?php include 'footer.php'; ?>



