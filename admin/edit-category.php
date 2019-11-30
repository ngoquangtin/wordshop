<?php include('../incs/mysqli-connect.php'); ?>
<?php include('../incs/functions.php'); ?>
<?php check_user(2); ?>

<?php $id = get_id('category'); ?>

<?php

	if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
		
		$name = clean_input_data($_POST['name'], false);
		$parent = clean_input_data($_POST['parent'], false);
		
		$q = "
			Update terms set name='$name', parent=$parent
			where term_id=$id
			limit 1
		";

		$r = confirm_query( $dbc, $q );
		
		$has_message = mysqli_affected_rows($dbc) == 1 ? 'success' : "fail";
		
	}
	

?>

<?php
	$q = "
		SELECT name, slug, parent from terms
		where taxonomy='category' and term_id=$id limit 1
	";
	$r = confirm_query($dbc, $q);
	
	if( mysqli_num_rows($r) == 0 ) header("Location: ". get_admin_home_url() . '/manage_categories.php');

	$category = mysqli_fetch_array($r, MYSQLI_NUM);
	list($name,$slug,$parent) = $category;
	$title = $name. ' - Edit Category';

?>

<?php include('incs/header.php'); ?>
<div class="row">

	<div class="col-lg-12">
	
		<section class="panel">

			<header class="panel-heading"><?php echo $name; ?></header>
			<div class="panel-body">
			
			<?php if( isset($has_message) && $has_message == 'success' ) : ?>
				<div class="alert alert-success fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Well done!</strong> Updated category successfully.
				</div>
			<?php endif; ?>
			
			<?php if( isset($has_message) && $has_message == 'fail' ) : ?>
				<div class="alert alert-block alert-danger fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Oh snap!</strong> Could not update your changes due to a system error.
				</div>
			<?php endif; ?>

				<div class="form">
					<form class="form-validate form-horizontal" method="post">
						<div class="form-group ">
							<label for="name" class="control-label col-lg-2">Category Name <span class="required">*</span></label>
							<div class="col-lg-10">
								<input value="<?php echo $name; ?>" name="name" id="name" class="form-control input-lg m-bot15" type="text" required />
							</div>
						</div>

						<div class="form-group ">
							<label for="parent" class="control-label col-lg-2">Parent</label>
							<div class="col-lg-4">
							<?php $selected = 'selected="selected"'; ?>
								<select name="parent" class="form-control m-bot15">
									<option value="0" <?php if($parent==0) echo $selected; ?>>------------------------ No Parents ------------------------</option>

							<?php
								$q = "select term_id, name from terms where taxonomy='category' and parent=0";
								$r = confirm_query($dbc,$q);
								if(mysqli_affected_rows($dbc)>0):
									while($row = mysqli_fetch_array($r,MYSQLI_NUM)):
										list($id, $name) = $row;
							?>
									<option value="<?php echo $id; ?>" <?php if($parent==$id) echo $selected; ?>><?php echo $name; ?></option>
							<?php endwhile; endif; ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button class="btn btn-primary" type="submit">Update</button>
							</div>
						</div>
					</form>
				</div>

			</div>
		</section>
	</div><!--end .col-lg-12-->
</div><!--end .row-->

<?php 
//if( !isset($custom_jquery_scripts) ) $custom_jquery_scripts = ''; 
//$custom_jquery_scripts .= '<script src="js/custom-scripts/upload-post-thumbnail-image.js"></script>'; 
?>
<?php include('incs/footer.php'); ?>
