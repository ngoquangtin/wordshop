<?php
function get_author_link( $id ){
	/*$alias = get_home_url(). '/author/' .$slug;
	return $alias;*/
	return "author.php?user_id=$id";
}