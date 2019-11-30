<?php

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	$data = clean_input_data(array('account', 'password'), true);
	
	$sql_fields = array(
		'user_id',
		'display_name',
		'email',
		'level',
		'bio',
		'avatar_url',
		'first_name',
		'last_name',
		'registration_time'
	);
	$q = "select ". create_fields_list_sql($sql_fields);
	$q .= " from users where account='".$data['account']."' and password='".sha1($data['password'])."' and activation_key is null limit 1";
	$r = confirm_query($dbc, $q);
	
	if(mysqli_num_rows($r)==1){
		$user = mysqli_fetch_array($r,MYSQLI_ASSOC);
		$user['account'] = $data['account'];
		$_SESSION['user'] = $user;
		
		$redirect = (isset($_SESSION['redirect_back_url'])) ? get_home_url().'/redirect' : get_admin_home_url();
		header("Location: ". $redirect);
	} else {
		$error = true;
	}
}

?>

	<h1><a href="<?php echo get_home_url(); ?>">Powered by WordPress</a></h1>
	
	<?php if($action=='loggedout') : ?>
	<p class="message">You are now logged out.</p>
	<?php endif; ?>
	
	<?php if($action=='checkemail to confirm') : ?>
	<p class="message">Check your email for the confirmation link.</p>
	<?php endif; ?>
	
	<?php if($action=='checkemail to activate') : ?>
	<p class="message">Check your email for the activate account link.</p>
	<?php endif; ?>
	
	<?php if($action=='resetpassword') : ?>
	<p class="message">Your password has been changed.</p>
	<?php endif; ?>
	
	<?php if($action=='activation') : ?>
	<p class="message">Your account has been activated. You can log in now !</p>
	<?php endif; ?>
	
	
	<?php if(isset($error) && $error): ?>
	<div id="login_error">
		<strong>ERROR</strong>: The account or password is incorrect. Or this account is not activated.
		<a href="<?php echo get_login_url('lostpassword'); ?>">Lost your password?</a><br>
	</div>
	<?php endif; ?>
	<form name="loginform" id="loginform" method="post">
		<p>
			<label for="account">Account<br />
			<input name="account" <?php save_input('wp-submit','account'); ?> class="input" size="20" autocapitalize="off" type="text" required /></label>
		</p>
		<p>
			<label for="password">Password<br />
			<input name="password" class="input" size="20" type="password" required /></label>
		</p>
		<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"  /> Remember Me</label></p>
		<p class="submit">
			<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In" />
		</p>
	</form>

	<p id="nav">
		<a href="<?php echo get_login_url('register'); ?>">Register</a> | 
		<a href="<?php echo get_login_url('lostpassword'); ?>">Lost your password?</a>
	</p>
