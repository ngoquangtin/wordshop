<?php
//This Function Use Only For The Admin Site
function check_user($role = 3, $url = null ){
	if( is_null($url) ) $url = get_admin_home_url();
	if( !is_logged_in($role) ) header("Location: $url");
}