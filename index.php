<?php 
include('incs/mysqli-connect.php');
include('incs/functions.php');
$title = 'Wordshop';
include('incs/header.php'); 

	#$limit = get_options('posts_per_page_index');
	$limit = 5;

	if(isset($_POST['go-to-page'])){
		$current_page = clean_input_data((int)$_POST['go-to-page'],false);
		$start = ($current_page-1)*$limit;
	} else if( isset($_GET['start']) && is_numeric($_GET['start']) && $_GET['start']>=0 ){
		$start = $_GET['start'];
		$start = $start - ($start%$limit);
		$current_page = ( $start/$limit ) + 1;
	}
	
	if(!isset($start) || !isset($current_page)){
		$start=0;$current_page=1;
	}

	$q = "
		SELECT  p.post_id, p.title, p.slug AS post_slug, p.content, p.thumbnail_url, date_format(p.posted_time, '%d-%m-%Y') as day,
				u.user_id, u.display_name
		FROM posts AS p INNER JOIN users AS u USING(user_id)
		ORDER BY post_id DESC
		LIMIT $start,$limit
	";
	
	$r = confirm_query($dbc, $q);
	
	if( mysqli_num_rows( $r ) == 0 ) header("Location: ".get_404_url());

	while( $post = mysqli_fetch_array( $r, MYSQLI_NUM ) ) :
		list($post_id, $title, $post_slug, $content, $thumbnail_url, $day, $user_id, $display_name) = $post;

?>

	<div class="post_item radius_shadow">
		<div class="title">
			<h1><a href="<?php echo get_permalink($post_slug); ?>"><?php echo $title; ?></a></h1>
			<ul class="metadata">
				<li class="publish">Publish by : <a href="<?php echo get_author_link($user_id); ?>" class="bold"><?php echo $display_name; ?></a></li>
				<li class="cat">Category: <?php echo get_post_categories_list($post_id, '<span class="category-separate">|</span>'); ?></li>
				<li class="comments"><a href="<?php echo get_permalink($post_slug); ?>#comment-form" class="bold"><?php echo get_comments_num($post_id, ' Comment', ' Comments'); ?></a></li>
				<li class="post_time"><?php echo $day; ?></li>
			</ul>
		</div><!--end .title-->
		
		<div class="content">
			<a href="<?php echo get_permalink($post_slug); ?>" class="thumbnail"><img src="<?php echo get_img_url($thumbnail_url); ?>" alt="<?php echo $title; ?>" /></a>
			
			<p class="main_content">
				<!--Only Text In Index-->
				<?php echo get_excerpt( $content, 600, ' [...]' );?>
			</p>
			
			<?php $display = (is_logged_in(2))?'block':'none'; ?>
			<p class="edit-post" style="display: <?php echo $display; ?>">
				<a href="<?php echo (is_logged_in(2)) ? get_edit_post_url($post_id) : '#'; ?>">Edit This Post</a>
			</p>
		</div><!--end .content-->
	</div><!--end .post_item-->
<?php 
endwhile;

$q = "SELECT COUNT(post_id) AS count FROM posts";
$r_count = confirm_query( $dbc, $q );
if( mysqli_affected_rows( $dbc ) > 0 ){
	list($total_post) = mysqli_fetch_array( $r_count, MYSQLI_NUM );
}

include( 'incs/pagination-index-section.php' );
include('incs/footer.php');
?>