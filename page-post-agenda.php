<?php
include 'konfig.php';
$admintitle = "Tambah Pos";
include 'header.php';
require( dirname(ADMDIR) . '/wp-admin/includes/template.php' );
?>
<div data-title="<?php echo $admintitle; ?>">
    <?php if (isset($_GET['tambah'])) { ?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $admintitle; ?></h3>
                <div class="pull-right box-tools">
                    <?php if ($akses == "pegawai") { ?>
                        <button class="btn btn-info btn-sm"  id="import-ijin" title="" ><i class="fa  fa-file-excel-o"> Import</i></button>
                        <button class="btn btn-info btn-sm"  id="print-ijin" title="" ><i class="fa  fa-print"> Print</i></button>
                        <button class="btn btn-info btn-sm"  id="tambah-ijin" title="" ><i class="fa fa-file-text-o"> Tambah</i></button>
                    <?php } ?>


                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <input placeholder="Judul Artikel" class="form-control input-lg" type="text" id="judul"/>
                        </div>
                        <style>
                            #container{
                                border: 1px solid #EBF1F7;
                                padding:5px;
                            }
                        </style>
                        <div id="container">
                            <?php
                            $content = '';
                            $editor_id = 'content';
                            $settings = array('media_buttons' => true);
                            wp_editor($content, $editor_id, $settings);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="box box-widget">
                            <div class="box-header with-border">
                                <h3 class="box-title">Kategori</h3>
                                <div class="pull-right box-tools">
                                    <button class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="daftar-kategori">Kategori:</label>
                                    <span id="kategori"></span>
                                </div>
                                <button id="addCat" class="btn btn-sm btn-primary"><i class="icon fa fa-plus"></i> Tambah Kategori</button>
                                <div style="display:none" class="form-group addCat">
                                    <label for="kolom-kategori">Tambah Kategori:</label>
                                    <input class="form-control" type="text" id="kolom-kategori"/><br/>
                                    <input class="btn btn-info" type="submit" value="Tambah" id="tambah-kategori"/>
                                </div>
                            </div>
                        </div>
                        <div class="box box-widget">
                            <div class="box-header with-border">
                                <h3 class="box-title">TAG</h3>
                                <div class="pull-right box-tools">
                                    <button class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <?php
                                $posttags = get_the_tags();
                                if ($posttags) {
                                    foreach ($posttags as $tag) {
                                        $tags.= $tag->name . ', ';
                                    }
                                }
                                ?>

                                <div class="form-group">
                                    <textarea id="tags"></textarea>
                                </div>
                                <i>pisahkan tag dengan koma (,)</i>
                            </div>
                        </div>
                        <div class="box box-widget">
                            <div class="box-header with-border">
                                <h3 class="box-title">Publisher</h3>
                                <div class="pull-right box-tools">
                                    <button class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="text-center">
                                    <button id="terbitkan" class="btn btn-lg btn-info">Publish Sekarang</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#tags').tagsinput();
            function get_tinymce_content(id) {
                var content;
                var inputid = id;
                var editor = tinyMCE.get(inputid);
                var textArea = jQuery('textarea#' + inputid);
                if (textArea.length > 0 && textArea.is(':visible')) {
                    content = textArea.val();
                } else {
                    content = editor.getContent();
                }
                return content;
            }
            function ambil_kategori() {
                $("#kategori").html("");
                $.ajax({
                    url: "data/artikel/tambah.php?kategori",
                    success: function (msg) {
                        var kategori = $("#kategori").html();
                        $("#kategori").html(kategori + msg);
                        $("#daftar-kategori").addClass("form-control");
                        $("#daftar-kategori").attr("multiple", "multiple");
                    },
                    error: function (e) {
                        alert(e.responseText);
                    }
                });
            }
            ambil_kategori();
            $("#addCat").click(function () {
                $(".addCat").slideToggle();
                $(".icon").toggleClass("fa-plus fa-minus");
            });
            $("#tambah-kategori").click(function () {
                $("#tambah-kategori").html("<i class='fa fa-spin fa-spinner'></i>");
                var kolom = $("#kolom-kategori").val();
                $.ajax({
                    url: "data/artikel/tambah.php?tambah-kategori",
                    method: "POST",
                    data: {cat: kolom},
                    success: function (msg) {
                        $("#tambah-kategori").html("Tambah");
                        ambil_kategori();
                        $("#addCat").click();

                    },
                    error: function (e) {
                        alert(e.responseText);
                    }
                });
            });
            $("#terbitkan").click(function () {
                var isi = get_tinymce_content("content");
                var judul = $("#judul").val();
                var kategori = $("#daftar-kategori").val();
                var tag = $("#tags").val();
                $.ajax({
                    url: "data/artikel/tambah.php?tambah-artikel",
                    method: "POST",
                    data: {judul: judul, kategori: kategori, isi: isi, tag: tag},
                    success: function (msg) {
                        window.location.href = "page-post-editor.php?edit=" + msg;

                    },
                    error: function (e) {
                        alert(e.responseText);
                    }
                });
            });
        });
    </script>
    <?php
} elseif (isset($_GET['edit'])) {
    $post_id = $_GET['edit'];
    $post = get_post($post_id, OBJECT, 'edit');
    ?>


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo $admintitle; ?></h3>
            <div class="pull-right box-tools">
                <?php if ($akses == "pegawai") { ?>
                    <button class="btn btn-info btn-sm"  id="import-ijin" title="" ><i class="fa  fa-file-excel-o"> Import</i></button>
                    <button class="btn btn-info btn-sm"  id="print-ijin" title="" ><i class="fa  fa-print"> Print</i></button>
                    <button class="btn btn-info btn-sm"  id="tambah-ijin" title="" ><i class="fa fa-file-text-o"> Tambah</i></button>
                <?php } ?>


            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <input value="<?php echo $post->post_title; ?>" placeholder="Judul Artikel" class="form-control input-lg" type="text" id="judul"/>
                    </div>
                    <style>
                        #container{
                            border: 1px solid #EBF1F7;
                            padding:5px;
                        }
                        .form-group li{
                            list-style: none
                        }
                    </style>
                    <div id="container">
                        <?php
                        $content = $post->post_content;

                        $editor_id = 'content';
                        $settings = array('media_buttons' => true);
                        wp_editor($content, $editor_id, $settings);
                        ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box box-widget">
                        <div class="box-header with-border">
                            <h3 class="box-title">Kategori</h3>
                            <div class="pull-right box-tools">
                                <button class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="daftar-kategori">Kategori:</label>
                                <span id="kategori"></span>
                            </div>
                            <button id="addCat" class="btn btn-sm btn-primary"><i class="icon fa fa-plus"></i> Tambah Kategori</button>
                            <div style="display:none" class="form-group addCat">
                                <label for="kolom-kategori">Tambah Kategori:</label>
                                <input class="form-control" type="text" id="kolom-kategori"/><br/>
                                <input class="btn btn-info" type="submit" value="Tambah" id="tambah-kategori"/>
                            </div>
                        </div>
                    </div>
                    <div class="box box-widget">
                        <div class="box-header with-border">
                            <h3 class="box-title">TAG</h3>
                            <div class="pull-right box-tools">
                                <button class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <?php
                            $posttags = get_the_terms($post_id, 'tag_agenda');
                            $tags = '';
                            if ($posttags) {
                                foreach ($posttags as $tag) {
                                    $tags.= $tag->name . ', ';
                                }
                            }
                            ?>

                            <div class="form-group">
                                <input placeholder="Tambah Tag" style="width:100%" value="<?php echo $tags; ?>"  type="text" class="form-control" id="tags"/>
                            </div>
                            <i>pisahkan tag dengan koma (,)</i>
                        </div>
                    </div>
                    <div class="box box-widget">
                        <div class="box-header with-border">
                            <h3 class="box-title">Publisher</h3>
                            <div class="pull-right box-tools">
                                <button class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            Terbit: <?php echo "<b>" . get_the_time('d F Y') . "</b><br/>"; ?>
                            Status: <?php
                            echo "<b>" . get_post_status() . "</b> <br/>";
                            if (get_post_status() == 'private') {
                                echo 'Mode: <b>rahasia</b>';
                            } else {
                                echo 'Mode: <b>publik</b> <br/>';
                            }
                            echo "Url: <a href='" . get_permalink() . "'>lihat</a>";
                            ?>
                            <div class="text-center">
                                <button id="terbitkan" class="btn btn-lg btn-info">Update</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        $(function () {
            $('#tags').tagsinput();
            function get_tinymce_content(id) {
                var content;
                var inputid = id;
                var editor = tinyMCE.get(inputid);
                var textArea = jQuery('textarea#' + inputid);
                if (textArea.length > 0 && textArea.is(':visible')) {
                    content = textArea.val();
                } else {
                    content = editor.getContent();
                }
                return content;
            }
            function ambil_kategori() {
                $("#kategori").html("");
                $.ajax({
                    url: "data/artikel/agenda.php?ambil-kategori=" +<?php echo $post_id; ?>,
                    success: function (msg) {
                        $("#kategori").html(msg);
                        $("#daftar-kategori").addClass("form-control");
                        $("#daftar-kategori").attr("multiple", "multiple");
                    },
                    error: function (e) {
                        alert(e.responseText);
                    }
                });
            }
            ambil_kategori();
            $("#addCat").click(function () {
                $(".addCat").slideToggle();
                $(".icon").toggleClass("fa-plus fa-minus");
            });
            $("#tambah-kategori").click(function () {
                $("#tambah-kategori").html("<i class='fa fa-spin fa-spinner'></i>");
                var kolom = $("#kolom-kategori").val();
                $.ajax({
                    url: "data/artikel/agenda.php?tambah-kategori",
                    method: "POST",
                    data: {cat: kolom},
                    success: function (msg) {
                        $("#tambah-kategori").html("Tambah");
                        $("#kategori").html("");
                        $.ajax({
                            url: "data/artikel/agenda.php?ambil-kategori=" +<?php echo $post_id; ?>,
                            success: function (msgs) {
                                $("#kategori").html(msgs);
                                $("#kategori input[value=" + msg + "]").attr("checked", "checked");
                            },
                            error: function (e) {
                                alert(e.responseText);
                            }
                        });


                        $("#addCat").click();



                    },
                    error: function (e) {
                        alert(e.responseText);
                    }
                });
            });
            $("#terbitkan").click(function () {
                var isi = get_tinymce_content("content");
                var judul = $("#judul").val();
                var tag = $('#tags').val();
                var kategori = $("#kategori").find("input[type='checkbox']:checked").map(function (_, el) {
                    return $(el).val();
                }).get();
                $.ajax({
                    url: "data/artikel/tambah.php?edit-artikel=<?php echo $post_id; ?>",
                    method: "POST",
                    data: {judul: judul, kategori: kategori, isi: isi, tag: tag},
                    success: function (msg) {

                        window.location.href = "page-post-editor.php?edit=" + msg;

                    },
                    error: function (e) {
                        alert(e.responseText);
                    }
                });
            });
        });
    </script>
    <?php
} else {
    ?>
    <?php
// the query
    $wpb_all_query = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1));
    ?>

    <?php if ($wpb_all_query->have_posts()) : ?>




        <table id="data-artikel" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Terbit</th>
                    <th>Agenda</th>
                </tr>
            </thead>

            <tbody>
                <!-- the loop -->
                <?php
                $loop = new WP_Query(array('post_type' => 'agenda', 'posts_per_page' => -1));
                while ($loop->have_posts()) : $loop->the_post();
                    ?>
                    <tr>
                        <td><a href="<?php echo'page-post-agenda.php?edit=' . get_the_ID(); ?>"><?php the_title(); ?></a></td>
                        <td><?php
                            $categories = get_the_terms(get_the_ID(), 'kategori_agenda');
                            $separator = ', ';
                            $output = '';
                            if (!empty($categories)) {
                                foreach ($categories as $category) {
                                    $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" alt="' . esc_attr(sprintf(__('View all posts in %s', 'textdomain'), $category->name)) . '">' . esc_html($category->name) . '</a>' . $separator;
                                }
                                echo trim($output, $separator);
                            }
                            ?></td>
                        <td><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' lalu'; ?></td>
                        <td>
                            <?php
                            $posttags = get_the_terms($post_id, 'tag_agenda');
                            if ($posttags) {
                                foreach ($posttags as $tag) {
                                    echo trim($tag->name, ", ");
                                }
                            }
                            ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <!-- end of the loop -->
            </tbody>
        </table>
        <?php wp_reset_postdata(); ?>
        <script>
            $(function () {
                $('#data-artikel').dataTable();
            });
        </script>
    <?php else : ?>
        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; ?>
<?php } include 'footer.php'; ?>



