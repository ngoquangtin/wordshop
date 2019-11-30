<?php

function is_logged_in($role = 3){
	// 1. Admin
	// 2. Mod
	// 3. Member
	$return = false;
	if( !empty($_SESSION['user']) ){
		
		if( !is_int($role) ){
			//If The Parameter Is Not Number, Switch It To Number
			switch( $role ){
				case 'admin': $role = 1; break;
				case 'supermod': $role = 2; break;
				case 'mod': $role = 3; break;
				default : $role = 3; break;
			}
		}
		if( $_SESSION['user']['level'] <= $role ) $return = true;
	}
	
	//If Not Login Or User Level Is not Permit, Return False
	return $return;
}