<?php include('../incs/mysqli-connect.php'); ?>
<?php include('../incs/functions.php'); ?>
<?php check_user(1); ?>



	<?php
		if( isset( $_GET['user_id'] ) && is_numeric($_GET['user_id']) && $_GET['user_id']>=1 ){
			$user_id = $_GET['user_id'];
		} else {
			header('Location: manage_users.php');
		}
		
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
			
			$fields = array( 'display_name', 'email' );
			$errors = array();
			foreach( $fields as $f ){
				if( empty( $_POST[$f] ) ) $errors[] = $f; 
			}
			
			if( empty( $errors ) ){
			
				$display_name = $_POST['display_name'];
				$email = $_POST['email'];
				
				$q = "UPDATE users SET display_name='$display_name', email='$email'";
				$q .= " WHERE user_id=$user_id";
				$r = confirm_query($dbc, $q);
				
				if( mysqli_affected_rows( $dbc ) == 1 ){
					$has_message = 'success';
				} else {
					$has_message = 'fail';
				}
				
			} else {
				$has_message = 'missing';
			}//if( empty( $errors ) )
		}
	
		$q = "SELECT display_name, email FROM users WHERE user_id=$user_id";
		$r = confirm_query($dbc, $q);
		
		if( mysqli_num_rows( $r ) == 1 ) $user = mysqli_fetch_array( $r, MYSQLI_ASSOC );
		
	?>

<?php $title = $user['display_name']. ' - User Info'; ?>
<?php include('incs/header.php'); ?>

<div class="row">
	
	<?php if( isset( $has_message ) ) : ?>
	<div class="col-lg-12">
		<section class="panel">
			<div class="panel-body">
			
				<?php if( $has_message == 'success' ) : ?>
				<div class="alert alert-success fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Well done!</strong> You successfully change the information of this user.
				</div>
				<?php endif; ?>
				
				<?php if( $has_message == 'missing' ) : ?>
				<div class="alert alert-block alert-danger fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Error!</strong> Please fill in all the fields.
				</div>
				<?php endif; ?>
				
				<?php if( $has_message == 'fail' ) : ?>
				<div class="alert alert-block alert-danger fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Oh snap!</strong> Could not change the data due to a system error.
				</div>
				<?php endif; ?>

			</div>
		</section>
	</div>
	<?php endif; ?>
	
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">Form validations</header>
			<div class="panel-body">
				<div class="form">
					<form method="post" class="form-validate form-horizontal" id="feedback_form">
						<div class="form-group ">
							<label for="cname" class="control-label col-lg-2">Full Name <span class="required">*</span></label>
							<div class="col-lg-10">
								<input name="display_name" value="<?php echo $user['display_name']; ?>" class="form-control" id="cname" minlength="5" type="text" />
							</div>
						</div>
						
						<div class="form-group ">
							<label for="cemail" class="control-label col-lg-2">E-Mail <span class="required">*</span></label>
							<div class="col-lg-10">
								<input name="email" value="<?php echo $user['email']; ?>" class="form-control " id="cemail" type="email" />
							</div>
						</div>

						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button class="btn btn-primary" type="submit">Save</button>
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
