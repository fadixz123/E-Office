<html>
<head>
<link rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
</head>
	<body>
		<div class="container-fluid">
		<?php
		require '../../include/koneksi.php';
		require('../../../wp-load.php' );
		$nomor=isset($_GET['nomor-surat'])?$_GET['nomor-surat']:'';
		global $user;
		$user 			= wp_get_current_user();
		$akses			= $user->roles[0];
		$menu			="";
		$pilih 			= $db->query("SELECT * FROM e_surat_masuk where nomor_surat='$nomor'");
			while($row = $pilih->fetch(PDO::FETCH_BOTH)) {
			
			}
		?>
		</div>
	</body>
</html>