<?php
include('../../incs/mysqli-connect.php');
include('../../incs/functions.php');

$limit = clean_input_data($_GET['limit'], false);
$target = clean_input_data($_GET['target'],false);
$id_field = clean_input_data($_GET['id_field'],false);
$table = clean_input_data($_GET['table'],false);


$start = ($target-1)*$limit;


//Create SQL query Based On id_field
$q = '';
switch($id_field){
	case 'page_id':
		$q .= "SELECT page_id, title, left(content, 600) as excerpt, date_format(post_time, '%d-%m-%Y') as date";
		break;
	case 'post_id':
		$q .= "SELECT post_id, title, content, thumbnail_url";
		break;
	case 'category_id':
		$q .= "SELECT category_id, category_name";
		break;
	case 'user_id':
		$q .= "SELECT user_id, account, display_name, email, level, date_format(registration_time, '%d-%m-%Y') as registration_time ";
		$where = " WHERE user_id!=". $_SESSION['user']['user_id'];
		break;
}

$q .= " FROM $table";
if(isset($where)) $q .= $where;
$q .= " ORDER BY $id_field DESC";
$q .= " LIMIT $start, $limit";


$r = confirm_query( $dbc, $q );

if( mysqli_num_rows( $r ) > 0 ) :
	$items = array();
	$i=0;
	while( $item = mysqli_fetch_array( $r, MYSQLI_ASSOC ) ) :
		$items[$i] = $item;
		
	//Handling Some Info Based On Id Field
		if($id_field=='post_id'){
			$items[$i]['content'] = get_excerpt( strip_tags( $item['content'] ), 100, ' [...]' );
			if( is_null($items[$i]['thumbnail_url']) ) $items[$i]['thumbnail_url'] = DEFAULT_POST_THUMBNAIL_URL;
		} else if($id_field=='page_id'){
			$items[$i]['excerpt'] = get_excerpt( strip_tags( $item['excerpt'] ), 100, ' [...]' );
		} else if($id_field=='category_id'){
			$q = "select count(post_id) as count from posts where category_id=". $item['category_id'];
			$r_count = confirm_query($dbc, $q);
			
			if( mysqli_num_rows($r_count) > 0 )
				$count = mysqli_fetch_array($r_count, MYSQLI_ASSOC);
			
			$items[$i]['total_post'] = (isset($count)) ? $count['count'] : 0;
		} else if($id_field=='user_id'){
			switch($item['level']){
				case 1: $level = 'Admin'; break;
				case 2: $level = 'Contributor'; break;
				case 3: $level = 'Member'; break;
			}
			$items[$i]['role'] = $level;
		}
		
		$i++;
	endwhile;
endif;	
		
		die(json_encode($items));