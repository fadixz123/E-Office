<?php

define('ADMDIR', dirname(__FILE__));

require( dirname(ADMDIR).'/wp-load.php' );


require ADMDIR.'/include/koneksi.php';
require ADMDIR.'/include/fungsi.php';


$themable = !isset($_REQUEST['notheme'])||$_REQUEST['notheme'];

