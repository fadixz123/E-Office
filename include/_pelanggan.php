<?php
include 'konfig.php';

$admintitle = "Karyawan";

include 'header.php';


if (!empty($_POST['data-hapus'])) {
    if (is_array($argv = $_POST['data-hapus'])) {
        $argv = implode(',', array_filter($argv, 'is_numeric'));
        $argv = "IN ($argv)";
    } else
        $argv = " = " . (int) $argv;

    $argv = mysql_query("delete from karyawan where ID {$argv}");
    exit($argv ? "berhasil" : "gagal");
}
if (!empty($_POST['data-edit'])) {
    $argv = (int) $_POST['data-edit'];
    $argv = mysql_query("select * from karyawan where ID = '{$argv}' limit 1");
    $row = mysql_fetch_object($argv);
    header("content-type:text/json");
    echo json_encode((array) $row);
    exit();
}
$info = "";
if (isset($_POST['simpan'])) {
    $data = array();
    if ($argv = trim($_POST['nama'])) {
        $data['NamaKaryawan'] = $argv;
        if ($argv = trim($_POST['provinsi'])) {
            $data['Propinsi'] = $argv;
            if ($argv = trim(@$_POST['kota'])) {
                $data['Kota'] = $argv;
                if ($argv = trim($_POST['kecamatan'])) {
                    $data['Kecamatan'] = $argv;
                    if ($argv = trim($_POST['alamat'])) {
                        $data['Alamat'] = $argv;
                        if ($argv = trim($_POST['telpon'])) {
                            $data['NoTelpon'] = $argv;
                            if ($argv = trim($_POST['jenisId'])) {
                                $data['JenisIdentitas'] = $argv;
                                if ($argv = trim($_POST['noId'])) {
                                    $data['NoIdentitas'] = $argv;
                                    if ($data_id = @$_POST['ID']) {
                                        $data_id = (int) $data_id;
                                        $data = sql_build_data($data, 1);
                                        $query = mysql_query("update karyawan set $data where ID = '{$data_id}'");
                                        if ($query) {

                                            //Kode setelah diperbarui
                                            $info = "sukses";
                                        } else
                                            $info = "Tidak ada perubahan";
                                    } else {
                                        $data = sql_build_data($data, 2);
                                        $query = mysql_query("insert into karyawan ({$data[0]}) values({$data[1]})");
                                        if ($query) {

                                            //Kode setelah disimpan
                                            $info = "sukses";
                                        } else
                                            $info = mysql_error(); //"Gagal disimpan";
                                    }
                                } else
                                    $info = "Kolom Nomor Identitas belum di isi";
                            } else
                                $info = "Kolom Jenis ID belum di isi";
                        } else
                            $info = "Kolom No. Telpon belum di isi";
                    } else
                        $info = "Kolom Alamat belum di isi";
                } else
                    $info = "Kolom Kecamatan belum di isi";
            } else
                $info = "Kolom Kota belum di isi";
        } else
            $info = "Kolom Provinsi belum di isi";
    } else
        $info = "Nama Karyawan belum di isi";
    exit($info);
}

/* * if (isset($_POST['simpan'])) {

  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $provinsi = $_POST['provinsi'];
  $kota = $_POST['kota'];
  $alamat = $_POST['alamat'];
  $telpon = $_POST['telpon'];
  $jenisId = $_POST['jenisId'];
  $noId = $_POST['noId'];
  $query = mysql_query("SELECT KodeKaryawan from karyawan where KodeKaryawan='$id' limit 1");
  if (mysql_num_rows($query) < 1) {
  mysql_query("INSERT INTO karyawan "
  . "( NamaKaryawan, Propinsi, Kota, Alamat, NoTelpon, JenisIdentitas, NoIdentitas)"
  . " values('$nama','$provinsi','$kota','$alamat','$telpon','$jenisId','$noId')");
  echo idKaryawan();
  } else {
  echo "ada";
  }
  exit();
  } */
?>     

<?php
$query = mysql_query("SELECT * From Propinsi");
$provinsi = "";
while ($row = mysql_fetch_array($query)) {
    $provinsi.= '<option value="' . $row['Propinsi'] . '" >' . $row['Propinsi'] . '</option>';
}

function idKaryawan() {
    $pre = date("dm");
    $query = mysql_query("SelecT * FROM karyawan where KodeKaryawan like '%$pre%'");
    $jumlah = mysql_num_rows($query) + 1;
    $nota = str_pad($jumlah, 4, '0', STR_PAD_LEFT);
    echo "K" . $pre . $nota;
}

?>


    <!-- Main content -->
    <section class="content">


        <div style="min-height: 800px" class="row">
            <div class="col-xs-12">
                <div  class="box">
                    <div class="box-header">
                        <button id="tombol_tambah" class="pull-right btn btn-primary" data-toggle="modal" data-target="#mdl"><i class="fa fa-plus"></i> Tambah</button>
                        <h3 class="box-title">Data Table With Full Features</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Karyawan</th>
                                    <th>Nama Karyawan</th>
                                    <th>Alamat</th>
                                    <th>Kota</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $q = mysql_query("select * from karyawan");
                                while ($row = mysql_fetch_array($q)) {
                                    ?>
                                    <tr id="data<?php echo $row['ID']; ?>">
                                        <td><?php echo tampilID("K", $row['ID'], $row["TanggalTambah"]); ?></td>
                                        <td><?php echo $row['NamaKaryawan']; ?></td>
                                        <td><?php echo $row['Alamat']; ?></td>
                                        <td><?php echo $row['Kota']; ?></td>
                                        <td><button id="edit" data-toggle="modal" data-target="#mdl" data-edit="<?php echo $row['ID']; ?>" class="btn btn-primary X-Small btn-xs fa fa-edit"> Edit</button> <button id="hapus" data-hapus="<?php echo $row['ID']; ?>" class="btn btn-danger X-Small btn-xs fa fa-remove"> Hapus</button></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div id="mdl" class="modal fade modal-default" role="dialog">
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
                                    <input data-error="Nama Harus diisi"  name="nama" type="text" class="form-control" id="nama" placeholder="Nama Karyawan" required>
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
                                        <?php echo $provinsi; ?>
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


 
        <button id="alr" data-toggle="modal" data-target="#mdl1" style="display:none"></button>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div id="mdl1" class="modal fade modal-default" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content ">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-remove"></i></button>
                <h4 class="modal-title">Warning </h4>
           </div>
            <div class="modal-body">
                <span class="error"></span>
            </div>
        </div>
    </div>
</div>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
!function(){
	$("#example1").DataTable();
    var dataEditID = null
    $('#tambah').submit(function (e) {
        e.preventDefault();
        var simpan = $("#simpan i").removeClass("fa-save").addClass("fa-spinner fa-spin");
        $("#simpan").removeClass("btn-success")
        var data = $("#tambah").serialize();
        if (dataEditID)
            data += "ID=" + dataEditID;
        $.post("<?php bloginfo('template_directory'); ?>/karyawan.php", data, function (hsl) {
            if (hsl == "sukses") {
                alert(hsl);
                $("#simpan").addClass("btn-success")
                simpan.removeClass("fa-spinner fa-spin").addClass("fa-check")
            } else {
                $(".error").text(hsl)
                $("#alr").click();
            }

        });
    });
    function kota(a) {
        $("#kota option").remove();

        $.ajax({url: "<?php bloginfo('template_directory'); ?>/data.php?kota=" + $("#provinsi").val(), success: function (result) {
                var kota = $("#kota")
                kota.removeAttr("readonly")
                kota.append(result)
                a && kota.val(a)
            }});
    }
        $("#kota").attr("readonly", true);
        $("#provinsi").on("change", function () {
            kota()
        });

        $("[data-hapus]").click(function () {
            var attr = this.getAttribute("data-hapus");
            $.post("<?php bloginfo('template_directory'); ?>/karyawan.php", "data-hapus=" + attr, function ($result) {
                $("#data" + attr).remove();
            })
        });
        $("[data-edit]").click(function () {
            $("#reset").click();
            var attr = this.getAttribute("data-edit");
            $.post("<?php bloginfo('template_directory'); ?>/karyawan.php", "data-edit=" + attr, function (hsl) {
                dataEditID = attr
                $("#nama").val(hsl.NamaKaryawan);
                $("#provinsi").val(hsl.Propinsi);
                kota(hsl.Kota);
                $("#kecamatan").val(hsl.Kecamatan)
                $("#alamat").val(hsl.Alamat)
                $("#telpon").val(hsl.NoTelpon)
                $("#jenisId").val(hsl.JenisIdentitas)
                $("#noId").val(hsl.NoIdentitas)

            });
        });
        $("#tombol_tambah").click(function () {
            $("#reset").click();
            dataEditID = null
        });
 }();
</script>
<?php include 'footer.php'; ?>

