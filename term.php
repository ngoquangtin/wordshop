<?php 
include('incs/mysqli-connect.php');
include('incs/functions.php');

//Get Term ID
	$term_id = get_id('term');

#Those 2 Vars Is Use For Pagination Part, Because We Use It For All The Files
	$paginate_value = $term_id;
	$paginate_action = 'term';

//Get Term Name & Taxonomy
	$q = "SELECT name, taxonomy from terms where term_id=$term_id";
	$r_term = confirm_query($dbc,$q);
	list($term_name, $taxonomy) = mysqli_fetch_array($r_term,MYSQLI_NUM);

//Set $start, $limit, $current_page Vars
	$limit = 3;

	if(isset($_GET['start']) && is_numeric($_GET['start']) && $_GET['start']>=1){
		$start = (int)$_GET['start'];
		$start = $start - ($start%$limit);
	} else {
		$start = 0;
	}

	$current_page = ($start/$limit)+1;

//Get Posts
	$q = "
		SELECT p.post_id, p.title, p.slug, p.content, p.thumbnail_url 
		from posts as p inner join postmeta using(post_id) 
		where term_id=$term_id
		order by post_id DESC
		limit $start,$limit
	";
	$r = confirm_query($dbc,$q);
	if(mysqli_affected_rows($dbc)==0) $no_posts = true;

//Get The Total Posts To Set $total_post
	$q = "
		SELECT count(p.post_id)
		from posts as p inner join postmeta using(post_id) 
		where term_id=$term_id
	";
	$r_count = confirm_query($dbc,$q);
	list($total_post) = mysqli_fetch_array($r_count,MYSQLI_NUM);

//Some Vars To Echo In Header
	$title = "$term_name - $taxonomy";
	$css_scripts = '<link rel="stylesheet" type="text/css" href="css/archive-content-style.css" />';

//Call Header
include('incs/header.php ');

?>

	<div class="big_post_item radius_shadow">
		<h4><?php echo isset($no_posts) ? 'No Posts' : ucfirst($taxonomy).": $term_name ($total_post Posts)" ?> </h4>
	</div><!--end .big_post_item-->

<?php
include('incs/div-post-section-archive.php');

include('incs/pagination-archive-section.php'); 

include('incs/footer.php');
