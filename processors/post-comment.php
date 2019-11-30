<?php
include('../incs/mysqli-connect.php');
include('../incs/functions.php');

$user_id = clean_input_data((int)$_GET['user_id'],false);
$post_id = clean_input_data((int)$_GET['post_id'],false);
$content = clean_input_data($_GET['content'],false);
if(isset($_GET['author_user_id'])) $author_user_id = clean_input_data((int)$_GET['author_user_id'],false);

if(isset($_GET['comment_replied_id'])){
	$comment_replied_id = clean_input_data($_GET['comment_replied_id'],false);
} else {
	$comment_replied_id = 'null';
}

$q = "insert into comments (user_id,post_id,content,comment_replied_id) ";
$q.= " values($user_id,$post_id,'$content',$comment_replied_id)";

$r = confirm_query($dbc,$q);

if(mysqli_affected_rows($dbc)==1){//If Insert Comment Success
	
//Export New Comment Info To Show In Browser by AJAX
	$q = "select comment_id,content from comments order by comment_id desc limit 0,1";
	$r = confirm_query($dbc,$q);
	if(mysqli_affected_rows($dbc)==1){
		$comment = mysqli_fetch_array($r,MYSQLI_ASSOC);
	}
	
//Insert New Message To messages Table
	if(isset($author_user_id) && $user_id!=$author_user_id){
		$comment_id = $comment['comment_id'];
		
		$q = "insert into messages (comment_id,author_user_id,user_id,post_id,seen)";
		$q .= " values($comment_id,$author_user_id,$user_id,$post_id,0)";
		$r_mess = confirm_query($dbc,$q);
	}
} else {
	$comment = array();
}
die(json_encode($comment));


