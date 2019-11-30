	<?php if( isset($has_message) && $has_message == 'success' ) : ?>
		<div class="alert alert-success fade in">
			<button data-dismiss="alert" class="close close-sm" type="button">
				<i class="icon-remove"></i>
			</button>
			<strong>Well done!</strong> You successfully publish this post.
		</div>
	<?php endif; ?>
	
	<?php if( isset($has_message) && $has_message == 'error' ) : ?>
		<div class="alert alert-block alert-danger fade in">
			<button data-dismiss="alert" class="close close-sm" type="button">
				<i class="icon-remove"></i>
			</button>
			<strong>Oh snap!</strong> Could not publish your post due to a system error.
		</div>
	<?php endif; ?>