<?php
include( '../../incs/mysqli-connect.php' );
include( '../../incs/functions.php' );

if(isset($_GET['id'])){//If User Click Delete Message Item, get its ID
	$id = clean_input_data((int)$_GET['id'],false);
	$q = "delete from messages where message_id=$id limit 1";
	$r=confirm_query($dbc,$q);if(mysqli_affected_rows($dbc)==0) echo $q;
} elseif(isset($_POST['ids'])) {//If User Click Delete All Messages, get ids array
	$ids = $_POST['ids'];
	foreach($ids as $id){
		$q = "delete from messages where message_id=$id limit 1";
		$r=confirm_query($dbc,$q);
		
		if(mysqli_affected_rows($dbc)==0) echo $q;
	}
} else {
	echo 'No Response';
}
