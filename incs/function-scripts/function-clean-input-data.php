<?php
function clean_input_data( $input, $is_form, $type='post'){
	global $dbc;
	
	if( $is_form ){
		$data = array();
		$i=0;
		foreach( $input as $f ){
			if($type=='post'){
				$data[$f] = mysqli_real_escape_string( $dbc, strip_tags( trim($_POST[$f]) ) );
			} elseif($type=='get'){
				$data[$i] = mysqli_real_escape_string( $dbc, strip_tags( trim($_GET[$f]) ) );
				$i++;
			}
		}
	} else {
		$data = mysqli_real_escape_string( $dbc, strip_tags( trim($input) ) );
	}
	
	return $data;
}