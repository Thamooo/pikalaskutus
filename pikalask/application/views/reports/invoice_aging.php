<html>
	<head>
		<title><?php echo lang('invoice_aging'); ?></title>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/reports.css" type="text/css">
		<style type="text/css">
		.separator {width:100%; height: 20px; border-bottom: 1px solid #000;}
		</style>
	</head>
	<body>
		
		<h3 class="report_title"><?php echo lang('invoice_aging'); ?></h3>
		
		<table>
			<tr>
				<th><?php echo lang('client'); ?></th>
				<th class="amount"><?php echo lang('invoice_aging_1_15'); ?></th>
				<th class="amount"><?php echo lang('invoice_aging_16_30'); ?></th>
				<th class="amount"><?php echo lang('invoice_aging_above_30'); ?></th>
				<th class="amount"><?php echo lang('total'); ?></th>
			</tr>
			<div style="separator"></div>
			<?php foreach ($results as $result) { ?>
			<tr>
				<td><?php echo $result->client_name; ?></td>
				<td class="amount"><?php echo format_currency($result->range_1); ?></td>
				<td class="amount"><?php echo format_currency($result->range_2); ?></td>
				<td class="amount"><?php echo format_currency($result->range_3); ?></td>
				<td class="amount"><?php echo format_currency($result->total_balance); ?></td>
			</tr>
			<div style="separator"></div>
			<?php } ?>
		</table>
	</body>
</html>