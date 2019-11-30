<?php
include('../incs/mysqli-connect.php');
include('../incs/functions.php');
check_user(2);

#Get $page_id
	$page_id = get_id('page');

#Process The Update Form
	if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
		
		$slug = $_POST['slug'];
		$patern = '/^([a-z0-9\-]+)$/';
		if( !preg_match($patern, $slug ) ) $has_message = 'slug not valid';
		
		if( !isset($has_message) ){

			$q = "SELECT page_id FROM pages WHERE slug='$slug' AND page_id!=$page_id";
			$r_slug = confirm_query($dbc, $q);

			if( mysqli_affected_rows($dbc) == 1 ) $has_message = 'slug exist';
			
			if( !isset($has_message) ){
				$title = clean_input_data($_POST['title'], false);
				$content = trim( strip_tags($_POST['content'],"<h2><a><img>") );

				$q = "
					UPDATE pages SET title='$title', slug='$slug', content='$content'
					WHERE page_id=$page_id
					LIMIT 1
				";
				$r_update = confirm_query( $dbc, $q );

				$has_message = mysqli_affected_rows($dbc) == 1 ? 'success' : 'error';
			}
		}
		
	}
	
#Get Page Info
	$q = "SELECT title, slug, content
		  FROM pages WHERE page_id=$page_id LIMIT 1";
	$r = confirm_query($dbc, $q);
	
	if( mysqli_affected_rows($dbc) == 0 ) header("Location: ". get_admin_home_url() . '/manage_pages.php');
	$page = mysqli_fetch_array($r, MYSQLI_ASSOC);

#Set Some Vars To Call In Header
	$title = $page['title']." - Edit Page";
	
#Call Header
	include('incs/header.php');
?>
<div class="row">

	<div class="col-lg-12">
	
		<section class="panel">
			<p id="view-post-link"><a href="<?php echo get_page_link($page['slug']); ?>">View Page</a></p>
			<header class="panel-heading"><?php echo $page['title']; ?></header>
			<div class="panel-body">
			
			<?php if( isset($has_message) && $has_message == 'success' ) : ?>
				<div class="alert alert-success fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Well done!</strong> You successfully publish this page.
				</div>
			<?php endif; ?>
			
			<?php if( isset($has_message) && $has_message == 'fail' ) : ?>
				<div class="alert alert-block alert-danger fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Oh snap!</strong> Could not publish your page due to a system error.
				</div>
			<?php endif; ?>
			
			<?php if( isset($has_message) && ($has_message == 'slug exist' || $has_message=='slug not valid') ) : ?>
				<div class="alert alert-block alert-danger fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Error!</strong> Something is not correct.
				</div>
			<?php endif; ?>

				<div class="form">
					<form class="form-validate form-horizontal" method="post">
					<?php $submit = 'update-button'; ?>
						<div class="form-group ">
							<label for="title" class="control-label col-lg-2">Page Title <span class="required">*</span></label>
							<div class="col-lg-6">
								<input name="title" class="form-control input-lg m-bot15" value="<?php echo $page['title']; ?>" type="text" required />
							</div>
						</div>

						<div class="form-group ">
							<label for="slug" class="control-label col-lg-2">Slug <span class="required">*</span></label>
							<div class="col-lg-6">
								<input required name="slug" class="form-control" type="text" value="<?php echo $page['slug']; ?>" />
								<?php 
									if(isset($has_message)) : 
										if( $has_message=='slug exist' ) $span = 'This slug is already used. Please use another one.';
											else if($has_message=='slug not valid') $span = 'This slug is not valid.';
										
										if(isset($span)) echo '<span class="help-block">'.$span.'</span>'; 
									endif; 
								?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Page Content</label>
							<div class="col-sm-8">
								<textarea name="content" class="form-control" rows="20" required><?php echo $page['content'] ?></textarea>
								<span class="help-block">Allowed h2, p, a, img tags.</span>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button name="<?php echo $submit; ?>" class="btn btn-primary" type="submit">Update</button>
								<button class="btn btn-default" type="button">Cancel</button>
							</div>
						</div>
					</form>
				</div>

			</div>
		</section>
	</div><!--end .col-lg-12-->
</div><!--end .row-->

<?php include('incs/footer.php'); ?>
