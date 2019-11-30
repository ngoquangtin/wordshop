<?php include('../incs/mysqli-connect.php'); ?>
<?php include('../incs/functions.php'); ?>
<?php check_user(1); ?>

<?php $title = 'Add New Category'; ?>
<?php include('incs/header.php'); ?>
<div class="row">
	
	<?php
		
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

			$name = clean_input_data($_POST['name'], false);
			$parent = clean_input_data($_POST['term_id'], false);
			$slug = str_replace(' ', '-', strtolower( trim($name) ) );
			
			$q = "INSERT INTO terms (name, taxonomy, slug, parent)";
			$q .= " VALUES ('$name', 'category', '$slug', $parent)";
			$r = confirm_query( $dbc, $q );

			$has_message = mysqli_affected_rows( $dbc ) == 1 ? 'success' : 'fail';
		}
		
	?>
	
	<?php if( isset( $has_message ) ) : ?>
	<div class="col-lg-12">
		<section class="panel">
			<div class="panel-body">
				<?php if( $has_message == 'success' ) : ?>
				<div class="alert alert-success fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Well done!</strong> You successfully added this category.
				</div>
				<?php endif; ?>
				
				<?php if( $has_message == 'fail' ) : ?>
				<div class="alert alert-block alert-danger fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Oh snap!</strong> Could not add this category due to a system error.
				</div>
				<?php endif; ?>

			</div>
		</section>
	</div><!--end .col-lg-12-->
	<?php endif; ?>
	
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">Add New Category</header>
			<div class="panel-body">
				<div class="form">
					<form class="form-validate form-horizontal" method="post">
						<div class="form-group ">
							<label for="name" class="control-label col-lg-2">Category Name <span class="required">*</span></label>
							<div class="col-lg-8">
								<input name="name" type="text" id="name" class="form-control input-lg m-bot15" required />
							</div>
						</div>

						<div class="form-group ">
							<label for="parent" class="control-label col-lg-2">Parent</label>
							<div class="col-lg-4">
								<select name="term_id" class="form-control m-bot15">
									<option value="0" selected="selected">------------------------ No Parents ------------------------</option>

							<?php
								$q = "select term_id, name from terms where taxonomy='category' and parent=0";
								$r = confirm_query($dbc,$q);
								if(mysqli_affected_rows($dbc)>0):
									while($row = mysqli_fetch_array($r,MYSQLI_NUM)):
										list($id, $name) = $row;
							?>
									<option value="<?php echo $id; ?>"><?php echo $name; ?></option>
							<?php endwhile; endif; ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button class="btn btn-primary" type="submit">Add New</button>
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
