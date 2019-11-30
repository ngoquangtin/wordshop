<?php

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	$message = '';
	if($_POST['password']!=$_POST['confirm-password']){
		$error='not match';
		$message = 'The Confirm Password does not match.';
	}
	
	if(!isset($error)){
		$data = clean_input_data(array('account', 'first-name', 'last-name', 'email', 'password'), true);
		$account = $data['account'];
		$email = $data['email'];

		$r_account = confirm_query($dbc, "select user_id from users where account='$account'");
		$r_email = confirm_query($dbc, "select user_id from users where email='$email'");
		
		if(mysqli_num_rows($r_email)>0){
			$error = 'email exist';
			$message = 'This email is already registered. Please choose another one.';
		}
		if(mysqli_num_rows($r_account)>0){
			$error = 'account exist';
			$message = 'This account is already registered. Please choose another one.';
		}
		
		if(!isset($error)){
			$password = sha1($data['password']);
			$sql_fields = array(
				'account',
				'display_name',
				'email',
				'password',
				'level',
				'first_name',
				'last_name',
				'activation_key',
				'activation_url',
				'registration_time'
			);
			
			$q = "insert into users (".create_fields_list_sql($sql_fields).")";
			
			$first_name = $data['first-name'];
			$last_name = $data['last-name'];
			
			$a = sha1(uniqid(rand()));
			$b = sha1(uniqid(rand()));
			$c = sha1(uniqid(rand()));
			$d = sha1(uniqid(rand()));
			
			$activation_url = get_home_url(). "/activation.php?a=$a&b=$b&c=$c&d=$d";
			
			$display_name = $data['first-name'].' '.$data['last-name'];
			$q .= " values('$account','$display_name','$email','$password',3,'$first_name','$last_name','$b','$activation_url',NOW())";
			$r_update = confirm_query($dbc,$q);
			
			if(mysqli_affected_rows($dbc)==1){
				header("Location: ". get_home_url(). '/login.php?checkemail=registered');
			} else {
				$error = 'error';
				$message = 'A system error occur. Please try it later.';
			}
		}
	}
}

?>

	<h1><a href="#">Powered by WordPress</a></h1>
	
	<p class="message">Register For This Site</p>
	
	<?php if(isset($error)): ?>
	<div id="login_error">
		<strong>ERROR</strong>: <?php if(!empty($message)) echo $message; ?>
	</div>
	<?php endif; ?>
	
	<form name="loginform" id="loginform" method="post">
		<?php $submit='wp-submit'; ?>
		<p>
			<label for="account">Login Account<br />
			<input <?php save_input($submit,'account'); ?> name="account" class="input" size="20" autocapitalize="off" type="text" required /></label>
		</p>
		<p>
			<label for="first-name">First Name<br />
			<input <?php save_input($submit,'first-name'); ?> name="first-name" class="input" size="20" autocapitalize="off" type="text" required /></label>
		</p>
		
		<p>
			<label for="last-name">Last Name<br />
			<input <?php save_input($submit,'last-name'); ?> name="last-name" class="input" size="20" autocapitalize="off" type="text" required /></label>
		</p>

		<p>
			<label for="email">Email Address<br />
			<input <?php save_input($submit,'email'); ?> name="email" class="input" size="20" autocapitalize="off" type="email" required /></label>
		</p>
		
		<p>
			<label for="password">Password<br />
			<input name="password" class="input" size="20" autocapitalize="off" type="password" required /></label>
		</p>
		
		<p>
			<label for="confirm-password">Confirm Password<br />
			<input name="confirm-password" class="input" size="20" autocapitalize="off" type="password" required /></label>
		</p>

		<p class="submit">
			<input type="submit" name="<?php echo $submit; ?>" id="wp-submit" class="button button-primary button-large" value="Register" />
		</p>
	</form>

	<p id="nav">
		<a href="<?php echo get_login_url(); ?>">Login</a> | 
		<a href="<?php echo get_login_url('lostpassword'); ?>">Lost your password?</a>
	</p>