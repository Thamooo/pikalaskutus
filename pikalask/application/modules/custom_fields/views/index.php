<div class="headerbar">
	<h1><?php echo lang('custom_fields'); ?></h1>

	<div class="pull-right">
		<a class="btn btn-primary" href="<?php echo site_url('custom_fields/form'); ?>"><i class="icon-plus icon-white"></i> <?php echo lang('new'); ?></a>
	</div>
	
	<div class="pull-right">
		<?php echo pager(site_url('custom_fields/index'), 'mdl_custom_fields'); ?>
	</div>

</div>

<div class="table-content">

	<?php echo $this->layout->load_view('layout/alerts'); ?>

	<table class="table table-striped">

		<thead>
			<tr>
				<th><?php echo lang('table'); ?></th>
				<th><?php echo lang('label'); ?></th>
	            <th><?php echo lang('column'); ?></th>
				<th><?php echo lang('options'); ?></th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($custom_fields as $custom_field) { if($custom_field->user_id==$_SESSION['user_id']){?>
			<tr>
				<td><?php echo $custom_field->custom_field_table; ?></td>
				<td><?php echo $custom_field->custom_field_label; ?></td>
	            <td><?php echo $custom_field->custom_field_column; ?></td>
				<td>
					<div class="options btn-group">
						<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> <?php echo lang('options'); ?></a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo site_url('custom_fields/form/' . $custom_field->custom_field_id); ?>">
									<i class="icon-pencil"></i> <?php echo lang('edit'); ?>
								</a>
							</li>
							<li>
								<a href="<?php echo site_url('custom_fields/delete/' . $custom_field->custom_field_id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');">
									<i class="icon-trash"></i> <?php echo lang('delete'); ?>
								</a>
							</li>
						</ul>
					</div>
				</td>
			</tr>
			<?php }} ?>
		</tbody>

	</table>

</div>