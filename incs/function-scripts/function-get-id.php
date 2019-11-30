<?php
function get_id($type, $redirect=''){
	$type = $type."_id";
	if( isset($_GET[$type]) && is_numeric($_GET[$type]) && $_GET[$type]>=1 ){
		$id = $_GET[$type];
	} else {
		if(empty($redirect)) $redirect = get_admin_home_url();
		header("Location: ". $redirect);
	}
	return $id;
}