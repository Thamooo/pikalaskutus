<script type="text/javascript">

    $(function() {

        $('#btn_add_item_from_lookup').click(function() {
            $('#modal-placeholder').load("<?php echo site_url('item_lookups/ajax/modal_item_lookups'); ?>/" + Math.floor(Math.random()*1000));
        });
        
        $('#btn_add_item').click(function() {
            $('#new_item').clone().appendTo('#item_table').removeAttr('id').addClass('item').show();
        });

        <?php if (!$items) { ?>
            $('#new_item').clone().appendTo('#item_table').removeAttr('id').addClass('item').show();
        <?php } ?>
    
        $('#btn_create_recurring').click(function()
        {
            $('#modal-placeholder').load("<?php echo site_url('invoices/ajax/modal_create_recurring'); ?>", {invoice_id: <?php echo $invoice_id; ?>});
        });

        $('#btn_save_invoice').click(function() {
            var items = [];
			var item_order = 1;
            $('table tr.item').each(function() {
                var row = {};
                $(this).find('input,select,textarea').each(function() {
                    if ($(this).is(':checkbox')) {
                        row[$(this).attr('name')] = $(this).is(':checked');                        
                    } else {
                        row[$(this).attr('name')] = $(this).val();
                    }
                });
				row['item_order'] = item_order;
				item_order++;
                items.push(row);
            });
            $.post("<?php echo site_url('invoices/ajax/save'); ?>", {
                invoice_id: <?php echo $invoice_id; ?>,
                invoice_number: $('#invoice_number').val(),
                invoice_date_created: $('#invoice_date_created').val(),
                invoice_date_due: $('#invoice_date_due').val(),
                invoice_referencenum: $('#invoice_referencenum').val(),
                invoice_status_id: $('#invoice_status_id').val(),
                items: JSON.stringify(items),
                invoice_terms: $('#invoice_terms').val(),
                custom: $('input[name^=custom]').serializeArray()
            },
            function(data) {
                var response = JSON.parse(data);
                if (response.success == '1') {
                    window.location = "<?php echo site_url('invoices/view'); ?>/" + <?php echo $invoice_id; ?>;
                }
                else {
                    $('.control-group').removeClass('error');
                    for (var key in response.validation_errors) {
                        $('#' + key).parent().parent().addClass('error');
                    }
                }
            });
        });

        $('#btn_generate_pdf').click(function() {
            window.location = '<?php echo site_url('invoices/generate_pdf/' . $invoice_id); ?>';
        });
        
        var fixHelper = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        };

        $("#item_table tbody").sortable({
            helper: fixHelper
        });

    });

</script>

<script type="text/javascript">

            function tarkiste(viite) {
            var ki = 0;
            var summa = 0;
            var kertoimet = [7, 3, 1];

            for (var i = viite.length; i > 0; i--) {
            summa += viite.charAt(i - 1) * kertoimet[ki++ % 3];
            }

            return (10 - (summa % 10)) % 10;
            }

            function ryhmittele(viite) {
            var v = "";
            var o = 5 - viite.length % 5;
            for (var x = 0; x < viite.length; x++) {
            if (x > 0 && (o + x) % 5 == 0) v += " ";
            v += viite.charAt(x);
            }

            return v;
            }

            function laskeTarkisteet(event) {
            var tulokset = "";
            var viitteet = document.getElementById("viitteet").value.split("\n");
            var r = document.forms["viiteformi"].ryhmittele.checked;

            for (var x = 0; x < viitteet.length; x++) {
            var v = viitteet[x];
            v = v.replace("\r", "");
            if (v == "") continue;

            if (!/^[0-9]+$/.test(v)) {
            alert("Viitteessä " + v + " on virheellisiä merkkejä. Vain numerot kelpaavat.");
            return false;
            }
            if (v.length < 3) {
            alert("Viite " + v + " on liian lyhyt!");
            return false;
            }
            if (v.length > 19) {
            alert("Viite " + v + " on liian pitkä!");
            return false;
            }
            var t = v + tarkiste(v);
            tulokset += (r ? ryhmittele(t) : t) + "<br />";
            }

            document.getElementById("tarkistusnumerot").innerHTML = tulokset;
            return false;
            }
</script>

<!-- Modal -->
<div id="laskuri" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel"><?php echo lang('reference_number'); ?></h3>
</div>
<div class="modal-body">
    <form id="viiteformi" action="" method="post" onsubmit="return laskeTarkisteet();">
        <fieldset>
        <label class="checkbox"><input name="ryhmittele" checked="checked" type="checkbox"> Ryhmittele numerot</label>
        <textarea class="form-control" name="viitteet" id="viitteet" style="width:100%;"></textarea><br>
        <input class="btn btn-primary" value="<?php echo lang('send'); ?>" type="submit">
    </fieldset>
    </form>
    <pre id="tarkistusnumerot">-<br></pre>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo lang('close'); ?></button>
</div>
</div>

<?php echo $modal_delete_invoice; ?>
<?php echo $modal_add_invoice_tax; ?>

<div class="headerbar">
	<h1><?php echo lang('invoice'); ?> #<?php echo $invoice->invoice_number; ?></h1>
    <?php if ($invoice->invoice_is_recurring) { ?><span class="label label-info" style="margin-left: 10px;"><?php echo lang('recurring'); ?></span><?php } ?>

	<div class="pull-right">

		<div class="options btn-group pull-left">
			<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#" style="margin-right: 5px;"><i class="icon-cog"></i> <?php echo lang('options'); ?></a>
			<ul class="dropdown-menu">
				<li><a href="#add-invoice-tax" data-toggle="modal"><i class="icon-plus-sign"></i> <?php echo lang('add_invoice_tax'); ?></a></li>
                <li><a href="#" class="invoice-add-payment" data-invoice-id="<?php echo $invoice->invoice_id; ?>" data-invoice-balance="<?php echo $invoice->invoice_balance; ?>"><i class="icon-shopping-cart"></i> <?php echo lang('enter_payment'); ?></a></li>
				<li><a href="#" id="btn_generate_pdf" data-invoice-id="<?php echo $invoice_id; ?>"><i class="icon-print"></i> <?php echo lang('download_pdf'); ?></a></li>
				<li><a href="<?php echo site_url('mailer/invoice/' . $invoice->invoice_id); ?>"><i class="icon-envelope"></i> <?php echo lang('send_email'); ?></a></li>
				<li><a href="#" id="btn_copy_invoice" data-invoice-id="<?php echo $invoice_id; ?>"><i class="icon-repeat"></i> <?php echo lang('copy_invoice'); ?></a></li>
                <li><a href="#" id="btn_create_recurring" data-invoice-id="<?php echo $invoice_id; ?>"><i class="icon-list"></i> <?php echo lang('create_recurring'); ?></a></li>
				<li><a href="#delete-invoice" data-toggle="modal"><i class="icon-remove"></i> <?php echo lang('delete'); ?></a></li>
			</ul>
		</div>
		
		<a href="#" class="btn btn-default" id="btn_add_item" style="margin-right: 5px;"><i class="icon-plus-sign"></i> <?php echo lang('add_item'); ?></a>
        <a href="#" class="btn btn-default" id="btn_add_item_from_lookup" style="margin-right: 5px;"><i class="icon-plus-sign"></i> <?php echo lang('add_item_from_lookup'); ?></a>
		
		<a href="#" class="btn btn-primary" id="btn_save_invoice"><i class="icon-ok icon-white"></i> <?php echo lang('save'); ?></a>
	</div>

</div>

<div class="content">
    
    <?php echo $this->layout->load_view('layout/alerts'); ?>
	
	<form id="invoice_form" class="form-horizontal">

		<div class="invoice">

			<div class="cf">

				<div class="pull-left">

                    <h2><a href="<?php echo site_url('clients/view/' . $invoice->client_id); ?>"><?php echo $invoice->client_name; ?></a></h2><br>
					<span>
						<?php echo ($invoice->client_address_1) ? $invoice->client_address_1 . '<br>' : ''; ?>
						<?php echo ($invoice->client_address_2) ? $invoice->client_address_2 . '<br>' : ''; ?>
						<?php echo ($invoice->client_city) ? $invoice->client_city : ''; ?>
						<?php echo ($invoice->client_state) ? $invoice->client_state : ''; ?>
						<?php echo ($invoice->client_zip) ? $invoice->client_zip : ''; ?>
						<?php echo ($invoice->client_country) ? '<br>' . $invoice->client_country : ''; ?>
					</span>
					<br><br>
					<?php if ($invoice->client_phone) { ?>
					<span><strong><?php echo lang('phone'); ?>:</strong> <?php echo $invoice->client_phone; ?></span><br>
					<?php } ?>
					<?php if ($invoice->client_email) { ?>
					<span><strong><?php echo lang('email'); ?>:</strong> <?php echo $invoice->client_email; ?></span>
					<?php } ?>

				</div>

				<table style="width: 400px;" class="pull-right table table-striped table-bordered">
                    
                    <tbody>
                        <tr>
                            <td>
                                <div class="control-group invoice-properties">
                                    <label class="control-label"><?php echo lang('invoice'); ?> #</label>
                                    <div class="controls">
                                        <input type="text" id="invoice_number" class="input-small" value="<?php echo $invoice->invoice_number; ?>" style="margin: 0px;">    
                                    </div>
                                </div>
                                <div class="control-group invoice-properties">
                                    <label class="control-label"><?php echo lang('date'); ?></label>
                                    <div class="controls">
                                        <input type="text" id="invoice_date_created" class="input-small" value="<?php echo date_from_mysql($invoice->invoice_date_created); ?>" style="margin: 0px;">    
                                    </div>
                                </div>
                                <div class="control-group invoice-properties">
                                    <label class="control-label"><?php echo lang('due_date'); ?></label>
                                    <div class="controls">
                                        <input type="text" id="invoice_date_due" class="input-small" value="<?php echo date_from_mysql($invoice->invoice_date_due); ?>" style="margin: 0px;">
                                    </div>
                                </div>
                                <div class="control-group invoice-properties">
                                    <label class="control-label"><?php echo lang('reference_number'); ?></label>
                                    <div class="controls">
                                        <input type="text" id="invoice_referencenum" class="input-small" value="<?php echo $invoice->invoice_referencenum; ?>" style="margin: 0px;">
                                    </div>
                                </div>
                                <div class="control-group invoice-properties">
                                    <label class="control-label"><?php echo lang('status'); ?></label>
                                    <div class="controls">
                                        <select name="invoice_status_id" id="invoice_status_id">
                                            <?php foreach ($invoice_statuses as $key=>$status) { ?>
                                            <option value="<?php echo $key; ?>" <?php if ($key == $invoice->invoice_status_id) { ?>selected="selected"<?php } ?>><?php echo $status['label']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <br><br>
                                        <a href="#laskuri" class="btn btn-primary" role="button" data-toggle="modal">Viitenumerolaskuri</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>

				</table>

			</div>

			<?php $this->layout->load_view('invoices/partial_item_table'); ?>
			
			<p><strong><?php echo lang('invoice_terms'); ?></strong></p>
			<textarea id="invoice_terms" name="invoice_terms" style="width: 100%;" rows="5"><?php echo $invoice->invoice_terms; ?></textarea>
            <br><br>
            
            <?php foreach ($custom_fields as $custom_field) { if($custom_field->user_id==$_SESSION['user_id']){?>
            <p><strong><?php echo $custom_field->custom_field_label; ?></strong></p>
                    <input type="text" name="custom[<?php echo $custom_field->custom_field_column; ?>]" id="<?php echo $custom_field->custom_field_column; ?>" value="<?php echo form_prep($this->mdl_invoices->form_value('custom[' . $custom_field->custom_field_column . ']')); ?>">
            <?php }} ?>

            <p class="padded"><?php echo lang('guest_url'); ?>: <?php echo auto_link(site_url('guest/view/invoice/' . $invoice->invoice_url_key)); ?></p>
            
		</div>
		
	</form>

</div>