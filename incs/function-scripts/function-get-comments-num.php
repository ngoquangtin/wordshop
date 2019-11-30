<?php
function get_comments_num($post_id, $singular_text = '', $plural_text = ''){
	global $dbc;
	$q="SELECT count(comment_id) from comments where post_id=$post_id";
	$r=confirm_query($dbc,$q);
	if(mysqli_affected_rows($dbc)==1){
		list($comments_num)=mysqli_fetch_array($r,MYSQLI_NUM);
	} else {
		$comments_num=0;
	}
	return ($comments_num==1) ? $comments_num.$singular_text : $comments_num.$plural_text;
}