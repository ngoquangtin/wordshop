<?php
include( '../../incs/mysqli-connect.php' );
include( '../../incs/functions.php' );

$id = clean_input_data($_GET['id'],false);

$q="update messages set seen=1 where message_id=$id limit 1";
$r=confirm_query($dbc,$q);

