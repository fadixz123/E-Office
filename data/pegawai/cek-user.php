<?php
require('../../../wp-load.php' );
if(is_user_logged_in()){
    echo 'masuk';
}
else{
    echo 'keluar';
}
