<?php include('../incs/mysqli-connect.php'); ?>
<?php include('../incs/functions.php'); ?>
<?php check_user(2); ?>

<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	if($_POST['category_id']==0) $has_message = 'missing category';
	$slug = str_replace(' ', '-', strtolower( mysqli_real_escape_string($dbc,$_POST['title']) ) );

	if(!isset($has_message)){
		$success = array();

		$q = "select post_id from posts where slug='$slug'";
		$r = confirm_query($dbc,$q);
		
		if(mysqli_affected_rows($dbc)==1) $slug .= '-2';

		$sql_fields = array(
			'user_id',
			'title',
			'slug',
			'content',
			'thumbnail_url',
			'post_time',
			'post_type'
		);

		$user_id = $_SESSION['user']['user_id'];
		$data = clean_input_data( array('post-thumbnail-url', 'title', 'content'), true);
		$title = $data['title'];
		$content = $data['content'];
		$thumbnail_url = !empty($_POST['post-thumbnail-url']) ? "'".$data['post-thumbnail-url']."'" : 'null';

		$q = "
			INSERT INTO posts(".create_fields_list_sql($sql_fields).")
			VALUES ($user_id, '$title', '$slug', '$content', $thumbnail_url, NOW(), 'post')
		";
		
		$r = confirm_query($dbc,$q);
		$success[] = mysqli_affected_rows($dbc)==1 ? 'success' : 'error';

		$q = "SELECT post_id from posts order by post_id desc limit 0,1";
		$r = confirm_query($dbc,$q);
		list($post_id) = mysqli_fetch_array($r,MYSQLI_NUM);

		$q = "
			INSERT INTO postmeta(post_id, term_id)
			VALUES ($post_id, $term_id)
		";

		$r = confirm_query($dbc,$q);
		
		$success[] = mysqli_affected_rows($dbc)==1 ? 'success' : 'error';

	}
}

?>

<?php $title = 'Add New Post'; ?>
<?php $custom_css = '<link href="css/custom-css/set-featured-image-box-style.css" rel="stylesheet" />'; ?>
<?php $custom_css .= '<link href="css/custom-css/featured-image-widget-style.css" rel="stylesheet" />'; ?>
<?php $custom_css .= "<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Noto+Serif%3A400%2C400i%2C700%2C700i&#038;ver=5.1.1' type='text/css' media='all' />"; ?>
<?php include('incs/header.php'); ?>
<?php if( isset( $_GET['has_message'] ) ) $has_message = $_GET['has_message']; ?>

<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			
			<header class="panel-heading">Add New Post</header>
			<div class="panel-body">
				
			<?php if( isset($success) && !in_array('error', $success) ) : ?>
				<div class="alert alert-success fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Well done!</strong> You successfully publish this post.
				</div>
			<?php endif; ?>
			
			<?php if( isset($_GET['delete']) && $_GET['delete'] == 'true' ) : ?>
				<div class="alert alert-success fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Well done!</strong> You successfully delete your post.
				</div>
			<?php endif; ?>
			
			<?php if( isset($success) && in_array('error', $success) ) : ?>
				<div class="alert alert-block alert-danger fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Oh snap!</strong> Could not publish your post due to a system error.
				</div>
			<?php endif; ?>
			
			<?php if( isset($has_message) && $has_message == 'missing category' ) : ?>
				<div class="alert alert-block alert-danger fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Error!</strong> Something is not correct.
				</div>
			<?php endif; ?>
				
				<div class="form">
					<form id="form-add-new" class="form-validate form-horizontal" method="post">
						<?php $submit = 'add-new-button'; ?>
						
						<input name="post-thumbnail-url" type="hidden" class="form-control" />
						
						<div class="form-group">
							<label for="title" class="control-label col-lg-2">Title <span class="required">*</span></label>
							<div class="col-lg-6">
								<input name="title" <?php if(isset($_SESSION['user']['add-new-post']) && !empty($_SESSION['user']['add-new-post'])) echo 'value="'.$_SESSION['user']['add-new-post']['title'].'"'; ?> class="form-control input-lg m-bot15" type="text" required />
							</div>
						</div>
						
						<?php
							$q = "
								SELECT term_id, name from terms
								where taxonomy='category' and parent=0
							";
							$r = confirm_query( $dbc, $q );
							
							if( mysqli_num_rows( $r ) > 0 ) :
						?>
						<div class="form-group">
							<label class="control-label col-lg-2" for="category_id">Category <span class="required">*</span></label>
							<div class="col-lg-4">
								<select name="category_id" class="form-control m-bot15">
									<option value="0" selected="selected">---------------- Select Category ----------------</option>
								<?php while( $row = mysqli_fetch_array( $r, MYSQLI_NUM ) ) : list($id,$name) = $row; ?>
									<option value="<?php echo $id; ?>"><?php echo $name; ?></option>
						<?php
							$q = "
								SELECT term_id, name from terms
								where taxonomy='category' and parent=$id
							";
							$r1 = confirm_query( $dbc, $q );
							
							if( mysqli_affected_rows( $dbc ) > 0 ) : $output = '';
								while( $row1 = mysqli_fetch_array($r1, MYSQLI_NUM) ){
									list($id1,$name1) = $row1;
									$output .= '<option value="'.$id1.'">------ '.$name1.'</option>';
								}
								echo $output;
							endif;
						?>
								<?php endwhile; ?>
								</select>
								<?php if( isset($has_message) && $has_message == 'missing category' ) : ?>
								<span class="help-block">Please choose one category.</span>
								<?php endif; ?>
							</div>
						</div>

						<?php endif; ?>

						<div class="form-group">
							<label class="col-sm-2 control-label">Content <span class="required">*</span></label>
							<div class="col-sm-8">
								<textarea name="content" class="form-control" rows="20" required ><?php if(isset($_SESSION['user']['add-new-post']) && !empty($_SESSION['user']['add-new-post'])) echo $_SESSION['user']['add-new-post']['title']; ?></textarea>
								<span class="help-block">Allowed h2, a, img tags.</span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button name="<?php echo $submit; ?>" class="btn btn-primary" type="submit">Publish</button>
								<button class="btn btn-default more-button" type="button">More</button>
							</div>
						</div>
					</form>
				</div>

			</div><!--end .panel-body-->
		</section>
	</div><!--end .col-lg-12-->
</div><!--end .row-->

<div class="row">
	<div class="col-lg-4">
		<section class="panel">
			<header class="panel-heading">Featured Image</header>
			
			<div class="panel-body div-img">
				<a class="a-open-box" href="#">Set Featured Image</a>
				<?php $action = (FILE_NAME=='add_new_post.php') ? 'add-new-post' : 'edit-post'; ?>
				<button data-action="<?php echo $action; ?>" class="remove-featured-img-button" style="display: none;">Remove Featured Image</button>
			</div>
		</section>
	</div><!--end .col-lg-12-->
</div><!--end .row-->

<?php include('incs/set-featured-image-box.php'); ?>

<?php
$custom_jquery_scripts .= '<script src="js/custom-scripts/set-featured-image-ajax.js"></script>'; 
$custom_jquery_scripts .= '<script src="http://malsup.github.com/jquery.form.js"></script> '; 
?>
<?php include('incs/footer.php'); ?>
