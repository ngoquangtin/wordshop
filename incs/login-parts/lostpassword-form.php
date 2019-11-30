<?php

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	$email = clean_input_data($_POST['email'], false);
	
	$sql_fields = array('user_id');
	$q = "select ". create_fields_list_sql($sql_fields);
	$q .= " from users where email='$email' limit 1";
	$r = confirm_query($dbc, $q);
	
	if( mysqli_num_rows($r) == 1 ){
		//If Email is exist, Send an Email
		$key1 = sha1( uniqid( rand() ) );
		$key2 = sha1( uniqid( rand() ) );
		$key3 = sha1( uniqid( rand() ) );
		$key4 = sha1( uniqid( rand() ) );
		
		$url = get_login_url('resetpassword').'&e='.$key1.'&f='.$key2.'&g='.$key3.'&h='.$key4 ;
						
		$q_ins = "update users set reset_password_key='$key4', reset_password_url='$url' where email='$email' limit 1";
		$r_ins = confirm_query($dbc, $q_ins);
		
		if( mysqli_affected_rows($dbc) == 1 ){
			header("Location: ". get_home_url(). '/login.php?checkemail=confirm');
		} else {
			$error = true;
		}

	} else {
		$error = true;
	}
}

?>
	
	<h1><a href="#">Powered by WordPress</a></h1>
	
	<p class="message">Please enter your email address. You will receive a link to create a new password via email.</p>
	
	<?php if(isset($error) && $error): ?>
	<div id="login_error">
		<strong>ERROR</strong>: There is no account with that email address.
	</div>
	<?php endif; ?>
	
	<form name="loginform" id="loginform" method="post">
		<p>
			<label for="email">Email Address<br />
			<input required type="email" <?php save_input('wp-submit','email'); ?> name="email" class="input" size="20" autocapitalize="off" /></label>
		</p>
		
		<p class="submit">
			<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Get New Password" />
		</p>
	</form>

	<p id="nav">
		<a href="<?php echo get_login_url(); ?>">Login</a> | 
		<a href="<?php echo get_login_url('register'); ?>">Register</a>
	</p>
