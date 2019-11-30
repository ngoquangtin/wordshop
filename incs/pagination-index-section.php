<div class="post_item separate radius_shadow" style="margin: 0 0;clear:both;box-shadow: 0 0 0;border: none;"></div>
<img class="loading-img" style="display: none; margin: 0 auto 15px;" src="<?php echo LOADING_IMG_URL; ?>" alt="loading img" />	

<?php
	if( isset($total_post) ){			
		$surplus = $total_post%$limit;
		if( $surplus > 0 ){
			$total_page = (($total_post-$surplus)/$limit) + 1;
		} else {
			$total_page = $total_post/$limit;
		}
	}
	
$ajax = false;

if($ajax):

	$next_text = 'Next';
	$prev_text = 'Prev';

	$ul_attr = array(
		'id' => 'paginate',
		'class' => array('radius_shadow')
	);

	$current_li_attr = array(
		'class' => 'current-page'
	);

	/*
	$id = array(
		'type' => 'user_id',
		'value' => $user_id
	);*/
	if(!isset($id)) $id=array();

	the_pagination( $limit, $current_page, $total_page, $next_text, $prev_text, $ul_attr, $current_li_attr, $id );
?>
	<form method="post">
		<input name="go-to-page" type="number" min="1" max="<?php echo $total_page; ?>" <?php if(isset($_POST['go-to-page'])) echo ' value="'.$current_page.'" '; ?> />
		<span style="font-size:18px;">/<?php echo $total_page; ?></span>
		<button type="submit">Go</button>
	</form>

<?php else : ?>

<input type="hidden" class="input-hidden-limit" value="<?php echo $limit; ?>" />
<input type="hidden" class="input-hidden-total-page" value="<?php echo $total_page; ?>" />
	
<?php
$jquery_scripts .= '<script type="text/javascript" src="js/pagination-ajax-functions.js"></script>';
$jquery_scripts .= '<script type="text/javascript" src="js/pagination-ajax-index.js"></script>';
endif;
