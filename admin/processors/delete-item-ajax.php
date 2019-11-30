<?php
include( '../../incs/mysqli-connect.php' );
include( '../../incs/functions.php' );

$table = clean_input_data($_GET['table'], false);
$field = clean_input_data($_GET['type'], false).'_id';
$value = clean_input_data($_GET['id'], false);

$q = "DELETE from $table where $field=$value limit 1";
$r = confirm_query($dbc,$q);

echo (mysqli_affected_rows($dbc)==1) ? 'success' : 'error';