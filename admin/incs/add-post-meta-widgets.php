<?php $loading_img_tags = '<img class="loading-img" src="'.LOADING_IMG_URL.'" alt="loading img" style="display:none;" />';?>
<div class="row">
	<div id="set-featured-img-widget" class="col-lg-4">
		<section class="panel">
			<header class="panel-heading">Featured Image</header>
			
			<div class="panel-body">
				<a class="a-open-box" href="#">Set Featured Image</a>
				
				<button class="remove-featured-img-button" style="display: none;">Remove Featured Image</button>
			</div>
		</section>

		<?php include('incs/add-post-set-featured-img-box.php'); ?>
	</div><!--end .col-lg-4-->

	<div class="col-lg-4">
		<section class="panel">
			<header class="panel-heading">Categories</header>

			<div class="panel-body">
				<div class="form">
					<form id="publish-post-categories" class="form-validate form-horizontal" method="post">
						<div class="form-group">
							<div class="col-lg-10">

						<?php
							$q = "
								SELECT term_id, name FROM terms
								WHERE taxonomy='category' AND parent=0
								ORDER BY term_id ASC
							";
							$r_hier1 = confirm_query($dbc,$q);
							while($hier1 = mysqli_fetch_array($r_hier1,MYSQLI_NUM)):
						?>
								<div class="checkbox">
									<label>
										<input type="checkbox" value="<?php echo $hier1[0]; ?>" /><?php echo $hier1[1]; ?>
									</label>
								</div>
							
							<?php
								$q = "
									SELECT term_id, name FROM terms
									WHERE taxonomy='category' AND parent=".$hier1[0]."
									ORDER BY term_id ASC
								";
								$r_hier2 = confirm_query($dbc,$q);
								while($hier2 = mysqli_fetch_array($r_hier2,MYSQLI_NUM)):
							?>
									<div class="checkbox" style="margin-left: 25px;">
										<label>
											<input type="checkbox" value="<?php echo $hier2[0]; ?>" /><?php echo $hier2[1]; ?>
										</label>
									</div>
							<?php endwhile; ?>
						<?php endwhile; ?>


							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</div>

	<div class="col-lg-4">
	</div><!--end .col-lg-4-->
</div><!--end .row-->