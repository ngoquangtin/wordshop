<?php include('../incs/mysqli-connect.php'); ?>
<?php include('../incs/functions.php'); ?>
<?php check_user(1); ?>

<?php $title = "Add New Widget"; ?>
<?php include('incs/header.php'); ?>
<div class="row">
	<div class="col-md-6 portlets">
		<section class="panel">
			asd
		</section>
	</div><!--end .col-xs-6-->
	
<div class="col-md-6 portlets">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="pull-left">Quick Post</div>
			<div class="widget-icons pull-right">
				<a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
				<a href="#" class="wclose"><i class="fa fa-times"></i></a>
			</div>
			<div class="clearfix"></div>
		</div>
		
		<div class="panel-body">
			<div class="padd">

				<div class="form quick-post">
					<!-- Edit profile form (not working)-->
					<form class="form-horizontal">
						<!-- Title -->
						<div class="form-group">
							<label class="control-label col-lg-2" for="title">Title</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" id="title" />
							</div>
						</div>
						
						<div id="category" class="form-group">
							<label class="control-label col-lg-2" for="category">Category</label>
							<div class="col-lg-10">
								<input name="category" id="category" type="text" class="form-control" />
							</div>
						</div>
						
						<!--List Group Added by jQuery
						<div class="form-group"><!-- id="list-1" class="div-list-group" 
							<label class="control-label col-lg-2" for="list1">list1</label>
							<div class="col-lg-10">
								<input name="list-1" id="list-1" type="text" class="form-control" />
							</div>
						</div>
						-->
						
						
					  <!-- Content -->
					  <div class="form-group">
						<label class="control-label col-lg-2" for="content">Content</label>
						<div class="col-lg-10">
						  <textarea class="form-control" id="content"></textarea>
						</div>
					  </div>

					  <!-- Tags -->
					  <div class="form-group">
						<label class="control-label col-lg-2" for="tags">Tags</label>
						<div class="col-lg-10">
						  <input type="text" class="form-control" id="tags">
						</div>
					  </div>

					  <!-- Buttons -->
					  <div class="form-group">
						<!-- Buttons -->
						<div class="col-lg-offset-2 col-lg-9">
						  <button type="submit" class="btn btn-primary">Publish</button>
						  <button type="submit" class="btn btn-danger">Save Draft</button>
						  <button type="reset" class="btn btn-default">Reset</button>
						</div>
					  </div>
					</form>
				</div>


			</div>
			<div class="widget-foot">
			  <!-- Footer goes here -->
			</div>
		</div>
	</div>

</div>
</div><!--end .row-->

<?php
include('incs/footer.php');
