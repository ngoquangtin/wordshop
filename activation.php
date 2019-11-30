<?php
include('incs/functions.php');
if( !isset($_GET['a']) || !isset($_GET['b']) || !isset($_GET['c']) || !isset($_GET['d']) )
	header("Location: ". get_home_url() .'/login.php' );

include('incs/mysqli-connect.php');
$key = clean_input_data( $_GET['b'], false );

$q = "update users set activation_key=null, activation_url=null where activation_key='$key'";
$r = confirm_query($dbc, $q);

if( mysqli_affected_rows($dbc) == 1 ){
	header("Location: ". get_home_url() .'/login.php?activation=true' );
} else {
	header("Location: ". get_home_url() .'/login.php' );
}