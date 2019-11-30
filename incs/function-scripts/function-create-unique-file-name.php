<?php
function create_unique_file_name($file_name){
	$a = explode('.',$file_name);
	return uniqid(rand()).'.'.$a[count($a)-1];
}