<?php
function get_post_categories_list($post_id, $separate=', '){
	global $dbc;
	$q = "SELECT pm.term_id, t.name
		  FROM postmeta AS pm INNER JOIN terms AS t USING(term_id)
		  WHERE pm.post_id=$post_id AND t.taxonomy='category'
		  ORDER BY term_id ASC";
	$r = confirm_query($dbc,$q);

	$output = '';
	if( mysqli_affected_rows($dbc) > 0 ){
		$i = 1;
		while($term = mysqli_fetch_array($r,MYSQLI_NUM)){
			list($term_id, $name) = $term;

			if($i>1) $output .= $separate;
			$output .= '<a href="'.get_term_link($term_id).'">'.$name.'</a>';

			$i++;
		}
	}

	return $output;
}