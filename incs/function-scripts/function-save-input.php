<?php
function save_input($button, $field){
	if( isset($_POST[$button]) ) echo ' value="'. $_POST[$field] .'" ';
}