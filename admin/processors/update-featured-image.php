<?php
include( '../../incs/mysqli-connect.php' );
include( '../../incs/functions.php' );

$post_id = clean_input_data((int)$_GET['post_id'],false);
$abs_path = clean_input_data($_GET['abs_path'],false);
if($abs_path!='null') $abs_path = "'$abs_path'";

$q = "update posts set thumbnail_url=$abs_path where post_id=$post_id limit 1";
$r = confirm_query($dbc,$q);

echo (mysqli_affected_rows($dbc)==1) ? 'yes' : 'no';
