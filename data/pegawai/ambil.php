<?php
require('../../../wp-load.php' );
function role($uid){
	$users = new WP_User( $uid );
	return $users->roles[0]; 
}
$wp_user_search = $wpdb->get_results("SELECT ID, display_name, user_login, user_email FROM $wpdb->users");
$data = array();
	foreach ( $wp_user_search as $userid ) {
		
		$data[] = array($userid->ID, $userid->display_name, $userid->user_login, $userid->user_email, role($userid->ID) );
		print($return);
	}
echo json_encode($data);