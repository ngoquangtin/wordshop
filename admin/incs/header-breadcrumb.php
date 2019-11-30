<?php
	//$page_title = 'Dashboard';
	
?>

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><?php echo $page_title; ?></h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="<?php echo get_admin_home_url(); ?>">Home</a></li>
			<?php echo $li_breadcrumb_output; ?>
		</ol>
	</div>
</div>