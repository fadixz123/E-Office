<?php 
require('../../../wp-load.php' );
global $user;
$user 			= wp_get_current_user();
$id				= $user->id;

$awal			= get_user_meta($id, 'first_name', true);
$akhir			= get_user_meta($id, 'last_name', true);
$display		= $awal." ".$akhir;
function gambar(){
	$user 	= wp_get_current_user();
	$id		= $user->id;
	$gambar	= get_user_meta($id, 'gambar', true);
	if($gambar){
		echo "<img width='128' class='profile-user-img img-responsive img-circle' src='".get_home_url().'/e-office/data/profile/images/'.$id.'.png'."'/>";
	}
	else{
		echo "<img width='128' class='profile-user-img img-responsive img-circle' src='".get_home_url().'/e-office/data/profile/images/default.png'."'/>";
	}
}


?>

<div class="box-body box-profile">
<center><?php gambar(); ?></center>

<h3 class="profile-username text-center"><?php echo $user->display_name; ?></h3>
<p class="text-muted text-center"><?php echo get_user_meta($id, 'jabatan', true); ?></p>
<strong><i class="glyphicon glyphicon-user margin-r-5"></i> Biografi Singkat</strong>

              <p class="text-muted">
                <?php echo get_user_meta($id, 'description', true); ?>
              </p>
			  <hr/>
			  <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
              <p class="text-muted"><?php echo get_user_meta($id, 'alamat', true); ?></p>
              <ul class="list-group list-group-unbordered">
				<li class="list-group-item">
                  <b>Pendidikan</b> <a class="pull-right"><?php echo get_user_meta($id, 'pendidikan', true); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Username</b> <a class="pull-right"><?php echo $user->user_login; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?php echo $user->user_email; ?></a>
                </li>
				<li class="list-group-item">
                  <b>Telpon</b> <a class="pull-right"><?php echo get_user_meta($id, 'telpon', true); ?></a>
                </li>
				 <li class="list-group-item">
                  <b>Website</b> <a class="pull-right"><?php echo $user->user_url; ?></a>
                </li>
              </ul>

              <button class="btn btn-primary btn-block edit-profil"><b>Edit</b></button>
            </div>