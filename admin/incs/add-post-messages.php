	<?php
		if(isset($has_message)) :
			if($has_message == 'success'){
				$class = 'alert alert-success fade in';
				$message_report = '<strong>Well done!</strong> You successfully publish this post.';
			} else {
				$class = 'alert alert-block alert-danger fade in';
				$message_report = '<strong>Oh snap!</strong> Could not publish your post due to a system error.';
			}
	?>
		<div class="<?php echo $class; ?>">
			<button data-dismiss="alert" class="close close-sm" type="button"><i class="icon-remove"></i></button>
			<?php echo $message_report; ?>
		</div>
	<?php endif; ?>