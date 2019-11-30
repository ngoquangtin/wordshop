<?php
include('../incs/mysqli-connect.php');
include('../incs/functions.php');

//Get Some Vars
	$data = clean_input_data(array('target','limit'),true,'get');
	list($target,$limit) = $data;

//Calculate The $start
	$start = ($target-1)*$limit;

//Mysqli To Get Posts
	$q = "
		SELECT  p.post_id, p.title, p.slug AS post_slug, p.content, p.thumbnail_url, date_format(p.posted_time, '%d-%m-%Y') as day,
				u.user_id, u.display_name
		FROM posts AS p INNER JOIN users AS u USING(user_id)
		ORDER BY post_id DESC
		LIMIT $start,$limit
	";
	$r = confirm_query($dbc,$q);

	if( mysqli_affected_rows( $dbc ) > 0 ) :
		$posts = array();
		$i=0;
		while( $post = mysqli_fetch_array( $r, MYSQLI_ASSOC ) ) :
			$posts[$i] = $post;
			$posts[$i]['permalink'] = get_permalink($post['post_slug']);
			$posts[$i]['author_link'] = get_author_link($post['user_id']);
			$posts[$i]['list_categories'] = get_post_categories_list($post['post_id'], '<span class="category-separate">|</span>');
			$posts[$i]['excerpt'] = get_excerpt($post['content'],600). ' [...]';
			
			$posts[$i]['edit_post_link'] = (is_logged_in(2)) ? get_edit_post_url($post['post_id']) : '';

			$posts[$i]['thumbnail_url'] = get_img_url($post['thumbnail_url']);
		
		//Get Comments Number
			$num = get_comments_num($post['post_id'], ' Comment', ' Comments');

			$i++;
		endwhile;
	endif;

//Get The $posts Back To AJAX
	die(json_encode($posts));