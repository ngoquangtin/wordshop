<?php
include( '../../incs/mysqli-connect.php' );
include( '../../incs/functions.php' );

$id = clean_input_data($_GET['id'],false);
$q = "delete from terms where term_id=$id limit 1";
$r = confirm_query($dbc,$q);
echo mysqli_affected_rows($dbc)==1 ? 'y' : 'n';