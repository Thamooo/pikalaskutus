<div class="headerbar">
	<h1><?php echo lang('item_lookups'); ?></h1>

	<div class="pull-right">
		<a class="btn btn-primary" href="<?php echo site_url('item_lookups/form'); ?>"><i class="icon-plus icon-white"></i> <?php echo lang('new'); ?></a>
	</div>
	
	<div class="pull-right">
		<?php echo pager(site_url('item_lookups/index'), 'mdl_item_lookups'); ?>
	</div>

</div>

<div class="table-content">

	<?php echo $this->layout->load_view('layout/alerts'); ?>

	<table class="table table-striped">

		<thead>
			<tr>
				<th><?php echo lang('item_name'); ?></th>
				<th><?php echo lang('description'); ?></th>
	            <th><?php echo lang('price'); ?></th>
				<th><?php echo lang('options'); ?></th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($item_lookups as $item_lookup) { ?>
			<tr>
				<td><?php echo $item_lookup->item_name; ?></td>
				<td><?php echo $item_lookup->item_description; ?></td>
	            <td><?php echo format_currency($item_lookup->item_price); ?></td>
				<td>
					<div class="options btn-group">
						<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> <?php echo lang('options'); ?></a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo site_url('item_lookups/form/' . $item_lookup->item_lookup_id); ?>">
									<i class="icon-pencil"></i> <?php echo lang('edit'); ?>
								</a>
							</li>
							<li>
								<a href="<?php echo site_url('item_lookups/delete/' . $item_lookup->item_lookup_id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');">
									<i class="icon-trash"></i> <?php echo lang('delete'); ?>
								</a>
							</li>
						</ul>
					</div>
				</td>
			</tr>
			<?php } ?>
		</tbody>

	</table>

</div>