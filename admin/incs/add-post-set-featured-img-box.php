<div class="set-featured-image-box-wrap" style="display:none; z-index:2000;">
	<div class="set-featured-image-box">
		<h2>Set Featured Image</h2>
		<p class="close-box-wrap"><a class="a-close-box" href="#">Close</a></p>
		
		<ul id="ul-tab-set-featured-image">
			<li data-tab="upload-featured-image" class="li-tab-active">Upload</li>
			<li data-tab="featured-image-attachment">Library</li>
		</ul>
		
		<div class="featured-img-tabs-group" id="div-1">
			<form id="upload-image" action="processors/upload-featured-image.php" enctype="multipart/form-data" method="post">
				<input type="file" name="upload-featured-image" style="display: none;" />
				<button name="button-upload-image" type="button">Upload Image</button>
			</form>
		</div>

		<div class="featured-img-tabs-group" id="div-2">
			<div class="images-attachment">
			<?php
				if($handle = opendir('../uploads/images')){
					
					while($item = readdir($handle)){
						$abs_path = get_home_url().'/uploads/images/'.$item;
						$rel_path = '../uploads/images/'.$item;
						
						if( !is_dir($rel_path) && is_array(getimagesize($rel_path) ) ){
							echo '<img width="100" height="100" src="'.$abs_path.'" />';
						}

					}
					closedir($handle);
				}
			?>
			</div>

			<button name="button-select-image" type="button">Select</button>
		</div>
	</div>
</div>