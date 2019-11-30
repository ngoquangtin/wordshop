<div class="row">
	<div class="col-lg-12">
		<div class="profile-widget profile-widget-info">
			<div class="panel-body">
			
			<?php 
				$dir = 'profile-widget-part'; 
			
			//Avatar Part
				include($dir.'/avatar.php');
			//Follow Info 1
				include($dir.'/follow-info-1.php');
			//Follow Info 2
				include($dir.'/follow-info-2.php');
			//Follow Info 3
				include($dir.'/follow-info-3.php');
			//Follow Info 4
				include($dir.'/follow-info-4.php');
			?>

		
			</div><!-- end .panel-body-->
		</div><!-- end .profile-widget-->
	</div><!-- end .col-lg-12-->
</div><!-- end .row-->