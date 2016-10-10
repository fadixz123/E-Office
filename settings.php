<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include 'konfig.php';

$admintitle = "Pengaturan";

include 'header.php';
?>
  <style>

/*  bhoechie tab */
div.bhoechie-tab-container{
  z-index: 10;
  background-color: #ffffff;
  padding: 0 !important;
  border-radius: 4px;
  -moz-border-radius: 4px;
  border:1px solid #ddd;
  margin-top: 20px;
  margin-left: 50px;
  -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  box-shadow: 0 6px 12px rgba(0,0,0,.175);
  -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  background-clip: padding-box;
  opacity: 0.97;
  filter: alpha(opacity=97);
}
div.bhoechie-tab-menu{
  padding-right: 0;
  padding-left: 0;
  padding-bottom: 0;
}
div.bhoechie-tab-menu div.list-group{
  margin-bottom: 0;
}
div.bhoechie-tab-menu div.list-group>a{
  margin-bottom: 0;
}
div.bhoechie-tab-menu div.list-group>a .glyphicon,
div.bhoechie-tab-menu div.list-group>a .fa {
  color: #3c8dbc;
}
div.bhoechie-tab-menu div.list-group>a:first-child{
  border-top-right-radius: 0;
  -moz-border-top-right-radius: 0;
}
div.bhoechie-tab-menu div.list-group>a:last-child{
  border-bottom-right-radius: 0;
  -moz-border-bottom-right-radius: 0;
}
div.bhoechie-tab-menu div.list-group>a.active,
div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
div.bhoechie-tab-menu div.list-group>a.active .fa{
  background-color: #3c8dbc;
  background-image: #3c8dbc;
  color: #ffffff;
}
div.bhoechie-tab-menu div.list-group>a.active:after{
  content: '';
  position: absolute;
  left: 100%;
  top: 50%;
  margin-top: -13px;
  border-left: 0;
  border-bottom: 13px solid transparent;
  border-top: 13px solid transparent;
  border-left: 10px solid #3c8dbc;
}

div.bhoechie-tab-content{
  background-color: #ffffff;
  /* border: 1px solid #eeeeee; */
  padding-left: 20px;
  padding-top: 10px;
}

div.bhoechie-tab div.bhoechie-tab-content:not(.active){
  display: none;
}
  </style>
<div data-title="<?php echo $admintitle; ?>">
    <div class="row">
        <div class="col-lg-11 col-md-5 col-sm-8 col-xs-9 bhoechie-tab-container">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
              <div class="list-group">
                <a href="#" class="list-group-item active text-center">
                  <h4 class="fa fa-envelope-o"></h4><br/>Surat Masuk
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="fa fa-send-o"></h4><br/>Surat Keluar
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="fa fa-legal"></h4><br/>Perijinan
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="fa fa-institution"></h4><br/>Gedung
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="fa fa-user"></h4><br/>Managemen Pengguna
                </a>
              </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                <!-- flight section -->
                <div class="bhoechie-tab-content active">
                    <center>
                      <h1 class="glyphicon glyphicon-plane" style="font-size:14em;color:#55518a"></h1>
                      <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
                      <h3 style="margin-top: 0;color:#55518a">Flight Reservation</h3>
                    </center>
                </div>
                <!-- train section -->
                <div class="bhoechie-tab-content">
					<center><h2>Penomoran Surat Keluar</h2></center><hr/>
					<div class="row">
						<form id="nomor-surat">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nama-bidang">Nama Bidang</label>
									<input Placeholder="Bidang Pendidikan" type="text" class="form-control" id="nama-bidang" name="nama-bidang"/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="nomor-bidang">Nomor Bidang</label>
									<input Placeholder="1.0" type="text" class="form-control" id="nomor-bidang" name="nomor-bidang"/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="nama-sub">Nama Sub Bidang</label>
									<input Placeholder="Pendidikan Menengah" type="text" class="form-control" id="nama-sub" name="nama-sub"/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="nomor-sub">Nomor Sub</label>
									<input Placeholder="1.0.3" type="text" class="form-control" id="nomor-sub" name="nomor-sub"/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input class="btn btn-info" type="submit" value="Tambah" id="tambah-nomor"/>
								</div>
							</div>
						</form>
					</div>
                </div>
    
                <!-- hotel search -->
                <div class="bhoechie-tab-content">
                    <center>
                      <h1 class="glyphicon glyphicon-home" style="font-size:12em;color:#55518a"></h1>
                      <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
                      <h3 style="margin-top: 0;color:#55518a">Hotel Directory</h3>
                    </center>
                </div>
                <div class="bhoechie-tab-content">
                    <center>
                      <h1 class="glyphicon glyphicon-cutlery" style="font-size:12em;color:#55518a"></h1>
                      <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
                      <h3 style="margin-top: 0;color:#55518a">Restaurant Diirectory</h3>
                    </center>
                </div>
                <div class="bhoechie-tab-content">
                    <center>
                      <h1 class="glyphicon glyphicon-credit-card" style="font-size:12em;color:#55518a"></h1>
                      <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
                      <h3 style="margin-top: 0;color:#55518a">Credit Card</h3>
                    </center>
                </div>
            </div>
        </div>
  </div>
</div>
<script>
$(function(){
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});
</script>
<?php 
include 'footer.php'; ?>



