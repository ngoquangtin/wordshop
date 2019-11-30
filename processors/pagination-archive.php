<?php
include('../incs/mysqli-connect.php');
include('../incs/functions.php');

//Get Some Vars
	$data = clean_input_data(array('target','limit','paginate_value','paginate_action'),true,'get');
	list($target,$limit,$paginate_value,$paginate_action) = $data;

//Calculate The $start
	$start = ($target-1)*$limit;

#Set The Way To Get Posts By SQL
	switch($paginate_action){
		case 'term':
			$where = " inner join postmeta using(post_id) where term_id=$paginate_value ";
			break;

		case 'user':
			$where = " where user_id=$paginate_value ";
			break;

		case 'search':
			$where = " where content LIKE '%$paginate_value%' ";
			break;

		case 'archive':
			$where = " where date_format(post_time, '%b %Y')='$paginate_value' ";
			break;
	}

//Mysqli To Get Posts
	$q = "
		SELECT p.post_id, p.title, p.slug, p.content, p.thumbnail_url 
		from posts as p 
		$where
		order by post_id DESC
		limit $start,$limit
	";
	$r = confirm_query($dbc,$q);

	if( mysqli_affected_rows( $dbc ) > 0 ) :
		$posts = array();
		$i=0;
		while( $post = mysqli_fetch_array( $r, MYSQLI_ASSOC ) ) :
			$posts[$i] = $post;
			$posts[$i]['permalink'] = get_permalink($post['slug']);
			$posts[$i]['excerpt'] = create_excerpt($post['content'],600). ' [...]';
			$posts[$i]['edit_post_link'] = (is_logged_in(2)) ? get_edit_post_link($post['post_id']) : '';
			$posts[$i]['thumbnail_url'] = get_default_img_url($post['thumbnail_url']);
			$i++;
		endwhile;
	endif;

//Get The $posts Back To AJAX
	die(json_encode($posts));
