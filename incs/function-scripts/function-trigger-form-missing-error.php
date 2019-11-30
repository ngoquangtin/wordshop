<?php
function trigger_form_missing_error( $fields ){
	$errors = array();
	foreach( $fields as $f ){
		if( empty($_POST[$f]) ){
			$errors[] = $f;
		} elseif( $f == 'email' && !filter_var( $_POST[$f], FILTER_VALIDATE_EMAIL ) ){
			$errors[] = 'not_valid';
		}
	}
	
	return $errors;
}