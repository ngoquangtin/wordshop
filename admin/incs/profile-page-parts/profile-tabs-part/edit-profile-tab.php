	<div id="edit-profile" class="tab-pane active">
		<section class="panel">
			<div class="panel-body bio-graph-info">
				<h1> Profile Info</h1>
				
				<?php if(isset($error) && $error == 'success') : ?>
				<div class="alert alert-success fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Well done!</strong> You successfully changed your profile.
				</div>
				<?php endif; ?>
				
				<?php if(isset($error) && $error == 'error sql') : ?>
				<div class="alert alert-block alert-danger fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>Sorry!</strong> A system error occur. Please try it later or <a href="<?php echo get_contact_url(); ?>">contact us about this problem</a>.
				</div>
				<?php endif; ?>
				
				<form method="post" class="form-horizontal" role="form" action="manage_profile.php#header-panel-heading">
				
					<div class="form-group">
						<label class="control-label col-lg-2" for="display_name">Display Name as: </label>
						<div class="col-lg-4">
							<select name="display_name" class="form-control m-bot15">
								<option value="<?php echo $_SESSION['user']['display_name']; ?>" selected="selected"><?php echo $_SESSION['user']['display_name']; ?></option>
								<?php
									$fn = $_SESSION['user']['first_name'];
									$ln = $_SESSION['user']['last_name'];
									$other_name = ($_SESSION['user']['display_name'] == $fn.' '.$ln) ? $ln.' '.$fn : $fn.' '.$ln;
								?>
								<option value="<?php echo $other_name; ?>"><?php echo $other_name; ?></option>
							</select>
						</div>
					</div>				
				
					<div class="form-group">
						<label class="col-lg-2 control-label" for="first_name">First Name <span class="required">*</span></label>
						<div class="col-lg-4">
							<input name="first_name" id="input-first-name" value="<?php echo $_SESSION['user']['first_name']; ?>" type="text" class="form-control" required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-2 control-label" for="last_name">Last Name <span class="required">*</span></label>
						<div class="col-lg-4">
							<input name="last_name" id="input-last-name" value="<?php echo $_SESSION['user']['last_name']; ?>" type="text" class="form-control" required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-2 control-label" for="email">Email <span class="required">*</span></label>
						<div class="col-lg-4">
							<input name="email" value="<?php echo $_SESSION['user']['email']; ?>" type="email" class="form-control" required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-2 control-label" for="password">Password</label>
						<div class="col-lg-4">
							<button id="show-hide-input-password" type="button">Change Password</button>
							<input id="password-field" name="password" type="password" class="form-control" style="display:none" />
							<button id="show-hide-password" type="button" style="display:none">Show</button>
							<button id="cancel-change-password" type="button" style="display:none">Cancel</button>
						</div>
					</div>
								  
					<div class="form-group">
						<label class="col-lg-2 control-label" for="bio">About Me</label>
						<div class="col-lg-8">
							<textarea name="bio" id="textarea-user-bio" class="form-control" rows="10"><?php 
								if( !is_null($_SESSION['user']['bio']) ) echo $_SESSION['user']['bio']; 
							?></textarea>
						</div>
					</div>


					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</div>
				  
				</form>
			</div>
		</section>
	</div>