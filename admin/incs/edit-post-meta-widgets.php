<?php $loading_img_tags = '<img class="loading-img" src="'.LOADING_IMG_URL.'" alt="loading img" style="display:none;" />';?>
<div class="row">
	<div id="set-featured-img-widget" class="col-lg-4">
		<section class="panel">
			<header class="panel-heading">Featured Image</header>
			
			<?php $action = (FILE_NAME=='add_new_post.php') ? 'add-new-post' : 'edit-post'; ?>
			<div class="panel-body">
				<a class="a-open-box" href="#">Set Featured Image</a>

			<?php if(!is_null($post['thumbnail_url'])): $style = 'style="display: block"'; ?>
				<img class="featured-img" width="170" height="170" src="<?php echo $post['thumbnail_url']; ?>" alt="<?php echo $post['title']; ?>" />
			<?php else : $style = 'style="display: none"'; endif; ?>
				
				<button data-action="<?php echo $action; ?>" class="remove-featured-img-button" <?php echo $style; ?>>Remove Featured Image</button>
				
				<div class="submit-group">
					<button data-id="<?php echo $post_id; ?>" name="update-featured-image">Update</button>
					<?php echo $loading_img_tags; ?>
				</div>
			</div>
		</section>

		<?php include('incs/set-featured-img-box.php'); ?>
	</div><!--end .col-lg-4-->

	<div class="col-lg-4">
		<section class="panel">
			<header class="panel-heading">Permalink</header>
			
			<div class="panel-body">
				<div class="form">
					<form data-id="<?php echo $post_id; ?>" id="update-slug" class="form-validate form-horizontal" method="post">

						<div class="form-group">
							<div class="col-lg-12">
								<input name="slug" class="form-control" type="text" value="<?php echo $post['slug']; ?>" required />
								<span class="help-block"><?php echo get_home_url().'/'."<strong>".$post['slug']."</strong>"; ?></span>
							</div>
						</div>

						<div class="form-group">
							<div class="submit-group col-lg-10">
								<button name="slug-button" class="btn btn-primary" type="submit">Update</button>
								<?php echo $loading_img_tags; ?>
							</div>
						</div>
					</form>
				</div>
				
			</div>
		</section>
	</div><!--end .col-lg-4-->

	<div class="col-lg-4">
		<section class="panel">
			<header class="panel-heading">Categories</header>

			<div class="panel-body">
				<div class="form">
					<form data-id="<?php echo $post_id; ?>" id="update-categories" class="form-validate form-horizontal" method="post">
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

								$q = "SELECT ID FROM postmeta WHERE post_id=$post_id AND term_id=".$hier1[0];
								$r_checked = confirm_query($dbc,$q);
								$checked = mysqli_affected_rows($dbc)==1 ? 'checked' : '';
						?>
								<div class="checkbox">
									<label>
										<input type="checkbox" value="<?php echo $hier1[0]; ?>" <?php echo $checked; ?> /><?php echo $hier1[1]; ?>
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
									$q = "SELECT ID FROM postmeta WHERE post_id=$post_id AND term_id=".$hier2[0];
									$r_checked = confirm_query($dbc,$q);
									$checked = mysqli_affected_rows($dbc)==1 ? 'checked' : '';
							?>
									<div class="checkbox" style="margin-left: 25px;">
										<label>
											<input type="checkbox" value="<?php echo $hier2[0]; ?>" <?php echo $checked; ?>  /><?php echo $hier2[1]; ?>
										</label>
									</div>
								
							<?php endwhile; ?>


						<?php endwhile; ?>


							</div>
						</div>

						<div class="form-group">
							<div class="submit-group col-lg-10">
								<button name="categories-button" class="btn btn-primary" type="submit">Update</button>
								<?php echo $loading_img_tags; ?>
							</div>
						</div>

					</form>
				</div>
			</div>
		</section>
	</div>

</div><!--end .row-->

<div class="row">
	<div class="col-lg-4">
		<section class="panel">
			<header class="panel-heading">Status</header>

			<div class="panel-body">
				<div class="form">
					<form id="delete-post" class="form-validate form-horizontal" method="post">
						<div class="form-group">
							<div class="col-lg-10">
								<button class="btn btn-primary" type="submit">Delete</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</div><!--end .col-lg-4-->
	
	<div class="col-lg-4">

	</div><!--end .col-lg-4-->

	<div class="col-lg-4">

	</div>

</div><!--end .row-->