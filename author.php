<?php 
include('incs/mysqli-connect.php');
include('incs/functions.php');

//Get User ID
	$user_id = get_id('user');

#Those 2 Vars Is Use For Pagination Part, Because We Use It For All The Files
	$paginate_value = $user_id;
	$paginate_action = 'user';

//Get User Name
	$q = "SELECT display_name from users where user_id=$user_id";
	$r_name = confirm_query($dbc,$q);
	list($display_name) = mysqli_fetch_array($r_name,MYSQLI_NUM);

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
		from posts as p
		where user_id=$user_id
		order by post_id DESC
		limit $start,$limit
	";
	$r = confirm_query($dbc,$q);
	if(mysqli_affected_rows($dbc)==0) $no_posts = true;

//Get The Total Posts To Set $total_post
	$q = "
		SELECT count(p.post_id)
		from posts as p 
		where user_id=$user_id
	";
	$r_count = confirm_query($dbc,$q);
	list($total_post) = mysqli_fetch_array($r_count,MYSQLI_NUM);

//Some Vars To Echo In Header
	$title = "$display_name - Author";
	$css_scripts = '<link rel="stylesheet" type="text/css" href="css/archive-content-style.css" />';

//Call Header
	include('incs/header.php'); 
?>


	<div class="big_post_item radius_shadow">
		<h4>Author: <?php echo "$display_name ($total_post Posts)"; ?></h4>
	</div><!--end .big_post_item-->

<?php
include('incs/div-post-section-archive.php');

include('incs/pagination-archive-section.php'); 

include('incs/footer.php');