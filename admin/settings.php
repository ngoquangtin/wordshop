<?php include('../incs/mysqli-connect.php'); ?>
<?php include('../incs/functions.php'); ?>
<?php check_user(1); ?>

<?php $title = 'Settings'; ?>
<?php include('incs/header.php'); ?>
<?php

	if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
		$fields = array('posts_per_page_index');
		$errors = trigger_form_missing_error( $fields );
		
		$data = clean_input_data($fields, true);
		//if( in_array('site_title', $errors) ) $data['site_title'] = 'Wordshop - One step at a time';
		if( in_array('posts_per_page_index', $errors) || !is_numeric($data['posts_per_page_index']) || $data['posts_per_page_index']<1 ) $data['posts_per_page_index'] = 3;
		// if( in_array('posts_per_page_archive', $errors) || !is_numeric($data['posts_per_page_archive']) || $data['posts_per_page_archive']<1 ) $data['posts_per_page_archive'] = 5;
		
		$update_error = false;
		foreach( $fields as $f ){
			// $u = $update
			$u = "update settings set set_value=". $data[$f] ." WHERE set_name='$f' LIMIT 1";
			$r = confirm_query($dbc, $u);
			if( mysqli_affected_rows($dbc) == 0 ) $update_error = true;
		}
		
	}

	$q = "SELECT set_name, set_value FROM settings";
	$r = confirm_query($dbc, $q);
	
	if( mysqli_num_rows($r) == 0 ) header("Location: ". get_admin_home_url() );
	
	$sets = array();
	while( $row = mysqli_fetch_array($r, MYSQLI_ASSOC) )
		$sets[$row['set_name']] = $row['set_value'];
?>

<div class="row">
	<div class="col-lg-12">

		<section class="panel">
			<div class="panel-body">
				
				<?php if( isset($update_error) && $update_error == false ) : ?>
				<div class="alert alert-success fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Well done!</strong> Settings saved.
				</div>
				<?php endif; ?>
				
				<?php if( isset($update_error) && $update_error == true ) : ?>
				<div class="alert alert-block alert-danger fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Oh!</strong> Could not save your settings due to a system error. Please <a href="contact.php">CONTACT US</a> about this problem.
				</div>
				<?php endif; ?>
			
				<form class="form-horizontal" method="post">
					<div class="form-group">
						<label class="col-lg-2 control-label" for="site_title">Site Title</label>
						<div class="col-lg-6">
							<input value="<?php echo $sets['site_title']; ?>" name="site_title" type="text" class="form-control" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-2 control-label" for="posts_per_page_index">Posts Per Page (for Home Page)</label>
						<div class="col-lg-6">
							<input value="<?php echo $sets['posts_per_page_index']; ?>" name="posts_per_page_index" type="text" class="form-control" />
							<span class="help-block">Default: 3 posts</span>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-2 control-label" for="posts_per_page_archive">Posts Per Page (for Archive Page)</label>
						<div class="col-lg-6">
							<input value="<?php echo $sets['posts_per_page_archive']; ?>" name="posts_per_page_archive" type="text" class="form-control" />
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button type="submit" class="btn btn-primary">Save Changes</button>
						</div>
					</div>
				</form>
			</div>
		</section>
	
	
	
	</div><!--end .col-lg-12-->
</div><!--end .row-->

<?php 
if( !isset($custom_jquery_scripts) ) $custom_jquery_scripts = ''; 
//$custom_jquery_scripts .= '<script src="js/custom-scripts/scripts.js"></script>'; 
?>

<?php include('incs/footer.php'); ?>