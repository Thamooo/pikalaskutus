<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Pikalaskutus</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
		<meta name="description" content="">
		<meta name="author" content="">

		<link href="<?php echo base_url(); ?>assets/default/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/default/css/style.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/default/css/animate.min.css" rel="stylesheet">
		<link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/default/img/app_icon.png">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/default/js/libs/jquery-1.7.1.min.js"></script>
		<style>
			body {
background: #282537;
 background-image: -webkit-radial-gradient(top, circle cover, #46455e 0%, #252233 80%);
 background-image: -moz-radial-gradient(top, circle cover, #46455e 0%, #252233 80%);
 background-image: -o-radial-gradient(top, circle cover, #46455e 0%, #252233 80%);
 background-image: radial-gradient(top, circle cover, #46455e 0%, #252233 80%);}
		</style>

		<!--[if lt IE 9]>
		  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
        
        <script type="text/javascript">
            $(function() { $('#email').focus(); });
        </script>

	</head>

	<body>

	<div class="hidden-phone animated fadeInUp" id="login">
        <?php if ($login_logo) { ?>
        <img src="<?php echo base_url(); ?>uploads/<?php echo $login_logo; ?>" class="login-logo">
        <?php } else { ?>
        <h1><?php echo lang('login'); ?></h1>
        <?php } ?>
		
		<form class="form-horizontal" method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

			<div class="control-group">
				<label class="control-label hidden-phone"><?php echo lang('email'); ?></label>
				<div class="controls">
					<input type="email" name="email" id="email" placeholder="<?php echo lang('email'); ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label hidden-phone"><?php echo lang('password'); ?></label>
				<div class="controls">
					<input type="password" name="password" id="password"  placeholder="<?php echo lang('password'); ?>">
				</div>
			</div>

			<div class="control-group">
				<div class="controls">
					<input type="submit" name="btn_login" value="<?php echo lang('login'); ?>" class="btn btn-primary">
				</div>
			</div>

		</form>

	</div><!--end.container-->

	<!--MOBILE LOGIN -->

	<div class="MobileLogin hidden-desctop hidden-tablet visible-phone">
        <?php if ($login_logo) { ?>
        <img src="<?php echo base_url(); ?>uploads/<?php echo $login_logo; ?>" class="login-logo">
        <?php } else { ?>
        <h1><?php echo lang('login'); ?></h1>
        <?php } ?>
		
		<form class="form-vertical" method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

					<input type="email" name="email" id="email" placeholder="<?php echo lang('email'); ?>"><br/>

					<input type="password" name="password" id="password"  placeholder="<?php echo lang('password'); ?>"><br/>

					<input type="submit" style="width:30%; margin-top: 25px;" name="btn_login" value="<?php echo lang('login'); ?>" class="btn btn-primary"><br/>

		</form>

	</div><!--end.container-->

	</body>
</html>