<?php
include('../incs/mysqli-connect.php');
include('../incs/functions.php');

$comment_id = clean_input_data((int)$_GET['comment_id'],false);
$depth = clean_input_data((int)$_GET['depth'],false);

$return=array();
$q = "delete from comments where comment_id=$comment_id limit 1";
$r = confirm_query($dbc,$q);
$return[] = (mysqli_affected_rows($dbc)==1) ? 'y':'n';

//Delete It In messages Table
$q = "delete from messages where comment_id=$comment_id limit 1";
$r_mess = confirm_query($dbc,$q);

if($depth==1){//Delete Its Comment Replied
	$q = "select comment_id from comments where comment_replied_id=$comment_id";
	$r_count = confirm_query($dbc,$q);
	
	if(mysqli_affected_rows($dbc)>0){
		$q = "delete from comments where comment_replied_id=$comment_id";
		$r = confirm_query($dbc,$q);
		$return[] = (mysqli_affected_rows($dbc)>0) ? 'y':'n';
	}
	
	
}
echo (!in_array('n',$return)) ? 'y':mysqli_error($dbc);