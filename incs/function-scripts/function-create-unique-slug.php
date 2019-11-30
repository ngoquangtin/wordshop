<?php
function create_unique_slug($title){
	global $dbc;
	$title = clean_input_data($title,false);
	$slug = str_replace(" ", "-", strtolower(trim($title)));

	$q = "SELECT post_id FROM posts WHERE slug='$slug'";
	$r = confirm_query($dbc,$q);
	if(mysqli_affected_rows($dbc)==1) $slug .= '-2';
	return $slug;
}