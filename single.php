<?php
include('incs/mysqli-connect.php');
include('incs/functions.php');

#Get Post Data
	$post_id = get_post_id_by_slug();
	$post = get_post_data();

//Set Some Vars To Echo In Header
	$title = $post['title'];
	$css_scripts = '<link rel="stylesheet" type="text/css" href="css/single-style.css" />';

//Call Header
	include('incs/header.php');
?>
		
	<div class="post_item radius_shadow">
		<div class="title">
			<h1><?php echo $post['title']; ?></h1>
			<ul class="metadata">
				<li class="publish">Publish by : <?php the_author(); ?></li>
				<li class="cat">In category : <?php the_categories(); ?></li>
				<li class="comments"><?php the_comments(); ?></li>
				<li class="posted_time"><?php posted_time(); ?></li>
			</ul>

			<?php edit_post_link(); ?>
		</div>
					
		<div class="metadata_single">
			<img src="<?php echo get_img_url($post['thumbnail_url']); ?>" alt="<?php echo $post['title']; ?>" />
			
			<ul class="tutorial_details">
				<li class="details"><h4>Tutorial details</h4></li>
				<li><strong>Độ khó:</strong> Trung bình</li>
				<li><strong>Thời gian:</strong> Cả ngày</li>
				<li><strong>File size:</strong> Nhỏ hơn 1MB</li>
				<li><strong>Yêu cầu:</strong> HTML và CSS</li>
			</ul>
		</div>
		
		<?php $jquery_scripts .= '<script type="text/javascript" src="js/single-scripts.js"></script>'; ?>
		<div class="related_post">
			<h3><span class="float_left">Có 2 bài viết trong series <strong>PSD2HTML by Tommy</strong></span><a href="#" class="float_right">Hide</a></h3>
			
			<ul>
				<li><a href="#">PSD2HTML - BUSSINESS LAYOUT</a></li>
				<li><a href="#" id="viewing">PSD2HTML - NATURE LAYOUT</a><span>- Bài viết đang xem</span></li>
			</ul>
		</div>
					
		<div class="post_content">
			<?php the_content(); #Not P Wrap, H2, p, a, img allowed ?>
		</div>
					
		<div class="poster">
			<a href="<?php echo get_author_link($post['user_id']); ?>"><img src="<?php echo get_img_url($post['avatar_url'], 'avatar'); ?>" class="poster_avatar" alt="<?php echo $post['display_name']; ?>" /></a>
			<h3 class="poster_name"><a href="<?php echo get_author_link($post['user_id']); ?>"><?php echo $post['display_name']; ?></a></h3>
			<p class="poster_info"><?php echo $post['bio']; ?></p>
		</div>
	</div><!--end .post_item-->

<?php
$jquery_scripts .= '<script type="text/javascript" src="js/post-comment-ajax.js"></script>'; 
include( 'incs/comment.php' );
include('incs/footer.php');

function get_post_id_by_slug(){
	global $dbc;
	if( !isset($_GET['slug']) ) header("Location: ". get_404_url());

	global $post_slug;
	$post_slug = clean_input_data($_GET['slug'],false);
	$q = "SELECT post_id from posts where slug='$post_slug'";
	$r = confirm_query($dbc, $q);

	if( mysqli_affected_rows($dbc) != 1 ) header("Location: ". get_404_url());
	list($post_id) = mysqli_fetch_array($r, MYSQLI_NUM);
	return $post_id;
}

function get_post_data(){
	global $dbc;
	global $post_id;
	
	$q = "SELECT p.user_id, p.title, p.content, p.thumbnail_url, DATE_FORMAT(p.posted_time, '%d-%m-%Y') AS day, DATE_FORMAT(p.posted_time, '%I:%i %p') AS hour, DATE_FORMAT(p.updated_time, '%d-%m-%Y') AS updated_day, DATE_FORMAT(p.updated_time, '%I:%i %p') AS updated_hour,
			   u.display_name, u.bio, u.avatar_url,
			   count(coms.comment_id ) AS count
		  FROM 		  posts	   AS p 
		  INNER JOIN  users    AS u    USING(user_id)
		  INNER JOIN  comments AS coms USING(post_id)
		  WHERE post_id=$post_id";
	
	$r = confirm_query( $dbc, $q );
	if( mysqli_affected_rows( $dbc ) == 0 ) header('Location: 404.php');
	$post = mysqli_fetch_array( $r, MYSQLI_ASSOC );
	return $post;
}

function the_content(){
	global $post;
	$content = explode("[more]", $post['content']);
	
	$output = '';
	if(count($content)>1){
		$none = 'style="display:none;"';
		for ($i=1; $i <= count($content) ; $i++) {
			if($i>1){
				$output .= '<div '.$none.' id="content-page-'.$i.'" class="content-page">';
			} else {
				$output .= '<div id="content-page-'.$i.'" class="content-page">';
			}

			$output .= get_single_post_content(trim($content[$i-1]));
			$output .= '</div>';
		}
	} else {
		$output .= get_single_post_content($post['content']);
	}

	if(count($content)>1){
		$output .= '<ul id="content-pagination">';
		for ($i=1; $i <= count($content) ; $i++){
			$output .= ($i==1) ? '<li style="display:none;">' : '<li>';
			$output .= '<a href="#" data-page="'.$i.'">'.$i.'</a></li>';
			
			$output .= ($i!=1) ? '<li style="display:none;" ' : '<li';
			$output .= ' class="current-content-page">'.$i.'</li>';
		}
		$output .= '</ul>';
	}

	echo $output;
}

function edit_post_link(){
	global $post_id;
	$display = (is_logged_in(2)) ? 'block' : 'none';
	$output = '';
	$output .= '<p class="edit-post" style="display: '.$display.'">';
		$url = (is_logged_in(2)) ? get_edit_post_url($post_id) : '#';
		$output .= '<a href="'.$url.'">Edit This Post</a>';
	$output .= '</p>';
	echo $output;
}

function posted_time(){
	global $post;
	echo 'Posted On '.$post['day']." (".$post['hour'].")"; if(!is_null($post['updated_day'])) echo ', Updated On '.$post['updated_day'].' ('.$post['updated_hour'].')';
}

function the_author(){
	global $post;
	echo '<a href="'.get_author_link($post['user_id']).'" class="bold">'.$post['display_name'].'</a>';
}

function the_categories(){
	global $post_id;
	echo get_post_categories_list($post_id, '<span class="category-separate">|</span>');
}

function the_comments(){
	global $post_id; global $post_slug;
	echo '<a href="'.get_permalink($post_slug).'#comment-form" class="bold">'.get_comments_num($post_id, ' Comment', ' Comments').'</a>';
}