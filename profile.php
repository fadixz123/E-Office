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

    <div class="row">
        <div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="box box-primary profil">

            </div>
        </div>
    </div>

</div>

<script>
    $(function () {
        fetch_profil();
        function fetch_profil() {
            $.ajax({
                url: 'data/profile/ambil.php',
                success: function (data) {
                    $(".profil").html(data);
                }
            });
        }
        $('.profil').on('click', 'button.edit-profil', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'form/profil/edit.php',
                success: function (s) {
                    dialog("Edit Profil", s);
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
                                'class': 'btn btn-info button-edit-profil',
                                click: function () {
                                    var data = $("#form-edit-profil").serialize();
                                    $(".button-edit-profil").html("<i class='fa fa-refresh fa-spin'></i> Loading");
                                    $.ajax({
                                        method: "POST",
                                        url: "data/profile/edit.php",
                                        data: data,
                                        success: function (msg) {
                                            if (msg != "berhasil") {
                                                $(".button-edit-profil").text("Update");
                                                $(".error").addClass('glyphicon glyphicon-info-sign');
                                                $(".error").text(" " + msg);
                                            } else {
                                                $(".error").removeClass('glyphicon glyphicon-info-sign');
                                                $(".error").text(" ");
                                                tutup_dialog();
                                                fetch_profil();
                                            }

                                        },
                                        error: function (msg) {
                                            alert(msg.responseText)
                                        }
                                    });
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



