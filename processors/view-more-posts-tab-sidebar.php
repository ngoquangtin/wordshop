<?php
include('../incs/mysqli-connect.php');
include('../incs/functions.php');

	$return = array();
	$q = "SELECT title, left(content,600) as excerpt, slug";
	$q .= " from posts";
	$q .= " ORDER BY RAND()";
	$q .= " LIMIT 0,10";
	$r = confirm_query($dbc,$q);
	
	if( mysqli_num_rows($r) > 0 ) :
		$i=0;
		while( $row = mysqli_fetch_array($r, MYSQLI_ASSOC) ) :
			
			//$return[] = '<li><a href="'. get_permalink($row['slug']) .'">'. $row['title'] .'</a><span class="span-tooltips-group">'.htmlentities($row['excerpt']).' [...]</span></li>';
		
			$return[$i] = array(
				'title' => $row['title'],
				'url' => get_permalink($row['slug']),
				'excerpt' => htmlentities($row['excerpt']). ' [...]'
			);
			$i++;
		endwhile;
	endif;
	
die (json_encode($return));





