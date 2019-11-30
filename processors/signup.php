<?php
include('../incs/mysqli-connect.php');
include('../incs/functions.php');

	$return = '';

	$email = $_GET['email'];

	$email = mysqli_real_escape_string($dbc, htmlentities( strip_tags( trim($email) ) ) );
	
	$q = "SELECT user_id from users where user_email='$email' limit 1";
	$r = confirm_query($dbc, $q);
	
	if( mysqli_num_rows($r) == 1 ){
		$return = 'NO';
	} else {
		$return = 'YES';
	}
	

	
	echo $return;