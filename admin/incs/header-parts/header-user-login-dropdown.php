<!-- user login dropdown start-->
<?php
//$custom_jquery_scripts .= '<script src="js/custom-scripts/header-user-login-dropdownss.js"></script>'; 
?>
<li class="dropdown li-user-login-dropdown">
	<a data-toggle="dropdown" class="dropdown-toggle" href="#">
		<span class="profile-ava">								
			<?php $avatar_url = ( is_null($_SESSION['user']['avatar_url']) ) ? DEFAULT_USER_AVATAR_URL : $_SESSION['user']['avatar_url']; ?>
			<img class="img-avatar" width="30" height="30" alt="<?php echo $_SESSION['user']['display_name']; ?>" src="<?php echo $avatar_url ?>" />
		</span>
		<span class="username"><?php echo $_SESSION['user']['display_name']; ?></span>
		<b class="caret"></b>
	</a>
	
	<ul class="dropdown-menu extended logout">
		<div class="log-arrow-up"></div>
		
		<li class="eborder-top">
			<a href="<?php echo get_home_url(); ?>/my-profile"><i class="icon_profile"></i> My Profile</a>
		</li>
		
		<li>
			<a href="<?php echo get_home_url(); ?>/logout"><i class="icon_key_alt"></i> Log Out</a>
		</li>
	</ul>
</li>