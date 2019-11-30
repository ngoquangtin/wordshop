<?php
function create_fields_list_sql($sql_fields){
	$return = '';
	foreach($sql_fields as $i=>$f){
		$return .= ($i==0) ? " $f " : " ,$f ";
	}
	return $return;
}