<?php
include( '../../incs/mysqli-connect.php' );
include( '../../incs/functions.php' );

#Get $post_id
	$post_id = $_POST['data'][0];

#Get Will Be Updated Terms List & Count
	$will_updated_terms_list = $_POST['data'][1];
	$will_updated_terms_count = count($will_updated_terms_list);

#Get Current Terms List & Count In DB -> $current_terms_list
	$q = "SELECT ID FROM postmeta WHERE post_id=$post_id ORDER BY ID ASC";
	$r_current_terms = confirm_query($dbc,$q);
	$current_terms_list = array();
	while($current = mysqli_fetch_array($r_current_terms,MYSQLI_NUM)){$current_terms_list[] = $current[0];}
	$current_terms_count = count($current_terms_list);

#Until Here, We Have 4 Necessary Variables
	//Current_terms -> 		1. $current_terms_list
	//						2. $current_terms_count

	//Will_updated_terms 	3. $will_updated_terms_list
	//						4. $will_updated_terms_count

#Compare 2 Counts Number
	$error = array();
	if($will_updated_terms_count == $current_terms_count){
		for ($i=0; $i < $current_terms_count; $i++) { 
			$q = "UPDATE postmeta SET term_id=".$will_updated_terms_list[$i]." WHERE ID=".$current_terms_list[$i]." LIMIT 1";
			$r_update = confirm_query($dbc,$q);
			if(mysqli_affected_rows($dbc)==0){
				if( !in_array("error", $error) ) $error[] = 'error';
			}
		}
	} elseif($will_updated_terms_count > $current_terms_count) {
		
		for ($i=0; $i < $current_terms_count; $i++) { 
			$q = "UPDATE postmeta SET term_id=".$will_updated_terms_list[$i]." WHERE ID=".$current_terms_list[$i]." LIMIT 1";
			$r_update = confirm_query($dbc,$q);
			if(mysqli_affected_rows($dbc)==0){
				if( !in_array("error", $error) ) $error[] = 'error';
			}
		}

		$q = "INSERT INTO postmeta (post_id,term_id) VALUES ";
		for ($i=$current_terms_count; $i < $will_updated_terms_count; $i++) { 
			if($i>$current_terms_count) $q.= ", ";
			$q .= "($post_id, ".$will_updated_terms_list[$i].")";
		}
		$r_insert = confirm_query($dbc,$q);
		if(mysqli_affected_rows($dbc)==0){
			if( !in_array("error", $error) ) $error[] = 'error';
		}
	} elseif($will_updated_terms_count < $current_terms_count){
		
		for ($i=0; $i < $will_updated_terms_count; $i++) { 
			$q = "UPDATE postmeta SET term_id=".$will_updated_terms_list[$i]." WHERE ID=".$current_terms_list[$i]." LIMIT 1";
			$r_update = confirm_query($dbc,$q);

			if(mysqli_affected_rows($dbc)==0){
				if( !in_array("error", $error) ) $error[] = 'error';
			}
		}

		for ($i=$will_updated_terms_count; $i < $current_terms_count; $i++) { 
			$q = "DELETE FROM postmeta WHERE ID=".$current_terms_list[$i]." LIMIT 1";
			$r_delete = confirm_query($dbc,$q);

			if(mysqli_affected_rows($dbc)==0){
				if( !in_array("error", $error) ) $error[] = 'error';
			}
		}

	}

echo !in_array("error",$error) ? 'The categories has been changed.' : 'Some Problem Occur. Please try it later.';