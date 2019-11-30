<?php
function get_page_link( $slug ){
	$alias = get_home_url(). '/page/' .$slug;
	return $alias;
}