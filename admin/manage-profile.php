<?php 
include('../incs/mysqli-connect.php');
include('../incs/functions.php');
check_user();

#Submit Form -> Update Profile
	if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

		//Sanitize The Datas
			$fields = array('display_name', 'first_name', 'last_name', 'email', 'password', 'bio');	
			$data = clean_input_data($fields,true);
			
			$display_name = $data['display_name'];
			$email = $data['email'];
			$bio = $data['bio'];
			$bio = (!is_null($bio)) ? "'$bio'" : 'null';
			$first_name = $data['first_name'];
			$last_name = $data['last_name'];
			$user_id = $_SESSION['user']['user_id'];
			$password = $data['password'];
		
		//Set The SQL Query
			$q = "
				UPDATE users SET display_name='$display_name', email='$email', bio=$bio,
								 first_name='$first_name', last_name='$last_name' ";

			#If Password Is not Empty, Update The Password
				if(!empty($password)) $q .= ", password='".sha1($password)."'";
			
			$q .= " WHERE user_id=$user_id 
					LIMIT 1";
		
		//Run The Query
			$r = confirm_query($dbc,$q);
			if(mysqli_affected_rows($dbc) != 1) $error = 'error sql';
			
			if(!isset($error)){
				$error = 'success';
				
				//Update The Session If Updated Profile Success
				foreach( $fields as $f ){
					if( $f != 'bio' ){
						//All fields are required, except the bio field.
						$_SESSION['user'][$f] = $data[$f];
					} else {
						//Bio Can Be Null, So Check It
						$_SESSION['user'][$f] = ( !is_null($data[$f]) ) ? $data[$f] : NULL;
					}
				}
			}
	}

#Set Some Vars To Call In Header
	$title = $_SESSION['user']['display_name']. ' - Profile';
	$cfiles = array('manage-profile.css');

#Call Header
	include('incs/header.php');

#Call Page Parts
	include('incs/profile-page-parts/profile-widget.php');
	include('incs/profile-page-parts/profile-tabs.php');
	include('incs/set-avatar-box.php');

#Set Some jQuery Scripts To Call In Footer
	$jfiles[] = 'http://malsup.github.com/jquery.form.js';
	$jfiles[] = 'manage-profile.js';

#Call Footer
	include('incs/footer.php');
