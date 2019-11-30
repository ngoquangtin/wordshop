<?php $i = 1; while( $post = mysqli_fetch_array($r, MYSQLI_ASSOC) ) :?>
	<div class="post_item <?php echo ( $i % 2 == 1 ) ? 'float_left' : 'float_right'; ?> radius_shadow">
		<a href="<?php echo get_permalink($post['slug']); ?>" class="thumbnail"><img src="<?php echo get_img_url($post['thumbnail_url']); ?>" alt="<?php echo $post['title']; ?>" /></a>
		<h1><a href="<?php echo get_permalink($post['slug']); ?>"><?php echo $post['title']; ?></a></h1>
		<p><?php echo get_excerpt( $post['content'], 600, ' [...]' ); ?></p>
		
		<?php $display = ( is_logged_in(2) ) ?'block' :'none'; ?>
		<p class="edit-post" style="display: <?php echo $display; ?>">
			<a href="<?php if( is_logged_in(2) ) echo get_edit_post_url($post['post_id']); ?>">Edit This Post</a>
		</p>
		
		<a href="<?php echo get_permalink($post['slug']); ?>" class="view_more">View More</a>
	</div><!--end .post_item-->
<?php $i++; endwhile; ?>