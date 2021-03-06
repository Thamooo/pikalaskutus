<!doctype html>

<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>Pikalaskutus</title>

        <meta name="viewport" content="width=device-width,initial-scale=1">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/style.css">

        <style>
            body {
                color: #000 !important;
				overflow-y: auto;
            }
            table {
                width:100%;
            }
            
            .no-bottom-border {
                border:none !important;
                background-color: white !important;
            }
            .alignr {
                text-align: right;
            }
            #invoice-container {
                margin: auto;
                margin-top: 25px;
                width: 900px;
                padding: 20px;
                top:10px;
                background-color: white;
                box-shadow: 4px 4px 14px rgba(0, 0, 0, 0.8);
                overflow-y: hidden;
            }
            #menu-container {
                margin: auto;
                margin-top: 25px;
                width: 900px;
                top:10px;
                overflow-y: hidden;
            }
            .flash-message {
                font-size: 120%;
                font-weight: bold;
            }


            table {
                width:100%;
            }
            #header table {
                width:100%;
                padding: 0px;
                margin-top: 20px;
                margin-bottom: 5px;
            }
            #header table td, .amount-summary td {
                vertical-align: text-top;
                padding: 5px;
            }
            #company-name{
                color:#000;
                font-size: 11px;
            }
            #company-name > img {
                display:block;
            }
            #invoice-to td {
                text-align: left
            }
            #invoice-to {
                margin-bottom: 15px;
            }
            #invoice-to-right-table td {
                padding-right: 5px;
                padding-left: 5px;
                text-align: right;
            }
            .seperator {
                height: 25px;
                border-top: 2px solid #000;
            }
            .seperatorDashed {
                height: 25px;
                margin-bottom: 20px;
                border-top: 1px dashed #333;
            }
            .seperatorlight {
                height: 25px;
                border-top: 1px solid #ccc;
            }
            h2 {font-size: 14px;}
            p  {font-size: 10px;}
            .top-border {
                border-top: none;
            }
            .no-bottom-border {
                border:none !important;
                background-color: white !important;
            }
            table {
  border-collapse: collapse;
  vertical-align:text-top;
}
.wrapper {width:100%; height: auto; background: transparent; margin-bottom:20px; position:relative;}
        </style>

    </head>

    <body>

        <div id="menu-container">
            
            <a href="<?php echo site_url('guest/view/generate_invoice_pdf/' . $invoice_url_key); ?>" class="btn btn-primary"><i class="icon-white icon-print"></i> <?php echo lang('download_pdf'); ?></a> 
        
            
            <?php if ($flash_message) { ?>
            <div class="alert flash-message">
                <?php echo $flash_message; ?>
            </div>
            <?php } ?>
        </div>





        <div id="invoice-container">
<!--lasku -->




<div class="wrapper">
        <div id="header">
            <table>
                <tr>
                    <td id="company-name">
                        <?php echo invoice_logo(); ?>
                        <h4><?php echo $invoice->user_name; ?></h4>
             
                    </td>
                    <td style="text-align: right;"><h2><?php echo lang('invoice'); ?> <?php echo $invoice->invoice_number; ?></h2></td>
                </tr>
            </table>
        </div>
        <div id="invoice-to">
            <table style="width: 100%; border-top: 1px solid #000; border-bottom: 1px solid #000;">
                <tr>
                    <p style="margin-bottom:20px; font-size:9px;"><?php echo lang('bill_to'); ?>:</p>
                    <td style="padding: 30px auto 40px 20px; width:50%;">
                        <p style="font-size:12px; line-height:18px;"><?php echo $invoice->client_name; ?><br>
                            <?php if ($invoice->client_address_1) { echo $invoice->client_address_1 . '<br>'; } ?>
                            <?php if ($invoice->client_address_2) { echo $invoice->client_address_2 . '<br>'; } ?>
                            <?php if ($invoice->client_zip) { echo $invoice->client_zip . ' '; } ?>
                            <?php if ($invoice->client_city) { echo $invoice->client_city . '<br>'; } ?>
                        </p>
                    </td>
                    <td style="text-align: right; width:50%; padding: 30px auto 40px 20px;">
                        <table id="invoice-to-right-table width:100%;">
                            <tbody>
                                <tr>
                                    <td style="width:130px;"><?php echo lang('invoice_date'); ?>: </td>
                                    <td><strong><?php echo date_from_mysql($invoice->invoice_date_created, TRUE); ?></strong></td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('due_date'); ?>: </td>
                                    <td><strong><?php echo date_from_mysql($invoice->invoice_date_due, TRUE); ?></strong></td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('amount_due'); ?>: </td>
                                    <td><strong><?php echo format_currency($invoice->invoice_balance); ?></strong></td>
                                </tr>
                                  
                                 <tr>
                                    <td><?php echo lang('reference_number'); ?>: </td>
                                    <td><strong><?php echo $invoice->invoice_referencenum; ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div id="invoice-items" style="position:relative;">
            <table class="table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="text-align: left; width:30%;"><?php echo lang('item'); ?></th>
                        <th style="text-align: left; width:30%;"><?php echo lang('description'); ?></th>
                        <th style="text-align: left; width:10%;"><?php echo lang('qty'); ?></th>
                        <th style="text-align: left; width:15%;"><?php echo lang('price'); ?></th>
                        <th style="text-align: left; width:15%;"><?php echo lang('total'); ?></th>
                    </tr>
                </thead>
            </table>


            <table class="table table-striped" style="width: 100%; position:relative; margin-top:-20px:">
                <tbody>
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td style="text-align: left; width:30%;"><?php echo $item->item_name; ?></td>
                            <td style="text-align: left; width:30%;"><?php echo nl2br($item->item_description); ?></td>
                            <td style="text-align: left; width:10%;"><?php echo format_amount($item->item_quantity); ?></td>
                            <td style="text-align: left; width:15%;"><?php echo format_currency($item->item_price); ?></td>
                            <td style="text-align: left; width:15%;"><?php echo format_currency($item->item_subtotal); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <table style="position:relative;">
                <tr>
                    <td style="text-align: right; margin-top:500px; margin-bottom:20px;">
                        <table class="amount-summary">
                            <tr>
                                <td style="text-align: right;"><?php echo lang('subtotal'); ?>:</td>
                                <td style="text-align: right;"><?php echo format_currency($invoice->invoice_item_subtotal); ?></td>
                            </tr>
                            <?php if ($invoice->invoice_item_tax_total > 0) { ?>
                            <tr>
                                <td style="text-align: right;"><?php echo lang('tax'); ?></td>
                                <td style="text-align: right;"><?php echo format_currency($invoice->invoice_item_tax_total); ?>:</td>
                            </tr>
                            <?php } ?>
                            <?php foreach ($invoice_tax_rates as $invoice_tax_rate) : ?>
                                <tr>    
                                    <td style="text-align: right;"><?php echo $invoice_tax_rate->invoice_tax_rate_name . ' ' . $invoice_tax_rate->invoice_tax_rate_percent; ?>%</td>
                                    <td style="text-align: right;"><?php echo format_currency($invoice_tax_rate->invoice_tax_rate_amount); ?></td>
                                </tr>
                            <?php endforeach ?>
                            <tr>
                                <td style="text-align: right;"><?php echo lang('total'); ?>:</td>
                                <td style="text-align: right;"><?php echo format_currency($invoice->invoice_total); ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right;"><?php echo lang('paid'); ?>:</td>
                                <td style="text-align: right;"><?php echo format_currency($invoice->invoice_paid) ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right;"><?php echo lang('balance'); ?>:</td>
                                <td style="text-align: right;"><strong><?php echo format_currency($invoice->invoice_balance) ?></strong></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            
        </div>
       
</div><!--WRAPPER-->


 <div style="display: block; position: relative; bottom: 0; left:0;"/>
 <div class="seperatorDashed"></div>
        <table width="100%" cellpadding="8" cellspacing="0">
    <tr style="width:10%;">
        <td style="width:10%; border-bottom: 2px solid #333;"><p style="font-size:8px; text-align:right;"><strong><?php echo lang('recipient_iban'); ?>:</strong></p></td>
        <td style="border-bottom: 2px solid #333; border-right: 2px solid #333; border-left: 2px solid #333;"><p style="font-size:8px; text-align:right;"><strong><?php echo lang('bank_account_number'); ?>:</strong></p> <?php echo $invoice->user_iban; ?></td>
        <td style="border-bottom: 2px solid #333;"><p style="font-size:8px; text-align:right;"><strong><?php echo lang('bank_bic_number'); ?>:</strong></p> <?php echo $invoice->user_bic; ?></td>
    </tr>
    <tr>
        <td style="width:10%; border-bottom: 2px solid #333;"><p style="font-size:8px; text-align:right;"><strong><?php echo lang('recipient'); ?>:</strong></p></td>
        <td style="border-bottom: 2px solid #333; border-right: 2px solid #333; border-left: 2px solid #333;">
                        <p style="font-size:11px;">
                            <strong><?php echo $invoice->user_name; ?></strong><br/>
                            <?php if ($invoice->user_register_number) { echo $invoice->user_register_number . '<br>'; } ?>
                            <?php if ($invoice->user_address_1) { echo $invoice->user_address_1 . '<br>'; } ?>
                            <?php if ($invoice->user_address_2) { echo $invoice->user_address_2 . '<br>'; } ?>
                            <?php if ($invoice->user_state) { echo $invoice->user_state . ' '; } ?>
                            <?php if ($invoice->user_city) { echo $invoice->user_city . ' '; } ?>
                            <?php if ($invoice->user_zip) { echo $invoice->user_zip . '<br>'; } ?>
                        </p></td>
        <td style="border-left: 2px solid #333; width:50%;"><?php if ($invoice->invoice_terms) { ?>
            <p><strong><?php echo lang('terms'); ?></strong></p>
            <p><?php echo nl2br($invoice->invoice_terms); ?></p>
            <?php } ?></td>
    </tr>
    <tr>
        <td style="width:10%; border-bottom: 2px solid #333;"><p style="font-size:8px; text-align:right;"><strong><?php echo lang('bill_to'); ?>:</strong></p></td>
                    <td style="border-bottom: 2px solid #333; border-right: 2px solid #333; border-left: 2px solid #333;">
                        <p style="font-size:11px;"><strong><?php echo $invoice->client_name; ?></strong><br>
                            <?php if ($invoice->client_register_number) { echo $invoice->client_register_number . '<br>'; } ?>
                            <?php if ($invoice->client_address_1) { echo $invoice->client_address_1 . '<br>'; } ?>
                            <?php if ($invoice->client_address_2) { echo $invoice->client_address_2 . '<br>'; } ?>
                            <?php if ($invoice->client_city) { echo $invoice->client_city . ' '; } ?>
                            <?php if ($invoice->client_state) { echo $invoice->client_state . ' '; } ?>
                            <?php if ($invoice->client_zip) { echo $invoice->client_zip . '<br>'; } ?>
                           
                        </p>
                        <br/>
                    <table width="100%">
                        <tr style="border-bottom: 1px solid #333;">
                            <td>
                            <?php echo lang('merchant_signature'); ?>:<br/>
                            </td>
                        </tr>
                    </table>
                        
                        
                    </td>

        <td style="border-bottom: 2px solid #333;"></td>
    </tr>
    <tr style="height:30px; overflow:hidden;">
        <td style="width:10%; border-bottom: 2px solid #333;"><p style="font-size:8px; text-align:right;"><strong><?php echo lang('client_iban'); ?>:</strong></p></td>
        <td style="border-bottom: 2px solid #333; border-right: 2px solid #333; border-left: 2px solid #333;"><br/>
        </td>
        <td style="border-bottom: 2px solid #333;">   
  <table style="border-collapase:collapse; margin:-8px auto auto -8px;" width="100%" cellpadding="4" cellspacing="0">
    <tr>
        <td style="border-bottom: 2px solid #333; border-right: 2px solid #333; height:20px; line-height:20px;"><p style="font-size:8px;"><strong><?php echo lang('reference_number'); ?>:</strong></p> </td>
        <td style="border-bottom: 2px solid #333; height:20px; line-height:20px;" ><?php echo $invoice->invoice_referencenum; ?></td>
    </tr>
    <tr>
        <td style="border-right: 2px solid #333; height:20px; line-height:20px;"><p style="font-size:8px;"><strong><?php echo lang('due_date'); ?>:</strong></p></td>
        <td style="border-right: 2px solid #333;"><strong><p style="padding:5px;"><?php echo date_from_mysql($invoice->invoice_date_due, TRUE); ?></p></strong></td>
        <td style="height:20px; line-height:20px; border-top: 2px solid #333;"><?php echo lang('balance'); ?>:   <strong><?php echo format_currency($invoice->invoice_balance) ?></strong></td>
    </tr>
</table>


        </td>
    </tr>
</table>
</div>




<!--lasku -->

        </div>

    </body>
</html>