<div class="col-lg-2 col-sm-2">
	<h4><?php echo $_SESSION['user']['display_name']; ?></h4>
	<div class="follow-ava">
		<img id="open-avatar-box" class="img-avatar" style="cursor:pointer;" src="<?php echo $avatar_url; ?>" alt="<?php echo $_SESSION['user']['display_name']; ?>" />
	</div>
	
	<?php
		switch($_SESSION['user']['level']){
			case 1: $role = 'Administrator'; break;
			case 2: $role = 'Mod'; break;
			case 3: $role = 'Member'; break;
		}
	?>
	<h6><?php echo $role; ?></h6>
</div>