<?php

	if( !isset($_GET['e']) || !isset($_GET['f']) || !isset($_GET['g']) || !isset($_GET['h']) )
		header("Location: login.php");
	
	$key = clean_input_data( $_GET['h'], false );
	
	$q = "select user_id from users where reset_password_key='$key'";
	$r = confirm_query($dbc, $q);
	
	if( mysqli_num_rows($r) == 0 ) header("Location: login.php");
	

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	
	if($_POST['password'] != $_POST['confirm-password']) $error = 'not match';
	
	if( !isset($error) ){
		$password = sha1(clean_input_data( $_POST['password'], false ));
		$q = "update users set password='$password', reset_password_key=null, reset_password_url=null where reset_password_key='$key' limit 1";
		$r = confirm_query($dbc, $q);

		if( mysqli_affected_rows($dbc) == 1 ){
			header("Location: login.php?resetpassword=true");
		} else {
			$error = 'error';
		}
	}
}

?>
	
	<h1><a href="#">Powered by WordPress</a></h1>
	
	<p class="message">Change your new password.</p>
	
	<?php if(isset($error) && $error=='not match'): ?>
	<div id="login_error">
		<strong>ERROR</strong>: The confirm password does not match.
	</div>
	<?php endif; ?>
	
	<?php if(isset($error) && $error=='error'): ?>
	<div id="login_error">
		<strong>ERROR</strong>: A system error occur. Please try it later.
	</div>
	<?php endif; ?>
	
	<form name="loginform" id="loginform" method="post">
		<p>
			<label for="password">Password<br />
			<input name="password" class="input" size="20" autocapitalize="off" type="password" required /></label>
		</p>
		
		<p>
			<label for="confirm-password">Confirm Password<br />
			<input name="confirm-password" class="input" size="20" type="password" autocapitalize="off" required /></label>
		</p>
		
		<p class="submit">
			<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Get New Password" />
		</p>
	</form>

	<p id="nav">
		<a href="<?php echo get_login_url(); ?>">Login</a> | 
		<a href="<?php echo get_login_url('register'); ?>">Register</a>
	</p>
