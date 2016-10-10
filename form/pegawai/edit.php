<?php
require('../../../wp-load.php' );
$kode=isset($_GET['kode'])?$_GET['kode']:'';
$wp_user = $wpdb->get_results("SELECT ID, display_name, user_login, user_email FROM $wpdb->users where ID='$kode'");
foreach ( $wp_user as $userid ) {
		$uid		= $userid->ID;
	}
function role($uid){
	$users = new WP_User( $uid );
	return $users->roles[0]; 
}


?>
<div class="row" style="width:400px">
	<form id="form-edit-ijin">
		<div class="col-md-12">
			<div class="form-group">
				<label for="nip">ID</label>
				<input value="<?php echo $uid; ?>" type="text" class="form-control" id="id" name='id' readonly>
			</div>
			<div class="form-group">
				<p class="status"></p> 
				<label for="hakakses">Hak Akses</label>
				<select name="hakakses" class="form-control">
					<option value="pegawai">Pegawai</option>
					<option value="kadin">Kepala Dinas</option>
					<option value="kabid">Kepala Bidang</option>
				</select>
			</div>

			<i class="error text-danger"></i>
		</div>
	</form>
</div>
<script>
$(function(){

});
</script>
	