<div class="row">
	<div class="col-lg-12">
		<section class="panel">
		
		<?php 
			$dir = 'profile-tabs-part'; 
			include( $dir.'/tabs-menu.php' );
		?>
		
			<div class="panel-body">
				<div class="tab-content">
				  <?php include( $dir.'/daily-activity-tab.php' ); ?>
				  <?php include( $dir.'/profile-info-tab.php' ); ?>
				  <?php include( $dir.'/edit-profile-tab.php' ); ?>
				</div>
			</div>
		</section>
	</div>
</div>