<?php session_start();

$files = array(
	'get-home-url',
	'get-admin-home-url',
	'get-login-url',
	'get-contact-url',
	'get-404-url',
	'defined-constants',
	'confirm-query',
	'get-excerpt',
	'trigger-form-missing-error',
	'clean-input-data',
	'save-input',
	'save-textarea',
	'is-logged-in',
	'check-user',
	'the-pagination',
	'get-permalink',
	'get-author-link',
	'get-term-link',
	'get-page-link',
	'get-edit-post-url',
	'create-fields-list-sql',
	'create-unique-file-name',
	'create-unique-slug',
	'get-permalink-by-id',
	'get-img-url',
	'get-options',
	'get-comments-num',
	'get-single-post-content',
	'get-id',
	'get-post-categories-list'
);

foreach($files as $f){
	$src = ($f != 'defined-constants') ? "function-scripts/function-$f" : "defined-constants/$f";
	$src .= '.php';
	include($src);
}


$not_allowed = array('login.php','redirect-back.php');
if( !in_array(FILE_NAME,$not_allowed) ){
	$_SESSION['redirect_back_url'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
}