<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="บริการเช่า BOT MUSIC">
	<meta name="author" content="">
	<link rel="shortcut icon" href="<?php echo site_url('favicon.png');?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('/assets/css/bootstrap.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('/assets/css/tether.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('/assets/css/bootstrap-slider.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('/assets/css/bootstrap-grid.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('/assets/css/bootstrap-reboot.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('/assets/css/font-awesome.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('/assets/css/dataTables.bootstrap4.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('/assets/joops.css');?>">
	<script type="text/javascript" src="<?php echo site_url('/assets/js/jquery-3.2.1.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo site_url('/assets/js/tether.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo site_url('/assets/js/bootstrap.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo site_url('/assets/js/jquery.dataTables.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo site_url('/assets/js/dataTables.bootstrap4.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo site_url('/assets/js/bootstrap-slider.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo site_url('/assets/engine.js');?>"></script>
	<script type="text/javascript">
		var $isLogin = <?Php if($Auth){echo "true";}else{echo "false";}?>;
		var $base_url = "<?php echo base_url();?>";
	</script>
	<title>Bot Music</title>
	<!-- 
	BY , TS3SIAM.
	-->
</head>
<body>
	<nav class="navbar navbar-toggleable-md navbar-inverse bg-primary bg-faded" id="Nav">
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="mainNavbar">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link change-page" href="dashboard"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
				</li>
				<li class="nav-item">
					<a class="nav-link change-page" href="payment"><i class="fa fa-bank" aria-hidden="true"></i> Payment</a>
				</li>
				<li class="nav-item">
					<a class="nav-link change-page" href="rent"><i class="fa fa-database" aria-hidden="true"></i> Rent</a>
				</li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link user-point" href="#"></a></li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('api/auth/logout');?>">
						<i class="fa fa-sign-out"></i> Logout
					</a>
				</li>

			</ul>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="col-md-12">
			<div class="main-content">

			</div>
		</div>
		<div class="col-md-12">
			<hr>
			<div class="text-center mt-25">
				Copyright © 2017  & <a href="#">TS3SIAM</a>.
			</div>
		</div>
	</div>
	<div class="be-loading-content" style="display: none;position: fixed;">
		<center>
			<div class="be-loading hidden-xs hidden-sm" style="left: 0px;top: 110px;">
				<div class="sk-cube-grid">
					<div class="sk-cube sk-cube1"></div>
					<div class="sk-cube sk-cube2"></div>
					<div class="sk-cube sk-cube3"></div>
					<div class="sk-cube sk-cube4"></div>
					<div class="sk-cube sk-cube5"></div>
					<div class="sk-cube sk-cube6"></div>
					<div class="sk-cube sk-cube7"></div>
					<div class="sk-cube sk-cube8"></div>
					<div class="sk-cube sk-cube9"></div>
				</div>
			</div>
		</center>
	</div>
</body>
</html>