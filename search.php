<?php
include('incs/mysqli-connect.php');
include('incs/functions.php');

#Get Search Query
	if( isset($_GET['query']) ){
		$search = clean_input_data($_GET['query'],false);
	} else {
		header("Location: ". get_home_url());
	}

#Those 2 Vars Is Use For Pagination Part, Because We Use It For All The Files
	$paginate_value = $search;
	$paginate_action = 'search';

#Set $limit, $start, $current_page
	$limit = get_options('posts_per_page_archive');

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

#Get Posts
	$q = "
		SELECT p.post_id, p.title, p.slug, p.content, p.thumbnail_url 
		from posts as p 
		where content LIKE '%$search%'
		order by post_id DESC
		limit $start,$limit
	";
	$r = confirm_query($dbc, $q);

#If Has Posts, set $has_posts = true To Use It In The Content Box
	$has_posts = ( mysqli_affected_rows($dbc) > 0 ) ? true : false;
	
#Set Some Vars To Call In Header
	$title = "$search - Search results";
	$css_scripts = '<link rel="stylesheet" type="text/css" href="css/archive-content-style.css" />';

#Call Header
	include('incs/header.php');
?>

	<div class="big_post_item radius_shadow">
		<h4>
		<?php
		if($has_posts){
			$q = "
				SELECT COUNT(post_id) AS count FROM posts
				where content LIKE '%$search%'
			";

			$r_count = confirm_query( $dbc, $q );
			if( mysqli_affected_rows( $dbc ) > 0 ){
				list($total_post) = mysqli_fetch_array( $r_count, MYSQLI_NUM );
			}
			$output = "Search results for: $search ($total_post Posts)";
		} else {
			$output = "No results for: $search";
		}
		echo $output;
		?>
		</h4>
	</div><!--end .big_post_item-->

<?php 
if( $has_posts ) {
	include('incs/div-post-section-archive.php');
	include('incs/pagination-archive-section.php');
}

include('incs/footer.php');