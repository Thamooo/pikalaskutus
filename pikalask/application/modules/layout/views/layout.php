<!doctype html>

<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

	<head>

		<meta charset="utf-8">

		<!-- Use the .htaccess and remove these lines to avoid edge case issues -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php echo $this->session->userdata('user_name'); ?></title>
		<meta name="description" content="">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/style.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/animate.min.css">

		<script src="<?php echo base_url(); ?>assets/default/js/libs/modernizr-2.0.6.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/libs/jquery-1.7.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/default/js/libs/jquery-ui-1.10.3.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/libs/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/mobile_links.js"></script>

        <script type="text/javascript">

            $(function()
            {
                $('.nav-tabs').tab();
                $('.tip').tooltip();
				
                $('.datepicker').datepicker({ format: '<?php echo date_format_datepicker(); ?>'});
		
                $('.create-invoice').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('invoices/ajax/modal_create_invoice'); ?>");
                });
				
                $('.create-quote').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('quotes/ajax/modal_create_quote'); ?>");
                });
				
                $('#btn_quote_to_invoice').click(function() {
                    quote_id = $(this).data('quote-id');
                    $('#modal-placeholder').load("<?php echo site_url('quotes/ajax/modal_quote_to_invoice'); ?>/" + quote_id);
                });
				
                $('#btn_copy_invoice').click(function() {
                    invoice_id = $(this).data('invoice-id');
                    $('#modal-placeholder').load("<?php echo site_url('invoices/ajax/modal_copy_invoice'); ?>", {invoice_id: invoice_id});
                });
                
                $('#btn_copy_quote').click(function() {
                    quote_id = $(this).data('quote-id');
                    $('#modal-placeholder').load("<?php echo site_url('quotes/ajax/modal_copy_quote'); ?>", {quote_id: quote_id});
                });
                
                $('.client-create-invoice').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('invoices/ajax/modal_create_invoice'); ?>", {
                        client_name: $(this).data('client-name')
                    });
                });
                $('.client-create-quote').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('quotes/ajax/modal_create_quote'); ?>", {
                        client_name: $(this).data('client-name')
                    });
                });
				$(document).on('click', '.invoice-add-payment', function() {
                    invoice_id = $(this).data('invoice-id');
                    invoice_balance = $(this).data('invoice-balance');
                    $('#modal-placeholder').load("<?php echo site_url('payments/ajax/modal_add_payment'); ?>", {invoice_id: invoice_id, invoice_balance: invoice_balance });
                });

            });

        </script>

     <script> 
$(document).ready(function(){
  $("#flippi").click(function(){
    $("#paneeli").slideToggle("fast");
  });
});
</script>

	</head>

	<body>
  <header class="visible-phone">
  <div style="width:100%; z-index:100; padding:7px 0px 6px 0px; background:#333; color:#fff;">
<div style="width:20%; float:left;">
<a href="javascript: window.history.go(-1)"><i style="color:#fff; font-size:35px; text-align:left; vertical-align:middle; margin:5px 0px 0 15px;" class="icon-angle-left"></i></a>
</div>
  <div style="width:60%; float:left;">
<h3 style="margin-left: 20px; text-align:center;">Pikalaskutus</h3>
  </div>
  <div id="flippi" style="float:left; wdth:20%; float:right; cursor:pointer;">
  	<i style="font-size:25px; text-align:right; float:right; vertical-align:middle; margin:7px 15px 0 0;" class="icon-align-justify"></i>
  </div>
  <div>
  	  <div id="paneeli" style="width:100%; background:#f1f1f1; line-height:24px; font-size:18px; margin-top:45px;">
  	<ul style="margin:0px; padding:0px;">
  		<li style="background:#fff; margin-bottom:15px; margin-top:10px; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('dashboard', lang('dashboard')); ?></li>
  	
  		<li style="background:#fff; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('clients/form', lang('add_client')); ?></li>
  		<li style="background:#fff; margin-bottom:15px; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('clients/index', lang('view_clients')); ?></li>
  		
  		<li style="background:#fff; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><a href="#" class="create-quote"><?php echo lang('create_quote'); ?></a></li>
		<li style="background:#fff; margin-bottom:15px; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('quotes/index', lang('view_quotes')); ?></li>
		
		<li style="background:#fff; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><a href="#" class="create-invoice"><?php echo lang('create_invoice'); ?></a></li>
		<li style="background:#fff; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('invoices/index', lang('view_invoices')); ?></li>
        <li style="background:#fff; margin-bottom:15px; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('invoices/recurring/index', lang('view_recurring_invoices')); ?></li>
        
        <li style="background:#fff; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('payments/form', lang('enter_payment')); ?></li>
		<li style="background:#fff; margin-bottom:15px; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('payments/index', lang('view_payments')); ?></li>
		
		<li style="background:#fff; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('reports/invoice_aging', lang('invoice_aging')); ?></li>
		<li style="background:#fff; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('reports/payment_history', lang('payment_history')); ?></li>
		<li style="background:#fff; margin-bottom:15px; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('reports/sales_by_client', lang('sales_by_client')); ?></li>
		
  		<li style="background:#fff; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('custom_fields/index', lang('custom_fields')); ?></li>
		<li style="background:#fff; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('email_templates/index', lang('email_templates')); ?></li>
		<li style="background:#fff; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('invoice_groups/index', lang('invoice_groups')); ?></li>
        <li style="background:#fff; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('item_lookups/index', lang('item_lookups')); ?></li>
		<li style="background:#fff; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('tax_rates/index', lang('tax_rates')); ?></li>
		<li style="background:#fff; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('users/index', lang('user_accounts')); ?></li>
		<li style="background:#fff; margin-bottom:15px; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('settings', lang('system_settings')); ?></li>
        
        <li style="background:#fff; margin-bottom:15px; padding:10px 15px 10px 15px; border-bottom:1px solid #ddd;"><?php echo anchor('sessions/logout', lang('logout')); ?></li>
  	</ul>
  </div>
<div style="clear:both;"></div>
  </header>

		<nav class="navbar navbar-inverse">
			<div class="navbar-inner">
				<div class="container">

					<div class="navLogo hidden-phone"><img class="notie" alt="" src="<?php echo base_url(); ?>assets/default/img/icons/logo.png" height="24" width="24" title="pikalaskutus" /> <img class="ieonly" alt="" src="<?php echo base_url(); ?>assets/default/img/icons/ie/logo.png" height="24" width="24" title="pikalaskutus" /></div>
					<ul class="nav hidden-phone">
						<li><?php echo anchor('dashboard', lang('dashboard')); ?></li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="icon-user" style="margin-right:5px;"></b><?php echo lang('clients'); ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('clients/form', lang('add_client')); ?></li>
								<li><?php echo anchor('clients/index', lang('view_clients')); ?></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="icon-file" style="margin-right:5px;"></b><?php echo lang('quotes'); ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#" class="create-quote"><?php echo lang('create_quote'); ?></a></li>
								<li><?php echo anchor('quotes/index', lang('view_quotes')); ?></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="icon-file" style="margin-right:5px;"></b><?php echo lang('invoices'); ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#" class="create-invoice"><?php echo lang('create_invoice'); ?></a></li>
								<li><?php echo anchor('invoices/index', lang('view_invoices')); ?></li>
                                <li><?php echo anchor('invoices/recurring/index', lang('view_recurring_invoices')); ?></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="icon-dollar" style="margin-right:5px;"></b><?php echo lang('payments'); ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('payments/form', lang('enter_payment')); ?></li>
								<li><?php echo anchor('payments/index', lang('view_payments')); ?></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="icon-file" style="margin-right:5px;"></b><?php echo lang('reports'); ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('reports/invoice_aging', lang('invoice_aging')); ?></li>
								<li><?php echo anchor('reports/payment_history', lang('payment_history')); ?></li>
								<li><?php echo anchor('reports/sales_by_client', lang('sales_by_client')); ?></li>
							</ul>
						</li>

					</ul>

					<?php if (isset($filter_display) and $filter_display == TRUE) { ?>
					<?php $this->layout->load_view('filter/jquery_filter'); ?>
					<form class="navbar-search pull-left">
						<input type="text" class="search-query" id="filter" placeholder="<?php echo $filter_placeholder; ?>">
					</form>
					<?php } ?>

					<ul class="nav pull-right settings hidden-phone">
                        <li id="welcome" class="visible-desctop"><a href="<?php echo base_url(); ?>index.php/users/index"><?php echo lang('welcome') . ' ' . $this->session->userdata('user_name'); ?></a></li>
						<li class="divider-vertical"></li>
						<li class="dropdown">
							<a href="#" class="tip icon dropdown-toggle" data-toggle="dropdown" data-original-title="<?php echo lang('settings'); ?>" data-placement="bottom"><i class="icon-cog"></i></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo lang('documentation_url'); ?>" target="_blank"><?php echo lang('documentation'); ?></a></li>
								<li class="divider"></li>
                                <li><?php echo anchor('custom_fields/index', lang('custom_fields')); ?></li>
								<li><?php echo anchor('email_templates/index', lang('email_templates')); ?></li>
                                <!--NO IMPORT!!<li><?php echo anchor('import', lang('import_data')); ?></li>-->
								<li><?php echo anchor('invoice_groups/index', lang('invoice_groups')); ?></li>
                                <li><?php echo anchor('item_lookups/index', lang('item_lookups')); ?></li>
								<!--NO PAYMENT!! <li><?php echo anchor('payment_methods/index', lang('payment_methods')); ?></li>-->
								<li><?php echo anchor('tax_rates/index', lang('tax_rates')); ?></li>
								<li><?php echo anchor('users/index', lang('user_accounts')); ?></li>
								<li><?php echo anchor('settings', lang('system_settings')); ?></li>
                                <li class="divider"></li>
                                <li><?php echo anchor('sessions/logout', lang('logout')); ?></li>
                                
							</ul>
						</li>
					</ul>

				</div>

			</div>

		</nav>

		<div class="sidebar">

			<ul class="notie">
				<li><a href="<?php echo site_url('dashboard'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/hallinta.png" height="24" width="24" title="<?php echo lang('dashboard'); ?>" /></a></li>
				<li><a href="<?php echo site_url('clients/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/asiakkaat.png" height="24" width="24" title="<?php echo lang('clients'); ?>" /></a></li>
				<li><a href="<?php echo site_url('quotes/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/tarjoukset.png" height="24" width="24" title="<?php echo lang('quotes'); ?>" /></a></li>
				<li><a href="<?php echo site_url('invoices/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/laskut.png" height="24" width="24" title="<?php echo lang('invoices'); ?>" /></a></li>
				<li><a href="<?php echo site_url('payments/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/maksut.png" height="24" width="24" title="<?php echo lang('payments'); ?>" /></a></li>
			</ul>
			<ul class="ieonly">
				<li><a href="<?php echo site_url('dashboard'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/ie/hallinta.png" height="24" width="24" title="<?php echo lang('dashboard'); ?>" /></a></li>
				<li><a href="<?php echo site_url('clients/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/ie/asiakkaat.png" height="24" width="24" title="<?php echo lang('clients'); ?>" /></a></li>
				<li><a href="<?php echo site_url('quotes/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/ie/tarjoukset.png" height="24" width="24" title="<?php echo lang('quotes'); ?>" /></a></li>
				<li><a href="<?php echo site_url('invoices/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/ie/laskut.png" height="24" width="24" title="<?php echo lang('invoices'); ?>" /></a></li>
				<li><a href="<?php echo site_url('payments/index'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/ie/maksut.png" height="24" width="24" title="<?php echo lang('payments'); ?>" /></a></li>
			</ul>

		</div>

		<div class="main-area">

			<div id="modal-placeholder"></div>
			
			<?php echo $content; ?>

		</div><!--end.content-->

		<script defer src="<?php echo base_url(); ?>assets/default/js/plugins.js"></script>
		<script defer src="<?php echo base_url(); ?>assets/default/js/script.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/bootstrap-datepicker.js"></script>

		<!--[if lt IE 7 ]>
			<script src="<?php echo base_url(); ?>assets/default/js/dd_belatedpng.js"></script>
			<script type="text/javascript"> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
		<![endif]-->

		<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
			 chromium.org/developers/how-tos/chrome-frame-getting-started -->
		<!--[if lt IE 7 ]>
		  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		  <script type="text/javascript">window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->

	</body>
</html>