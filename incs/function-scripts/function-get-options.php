<?php
function get_options($options){
	global $dbc;
	if(!is_array($options)){//Get Just 1 Option
		$q = "select set_value from settings where set_name='$options' limit 1";
		$r = confirm_query($dbc, $q);
		list($a) = mysqli_fetch_array($r, MYSQLI_NUM);
	} else {//Get More Than 1 Options, that means $options is an array
		$q = "select set_value from settings where ";
		foreach($options as $k=>$o){
			if($k>0) $q.=" or "; 
			$q .= " set_name='$o' ";
		}
		$r = confirm_query($dbc, $q);
		
		while($result = mysqli_fetch_array($r,MYSQLI_ASSOC)){
			$return[] = $result;
		}
		
		$a=array();
		foreach($options as $k=>$o){
			$a[$o] = $return[$k]['set_value'];
		}
	}
	
	return $a;
}