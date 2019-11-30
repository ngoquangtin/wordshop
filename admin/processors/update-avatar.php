<?php
include( '../../incs/mysqli-connect.php' );
include( '../../incs/functions.php' );

$abs_path = clean_input_data($_GET['abs_path'],false);
$user_id = clean_input_data((int)$_GET['user_id'],false);

$q = "UPDATE users SET avatar_url='$abs_path' WHERE user_id=$user_id limit 1";
$r = confirm_query($dbc,$q);
if(mysqli_affected_rows($dbc)==1){
	echo 'y';
	$_SESSION['user']['avatar_url'] = $abs_path; // Update Avatar URL in SESSION
} else {
	echo 'n';
}