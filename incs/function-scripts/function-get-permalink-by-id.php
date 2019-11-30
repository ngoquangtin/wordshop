<?php
function get_permalink_by_id($id){
	global $dbc;
	$q = "select slug from posts where post_id=$id";
	$r = confirm_query($dbc,$q);	
	
	$return = get_home_url();
	
	if(mysqli_affected_rows($dbc)==1){
		list($slug) = mysqli_fetch_array($r,MYSQLI_NUM);
		$return .= "/$slug";
	}
	
	return $return;
}