<?php
function get_login_url($action='login'){
	$action = ($action!='login') ? '?action='.$action : '';
	return get_home_url().'/login.php'.$action;
}