<?php
function save_textarea($button, $field){
	if( isset($_POST[$button]) ) echo $_POST[$field];
}