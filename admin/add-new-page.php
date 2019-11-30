<?php include('../incs/mysqli-connect.php'); ?>
<?php include('../incs/functions.php'); ?>
<?php check_user(2); ?>
<?php $title = 'Add New Page'; ?>
<?php include('incs/header.php'); ?>
<div class="row">
	
	<?php
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
			
			$slug = $_POST['slug'];
			$patern = '/^([a-z0-9\-]+)$/';
			if( !preg_match($patern, $slug ) ) $has_message = 'slug not valid';
			
			if( !isset($has_message) ){
			
				$page_title = $_POST['page_title'];
				$page_content = $_POST['page_content'];
				
				$q_slug = "select page_id from pages where slug='$slug'";
				$r_slug = confirm_query($dbc, $q_slug);
				
				if( mysqli_num_rows($r_slug) == 0 ){
					$q = "INSERT INTO pages(title, slug, content)";
					$q .= " VALUES ('$page_title', '$slug', '$page_content')";
					$r = confirm_query($dbc,$q);
					
					if( mysqli_affected_rows($dbc) == 1 ){
						//If insert successfully
						$has_message = 'success';
						$_POST = array();
					} else {
						//If insert failed
						$has_message = 'fail';
					}
				} else {
					$has_message = 'slug exist';
				}
			}//if( isset($has_message) )
		}//if( $_SERVER['REQUEST_METHOD'] == 'POST' )
	?>
	
	<?php
		if( isset( $_GET['has_message'] ) ) $has_message = $_GET['has_message'];
	?>
	<div class="col-lg-12">
		<section class="panel">
			
			<header class="panel-heading">Add New Page</header>
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
						<?php $submit = 'submit'; ?>
						<div class="form-group ">
							<label for="page_title" class="control-label col-lg-2">Page Title <span class="required">*</span></label>
							<div class="col-lg-6">
								<input name="page_title" <?php save_input($submit,'page_title'); ?> class="form-control input-lg m-bot15" type="text" required />
							</div>
						</div>
						
						<div class="form-group ">
							<label for="slug" class="control-label col-lg-2">Slug <span class="required">*</span></label>
							<div class="col-lg-6">
								<input name="slug" <?php save_input($submit,'slug'); ?> class="form-control" type="text" required />
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
							<label class="col-sm-2 control-label">Page Content <span class="required">*</span></label>
							<div class="col-sm-8">
								<textarea name="page_content" class="form-control" rows="20" required ><?php save_textarea($submit,'page_content'); ?></textarea>
								<span class="help-block">Allowed h2, p, a, img tags.</span>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button name="<?php echo $submit; ?>" class="btn btn-primary" type="submit">Publish</button>
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
