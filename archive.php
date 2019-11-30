<?php
include('incs/mysqli-connect.php');
include('incs/functions.php');

//Get Archive Time
	if(!isset($_GET['archive'])) header("Location: ". get_404_url());
	$archive = clean_input_data($_GET['archive'],false);

#Those 2 Vars Is Use For Pagination Part, Because We Use It For All The Files
	$paginate_value = $archive;
	$paginate_action = 'archive';

#Set $start, $limit, $current_page Vars
	$limit = 3;

	if(isset($_GET['start']) && is_numeric($_GET['start']) && $_GET['start']>=1){
		$start = (int)$_GET['start'];
		$start = $start - ($start%$limit);
	} else {
		$start = 0;
	}

	$current_page = ($start/$limit)+1;

#Get Posts
	$q = "
		SELECT p.post_id, p.title, p.slug, p.content, p.thumbnail_url 
		from posts as p
		WHERE date_format(p.posted_time, '%b %Y')='$archive'
		order by post_id DESC
		limit $start,$limit
	";
	$r = confirm_query($dbc,$q);
	if(mysqli_affected_rows($dbc)==0) header("Location: ". get_404_url());

#Get $total_post
	$q = "SELECT COUNT(post_id) FROM posts WHERE date_format(posted_time, '%b %Y')='$archive'";
	$r_count = confirm_query($dbc,$q);
	list($total_post) = mysqli_fetch_array($r_count,MYSQLI_NUM);

//Some Vars To Echo In Header
	$title = "$archive - Archive";
	$css_scripts = '<link rel="stylesheet" type="text/css" href="css/archive-content-style.css" />';

//Call Header
include('incs/header.php ');

?>

	<div class="big_post_item radius_shadow">
		<h4>Archive: <?php echo "$archive ($total_post Posts)"; ?></h4>
	</div><!--end .big_post_item-->

<?php
include('incs/div-post-section-archive.php');

include('incs/pagination-archive-section.php'); 

include('incs/footer.php');
