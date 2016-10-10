<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include 'konfig.php';

$admintitle = "Support";

include 'header.php';
include_once("library/facebook/index.php");
 live_chat_facebook("https://www.facebook.com/CV-Indomedia-Network-1739410556347819/","http://demo.indomedia.co.id");

?>
<div data-title="<?php echo $admintitle; ?>">
	<div class="row">
		<div class="col-md-3">
		<div class="box box-primary">
            <div class="box-body box-profile">
			<img width='128' class='profile-user-img img-responsive img-circle' src="<?php echo  get_home_url(); ?>/e-office/data/profile/images/budairi.png"/>
				<h3 class="profile-username text-center">Ahmad Budairi</h3>
				<p class="text-muted text-center">Web Programmer</p>
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Telpon</b> <a class="pull-right">0815 750 738 73</a>
					</li>
					<li class="list-group-item">
						<b>Email</b> <a class="pull-right">nusagates@gmail.com</a>
					</li>
					<li class="list-group-item">
						<b>Pin BB</b> <a class="pull-right">56456654</a>
					</li>
				</ul>
            </div>
          </div>
		</div>
		<div class="col-md-3">
		<div class="box box-primary">
            <div class="box-body box-profile">
			<img width='128' class='profile-user-img img-responsive img-circle' src="<?php echo  get_home_url(); ?>/e-office/data/profile/images/sofa.png"/>
				<h3 class="profile-username text-center">Sofa Faizin</h3>
				<p class="text-muted text-center">Web Designer</p>
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Telpon</b> <a class="pull-right">0815 750 738 73</a>
					</li>
					<li class="list-group-item">
						<b>Email</b> <a class="pull-right">sofa.faizin@yahoo.co.id</a>
					</li>
					<li class="list-group-item">
						<b>Pin BB</b> <a class="pull-right">56456654</a>
					</li>
				</ul>
            </div>
          </div>
		</div>
		<div class="col-md-3">
		<div class="box box-primary">
            <div class="box-body box-profile">
			<img width='128' class='profile-user-img img-responsive img-circle' src="<?php echo  get_home_url(); ?>/e-office/data/profile/images/afif.png"/>
				<h3 class="profile-username text-center">M. Afif Jamaluddin</h3>
				<p class="text-muted text-center">Debugger & QC</p>
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Telpon</b> <a class="pull-right">0857 4293 3822</a>
					</li>
					<li class="list-group-item">
						<b>Email</b> <a class="pull-right">afif.ndleming@gmail.com</a>
					</li>
					<li class="list-group-item">
						<b>Pin BB</b> <a class="pull-right">56456654</a>
					</li>
				</ul>
            </div>
          </div>
		</div>
		<div class="col-md-3">
		<div class="box box-primary">
            <div class="box-body box-profile">
			<img width='128' class='profile-user-img img-responsive img-circle' src="<?php echo  get_home_url(); ?>/e-office/data/profile/images/uut.png"/>
				<h3 class="profile-username text-center">Widi Utami</h3>
				<p class="text-muted text-center">Customer Service</p>
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Telpon</b> <a class="pull-right">0857 3225 5706</a>
					</li>
					<li class="list-group-item">
						<b>Email</b> <a class="pull-right">mustikaungu@gmail.com</a>
					</li>
					<li class="list-group-item">
						<b>Pin BB</b> <a class="pull-right">56456654</a>
					</li>
				</ul>
            </div>
          </div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>



