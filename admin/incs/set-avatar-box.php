<div class="set-avatar-box-wrap" style="display: none;">
	<div class="set-avatar-box">
		<h2>Set Featured Image</h2>
		<p class="close-box-wrap"><a class="a-close-box" href="#">Close</a></p>
		
		<ul id="tabs-menu">
			<li data-tab="upload" class="li-tab-active">Upload</li>
			<li data-tab="attachment">Library</li>
		</ul>
		
		<div class="set-avatar-tabs" id="div-1">
			<form id="upload-image" action="processors/upload-avatar.php" enctype="multipart/form-data" method="post">
				<input type="file" name="upload-featured-image" style="display: none;" />
				<button name="button-upload-image" type="button">Upload Image</button>
			</form>
		</div>

		<div class="set-avatar-tabs" id="div-2">
			<div class="images-attachment">
			<?php
				if($handle = opendir('../uploads/images/avatars')){
					
					while($item = readdir($handle)){
						$abs_path = get_home_url().'/uploads/images/avatars/'.$item;
						$rel_path = '../uploads/images/avatars/'.$item;
						
						if( !is_dir($rel_path) && is_array(getimagesize($rel_path) ) ){
							echo '<img width="100" height="100" src="'.$abs_path.'" />';
						}

					}
					closedir($handle);
				}
			?>
			</div>

			<img class="loading-img" style="display:none;" src="<?php echo LOADING_IMG_URL; ?>" alt="loading image" />
			<button data-id="<?php echo $_SESSION['user']['user_id']; ?>" name="button-select-image" type="button">Select</button>
			
		</div>
	</div>
</div>