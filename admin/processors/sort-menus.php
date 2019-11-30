<?php
include( '../../incs/mysqli-connect.php' );
include( '../../incs/functions.php' );

$order = $_POST['order'];
$menu = $order[0];
unset($order[0]);

$error = false;
foreach($order as $k => $v){
	if($menu == 'categories'){
		$table = "terms"; $id_field = "term_id";
	} else if($menu == 'pages'){
		$table = "pages"; $id_field = "page_id";
	}

	$q = "UPDATE $table SET position=".($k+1)." WHERE $id_field=$v LIMIT 1";
	$r = confirm_query($dbc,$q);

	if(!$error && mysqli_affected_rows($dbc) == 0){
		$error = true;
	}
}

echo (!$error) ? 'The '.ucfirst($menu).' Menu has been updated.' : 'Some Problem Occur. Please try it later.';