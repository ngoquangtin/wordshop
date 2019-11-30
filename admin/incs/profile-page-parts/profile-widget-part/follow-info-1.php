<div class="col-lg-4 col-sm-4 follow-info">
	<?php if( !is_null($_SESSION['user']['bio']) ) echo '<p id="p-user-bio">'. $_SESSION['user']['bio'] .'</p>'; ?>

	<p>@<?php echo $_SESSION['user']['display_name']; ?></p>
	<p><i class="fa fa-twitter"><?php echo $_SESSION['user']['display_name']; ?></i></p>
	<h6>
		<span><i class="icon_clock_alt"></i>11:05 AM</span>
		<span><i class="icon_calendar"></i>25.10.13</span>
		<span><i class="icon_pin_alt"></i>NY</span>
	</h6>
</div>