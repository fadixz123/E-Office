<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include 'konfig.php';

$admintitle = "Surat Masuk";

include 'header.php';
?>
<div data-title="<?php echo $admintitle; ?>">

    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Arsip Surat Masuk</h3>
            <div class="pull-right box-tools">
                <?php if ($akses == "pegawai") { ?>
                    <button class="btn btn-info btn-sm"  id="import" title="" ><i class="fa  fa-file-excel-o"> Import</i></button>
                    <button class="btn btn-info btn-sm"  id="print" title="" ><i class="fa  fa-print"> Print</i></button>
                    <button class="btn btn-info btn-sm"  id="tambah" title="" ><i class="fa fa-file-text-o"> Tambah</i></button>
                <?php } ?>
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Ciutkan">
                    <i class="fa fa-minus"></i></button>

            </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body" >
                <table id="example2" data-role="table" class="table stripe table-hover ui-responsive">
                    <thead>
                        <tr>
                            <th width="12%">TANGGAL</th>
                            <th width="12%">NO. SURAT</th>
                            <th>PERIHAL</th>
                            <th>PENGIRIM</th>
                            <th>STATUS DISPOSISI</th>
                            <th width="15px">TINDAKAN</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
        </div>
    </div>
    <!-- /.box -->




</div>




<script>
    $(function () {
        load_data();
        $("#tambah").click(function () {
            $.ajax({
                url: 'form/surat-masuk/tambah.php',
                success: function (s) {
                    dialog("<i class='text-info glyphicon glyphicon-info-sign'> Tambah Data</i>", s);
                    auto("#nosurat", "data/surat-masuk/auto-nomor.php");
                    auto("#pengirim", "data/surat-masuk/auto-pengirim.php");
                    auto("#perihal", "data/surat-masuk/auto-perihal.php");
                    auto("#masuk", "data/surat-masuk/auto-penerima.php");
                    $("#dialog").dialog({
                        buttons: [
                            {
                                text: "Batal",
                                'class': 'btn btn-warning',
                                click: function () {
                                    tutup_dialog();
                                }
                            },
                            {
                                text: "Kirim",
                                'class': 'btn btn-info button-tambah',
                                click: function () {
                                    tambah_data();
                                }
                            }
                        ]
                    });
                }
            });
        });
        $('#example2').on('click', 'a#hapus', function (e) {
            e.preventDefault();
            kode = $(this).attr("data-hapus");
            dialog("<i class='text-warning glyphicon glyphicon-info-sign'> Peringatan</i>", "Apakah Anda serius akan menghapus arsip dengan nomor surat <b>" + kode + "</b>?");
            $("#dialog").dialog({
                buttons: [
                    {
                        text: "Batal",
                        'class': 'btn btn-warning',
                        click: function () {
                            tutup_dialog();
                        }
                    },
                    {
                        text: "Betul",
                        'class': 'btn btn-info button-tambah',
                        click: function () {
                            $.ajax({
                                url: "data/surat-masuk/hapus.php?kode=" + kode + "",
                                method: "POST",
                                success: function (msg) {
                                    $("#dialog").dialog("close");
                                    $("#dialog").on("dialogclose", function (event, ui) {
                                        load_data();
                                    });
                                },
                                error: function (e) {
                                    alert(e.responseText);
                                }
                            });
                        }
                    }
                ]
            });
        });
        $('#example2').on('click', 'a#edit', function (e) {
            e.preventDefault();
            kode = $(this).attr("data-edit");
			alert(kode)
            $.ajax({
                url: "form/surat-masuk/edit.php?kode=" + kode + "",
                success: function (msg) {
                    dialog("<i class='text-info glyphicon glyphicon-info-sign'> Edit Data</i>", msg);
                    $("#dialog").dialog({
                        buttons: [
                            {
                                text: "Batal",
                                'class': 'btn btn-warning',
                                click: function () {
                                    tutup_dialog();
                                }
                            },
                            {
                                text: "Update",
                                'class': 'btn btn-info button-edit',
                                click: function () {
                                    var data = $("#form-edit").serialize();
                                    var file_data = $('#file').prop('files')[0];
                                    var form_data = new FormData();
                                    form_data.append('file', file_data);
                                    $(".button-edit").html("<i class='fa fa-refresh fa-spin'></i> Loading");
                                    $.ajax({
                                        url: "data/surat-masuk/edit.php?" + data,
                                        cache: true,
                                        contentType: false,
                                        processData: false,
                                        data: form_data,
                                        method: "POST",
                                        success: function (msg) {
                                            alert(msg)
                                            $(".button-edit").html("Update");
                                            $(".error").addClass('glyphicon glyphicon-info-sign');
                                            $(".error").text(" " + msg);
                                            if (msg == "berhasil") {
                                                $("#dialog").dialog("close");
                                                $("#dialog").on("dialogclose", function (event, ui) {
                                                    load_data();
                                                });
                                            }
                                        },
                                        error: function (e) {
                                            alert(e.responseText);
                                        }
                                    });
                                }
                            }
                        ]
                    });
                },
                error: function (e) {
                    alert(e.responseText);
                }
            });
        });
        $('#example2').on('click', 'a#disposisi', function (e) {
            e.preventDefault();
            kode = $(this).attr("data-disposisi");
            $.ajax({
                url: "form/surat-masuk/disposisi.php?kode=" + kode + "",
                success: function (msg) {
                    dialog("<span class='text-info'><i class='glyphicon glyphicon-info-sign'></i>Disposisi</span>", msg);
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
                    $("#dialog").dialog({
                        buttons: [
                            {
                                text: "Batal",
                                'class': 'btn btn-warning',
                                click: function () {
                                    tutup_dialog();
                                }
                            },
                            {
                                text: "Disposisi",
                                'class': 'btn btn-info button-disposisi',
                                click: function () {
                                    var data = $("#form-disposisi").serialize();
                                    $(".button-disposisi").html("<i class='fa fa-refresh fa-spin'></i> Loading");
                                    $.ajax({
                                        url: "data/surat-masuk/disposisi.php",
                                        data: data,
                                        method: "POST",
                                        success: function (msg) {
                                            $(".button-disposisi").html("Disposisi");
                                            $(".error").addClass('glyphicon glyphicon-info-sign');
                                            $(".error").text(" " + msg);
                                            if (msg == "berhasil") {
                                                $("#dialog").dialog("close");
                                                $("#dialog").on("dialogclose", function (event, ui) {
                                                    load_data();
                                                });
                                            }
                                        },
                                        error: function (e) {
                                            alert(e.responseText);
                                        }
                                    });
                                }
                            }
                        ]
                    });
                },
                error: function (e) {
                    alert(e.responseText);
                }
            });
        });
        $("#print").click(function () {
            $.ajax({
                url: 'form/surat-masuk/print.php',
                success: function (msg) {
                    dialog("<i class='text-info glyphicon glyphicon-info-sign'> Print</i>", msg);
                    $("#dialog").dialog({
                        buttons: [
                            {
                                text: "Batal",
                                'class': 'btn btn-warning',
                                click: function () {
                                    tutup_dialog();
                                }
                            },
                            {
                                text: "Print",
                                'class': 'btn btn-info button-tambah',
                                click: function () {
                                    var data = $("#form-print").serialize();
                                    window.open('data/surat-masuk/cetak.php?' + data, '_blank');
                                    tutup_dialog();
                                }
                            }
                        ]
                    });
                },
                error: function (e) {
                    alert(e.responseText);
                }
            })

        });
        $("#import").click(function () {
            $.ajax({
                url: 'form/surat-masuk/import.php',
                success: function (msg) {
                    dialog("<i class='text-info glyphicon glyphicon-info-sign'> Print</i>", msg);
                    $("#dialog").dialog({
                        buttons: [
                            {
                                text: "Batal",
                                'class': 'btn btn-warning',
                                click: function () {
                                    tutup_dialog();
                                }
                            },
                            {
                                text: "Import",
                                'class': 'btn btn-info button-import',
                                click: function () {
                                    var file_data = $('#csv').prop('files')[0];
                                    var form_data = new FormData();
                                    form_data.append('file', file_data);
                                    $(".button-import").html("<i class='fa fa-refresh fa-spin'></i> Loading");
                                    $.ajax({
                                        url: 'data/surat-masuk/import.php',
                                        method: 'post',
                                        cache: true,
                                        contentType: false,
                                        processData: false,
                                        data: form_data,
                                        success: function (msg) {
                                            if (msg.toLowerCase().indexOf("berhasil") >= 0) {
                                                tutup_dialog();
                                                $("#dialog").on("dialogclose", function (event, ui) {
                                                    load_data();
                                                });

                                            } else {
                                                $(".help-block").html(msg)
                                            }
                                        },
                                        error: function (er) {
                                            alert(er.responseText)
                                        }
                                    });

                                }
                            }
                        ]
                    });
                },
                error: function (e) {
                    alert(e.responseText);
                }
            })

        });
        $('#example2 a#lihat').fancybox({
            wrapCSS: 'fancybox-custom',
            closeClick: true,
            openEffect: 'elastic',
            openSpeed: 150,
            closeEffect: 'elastic',
            closeSpeed: 150,
            helpers: {
                title: {
                    type: 'inside'
                },
                overlay: {
                    css: {
                        'background': 'rgba(238,238,238,0.85)'
                    }
                }
            }
        });
    });
</script>
<?php include 'footer.php'; ?>



