<?php
include('incs/mysqli-connect.php');
include('incs/functions.php');

#Redirect To 404 If Don't Have Slug
	if( !isset($_GET['slug']) ) header("Location: ". get_404_url());

#Get Page ID By Slug
	$slug = clean_input_data($_GET['slug'],false);
	$q = "SELECT page_id FROM pages WHERE slug='$slug'";
	$r_id = confirm_query($dbc, $q);
	list($page_id) = mysqli_fetch_array($r_id, MYSQLI_NUM);

#Get Page By ID
	$q = "SELECT title, content FROM pages WHERE page_id=$page_id";
	$r = confirm_query( $dbc, $q );
	if( mysqli_affected_rows($dbc) == 0 ) header("Location: ". get_404_url());
	$page = mysqli_fetch_array( $r, MYSQLI_ASSOC );

#Set Some Vars To Call In Header
	$title = $page['title'];
	$css_scripts = '<link rel="stylesheet" type="text/css" href="css/single-style.css" />';

#Call Header
	include('incs/header.php');
?>
	
	<div class="post_item radius_shadow">
		<div class="title">
			<h1><?php echo $page['title']; ?></h1>
			<p class="edit-post" style="display: <?php echo $display; ?>">
				<a href="<?php echo (is_logged_in(2)) ? get_admin_home_url()."/edit_page.php?page_id=$page_id" : "#"; ?>">Edit This Page</a>
			</p>
		</div><!--end .title-->
					
		<div class="post_content">
			<!--Not P Wrap, H2, p, a, img allowed-->
			<?php echo get_single_post_content( trim($page['content']) ); ?>
		</div><!--end .content-->

	</div><!--end .post_item-->

<?php include('incs/footer.php'); ?>