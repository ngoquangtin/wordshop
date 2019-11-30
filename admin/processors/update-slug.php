<?php
include( '../../incs/mysqli-connect.php' );
include( '../../incs/functions.php' );

$post_id = clean_input_data($_GET['post_id'],false);
$slug = clean_input_data($_GET['slug'],false);

$patern = '/^([a-z0-9\-]+)$/';
if( preg_match($patern, $slug ) ){
	$q = "SELECT post_id FROM posts WHERE slug='$slug'";
	$r_select = confirm_query($dbc,$q);

	if(mysqli_affected_rows($dbc)==0){
		$q = "UPDATE posts SET slug='$slug' WHERE post_id=$post_id LIMIT 1";
		$r_update = confirm_query($dbc,$q);
		$output = mysqli_affected_rows($dbc)==1 ? 'The slug has been changed.' : 'Some Problem Occur. Please try it later.';
	} else {
		$output = 'This slug is already used. Please use another.';
	}
} else {
	$output = 'This slug is not valid. Please type a valid slug.';
}
echo $output;