
<?php if (!@$themable) return; ?>
<?php
!is_user_logged_in() ? header("location:page-login.php") : '';
global $user;
$user = wp_get_current_user();
$id = $user->id;
$awal = get_user_meta($id, 'first_name', true);
$akhir = get_user_meta($id, 'last_name', true);
$display = $awal . " " . $akhir;
$default = '';
$key = '';
$akses = $user->roles[0];

//add_user_meta( '1', 'token', 'eM3arnBxN84:APA91bFslPir9ZVZ4Ip2rXpuq0FN20fBz17f4nnoq6vPH7Yfh3-DXk7vNEFeMGmvhq9Ujpo0JFKiMjGD-3f0m1ENwFRU3f7WQvJQaoqjBntlgk9N3JRMOKyb56d0tcJYRCYPiEbOn5As', true );
function gambar($class) {
    $user = wp_get_current_user();
    $id = $user->id;
    $gambar = get_user_meta($id, 'gambar', true);
    if ($gambar) {
        echo "<img width='128' class='" . $class . "' src='" . get_home_url() . '/e-office/data/profile/images/' . $id . '.png' . "'/>";
    } else {
        echo "<img width='128' class='" . $class . "' src='" . get_home_url() . '/e-office/data/profile/images/default.png' . "'/>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
    
        <style>
            input:required {
                background-color: lightyellow;
            }
            input::after{
                content: "*";
            }
            li.ui-menu-item { font-size:12px !important; }
        </style>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php if (!empty($admintitle)) echo($admintitle . ' | '); ?> E-Office 1.0</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" name="viewport">
        <!-- Bootstrap 3.3.5 -->
		                    <?php wp_head(); ?>
        <link rel="stylesheet" href="css/AdminLTE.min.css">
        <link rel="stylesheet" href="css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="js/taginput/src/bootstrap-tagsinput.css" />
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="css/jquery-ui.css" />
        <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="css/jquery.datetimepicker.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="fancybox/jquery.fancybox.css">

        <script>var $ = jQuery.noConflict();</script>
        <script src="js/jQuery-2.1.4.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="dist/js/app.min.js"></script>
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="bootstrap/js/validator.js"></script>
        <script src="js/jquery.datetimepicker.full.js"></script>
        <script src="fancybox/jquery.fancybox.js"></script>
        <script src="js/taginput/src/bootstrap-tagsinput.js"></script>

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo esc_url(home_url()); ?>/e-office" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>E</b>OFC</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>E-</b>Office 1.0</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                            <?php if ($akses == 'superadmin') { ?>
                                <!-- Notifications: style can be found in dropdown.less -->
                                <li class="dropdown notifications-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-bell-o"></i>
                                        <span class="label label-warning">10</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="header">You have 10 notifications</li>
                                        <li>
                                            <!-- inner menu: contains the actual data -->
                                            <ul class="menu">
                                                <li>
                                                    <a href="#">
                                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fa fa-users text-red"></i> 5 new members joined
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fa fa-user text-red"></i> You changed your username
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="footer"><a href="#">View all</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php gambar('user-image'); ?>
                                    <span class="hidden-xs"><?php echo $user->display_name; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <?php gambar('img-circle'); ?>
                                        <p>
                                            <?php echo $user->display_name; ?>
                                            <small><?php echo get_user_meta($id, 'jabatan', true); ?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a class="btn btn-default btn-flat" href="<?php echo wp_logout_url("e-office/page-login.php"); ?>">Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <?php if ($akses == 'superadmin') { ?>
                                <li>
                                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                </nav>
            </header>
            <!--- sidebar -->
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?php gambar('img-circle'); ?>
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $user->display_name; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" id="sidebarmenu">
                        <li class="header">ADMINISTRASI</li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-envelope-o text-green"></i> <span>Surat Masuk</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="inbox.php"><i class="fa fa-database text-green"></i> Semua Data</a></li>
                                <li><a href="upload-surat-masuk.php"><i class="fa fa-upload text-green"></i> Upload Data</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-send-o text-yellow"></i> <span>Surat Keluar</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="outbox.php"><i class="fa fa-database text-yellow"></i> Semua Data</a></li>
                                <li><a href="import-outbox.php"><i class="fa fa-upload text-yellow"></i> Upload Data</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-legal text-aqua"></i> <span>Perijinan</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="ijin.php"><i class="fa fa-database text-aqua"></i> Semua Data</a></li>
                                <li><a href="import-ijin.php"><i class="fa fa-upload text-aqua"></i> Upload Data</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-institution text-info"></i> <span>Penggunaan Gedung</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="gedung.php"><i class="fa fa-database text-info"></i> Semua Data</a></li>
                                <li><a href="import-gedung.php"><i class="fa fa-upload text-info"></i> Upload Data</a></li>
                            </ul>
                        </li>  
                        <?php
                        if ($akses == 'administrator') {
                            echo "<li><a href='pegawai.php'><i class='fa fa-user text-green'></i> <span>Managemen Pengguna</span></a></li>";
                        }
                        ?>

                        <li class="header">Publikasi</li>
                        <?php if ($akses == 'administrator') { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-newspaper-o text-blue"></i> <span>Berita dan Artikel</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="page-post-editor.php"><i class="fa fa-database text-info"></i> Semua Data</a></li>
                                    <li><a href="page-post-editor.php?tambah"><i class="fa fa-upload text-info"></i> Tambah</a></li>
                                </ul>
                            </li>  
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-calendar-o text-info"></i> <span>Agenda & Event</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="page-post-agenda.php"><i class="fa fa-database text-info"></i> Semua Data</a></li>
                                    <li><a href="page-post-agenda.php?tambah"><i class="fa fa-upload text-info"></i> Tambah</a></li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="fa fa-image text-info"></i> <span>Galeri</span></a></li>
                        <?php } ?>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-map-o text-aqua"></i> <span>Data Sekolah</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="sekolah.php"><i class="fa fa-database text-aqua"></i> Semua Data</a></li>
                                <li><a href="upload-sekolah.php"><i class="fa fa-upload text-aqua"></i> Upload Data</a></li>
                            </ul>
                        </li> 

                        <li class="header">Pengaturan</li>
                        <li><a href="profile.php"><i class="fa fa-user text-red"></i> <span>Profil Pengguna</span></a></li>
                        <li><a href="settings.php"><i class="fa fa-gears text-yellow"></i> <span>Pengaturan</span></a></li>
                        <li class="header">Support</li>
                        <li class="treeview">
                            <a href="#">
                                <i class="glyphicon glyphicon-phone-alt text-green"></i> <span>Doc & Support</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="documentation.php"><i class="glyphicon glyphicon-question-sign text-green"></i> Documentation</a></li>
                                <li><a href="support.php"><i class="glyphicon glyphicon-earphone text-green"></i> Support</a></li>
                            </ul>
                        </li> 
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 id="content-title"><?php echo($admintitle); ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo esc_url(home_url()); ?>/e-office"><i class="fa fa-dashboard"></i> Beranda</a></li>
                        <li class="active"><?php echo($admintitle); ?></li>
                    </ol>
                </section>


                <!-- Main content -->
                <section  id="kontenutama" class="content">
