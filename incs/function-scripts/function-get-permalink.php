<?php
function get_permalink( $slug ){
	$alias = get_home_url(). "/$slug";
	return $alias;
}