<?php 
include('../incs/mysqli-connect.php');
include('../incs/functions.php');
check_user(2);

#Get $post_id
	$post_id = get_id('post');

#Update Post When Update
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$title = clean_input_data($_POST['title'], false);
		$content = str_replace("'", "\'", $_POST['content']);
		$content = trim( strip_tags($content,"<h2><a><img>") );
		$q = "UPDATE posts SET title='$title', content='$content', updated_time=NOW()
			  WHERE post_id=$post_id
			  LIMIT 1";
		$r_update = confirm_query($dbc,$q);
		$has_message = mysqli_affected_rows($dbc) == 1 ? 'success' : 'error';
	}

#Get Post By $post_id
	$q = "
		SELECT title, slug, content, thumbnail_url
		FROM posts WHERE post_id=$post_id
	";
	$r = confirm_query($dbc, $q);

#Get $post
	if( mysqli_affected_rows($dbc) == 0 ) header("Location: ". get_admin_home_url() . '/manage_posts.php');
	$post = mysqli_fetch_array($r, MYSQLI_ASSOC);

#Call Some CSS Files
	$cfiles = array('add-edit-post.css');

#Call Header
	$title = $post['title']. " - Edit Post";
	include('incs/header.php');
?>

<div class="row">

	<div class="col-lg-12">
		<p class="p-view-post-link"><a href="<?php echo get_permalink($post['slug']); ?>">View Post</a></p>
		
		<section class="panel">
			<header class="panel-heading"><?php echo $post['title']; ?></header>
			<div class="panel-body">
			
		<?php include('incs/edit-post-messages.php'); $update = 'update-button'; ?>

				<div class="form">
					<form id="update-post" class="form-validate form-horizontal" method="post">

						<div class="form-group ">
							<div class="col-lg-offset-1 col-sm-10">
								<input name="title" class="form-control input-lg m-bot15" type="text" data-saved="<?php echo $post['title']; ?>" value="<?php echo $post['title']; ?>" required />
							</div>
						</div>

						<div class="form-group">
							<div class="col-lg-offset-1 col-sm-10">
								<textarea data-saved="<?php echo $post['content']; ?>" name="content" class="form-control" rows="20" required><?php echo $post['content'] ?></textarea>
								<span class="help-block">Allowed h2, a, img tags.</span>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-lg-offset-1 col-lg-10">
								<button name="<?php echo $update; ?>" class="btn btn-primary" type="submit">Update</button>
							</div>
						</div>
					</form>
				</div>

			</div>
		</section>
	</div><!--end .col-lg-12-->
</div><!--end .row-->

<div id="post-meta-widgets">
	<?php include('incs/edit-post-meta-widgets.php');?>
</div>

<?php
$jfiles[] = 'http://malsup.github.com/jquery.form.js';
$jfiles[] = 'edit-post.js';
$jfiles[] = 'set-featured-image-ajax.js';
include('incs/footer.php');