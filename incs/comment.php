<div class="comment-form-section radius_shadow">
	<h1>Leave a Comment</h1>
	<form id="comment-form" method="post">
		<input class="user-id" value="<?php echo $_SESSION['user']['user_id']; ?>" type="hidden" />
		<input class="display-name" value="<?php echo $_SESSION['user']['display_name']; ?>" type="hidden" />
		<input class="avatar_url" value="<?php echo get_img_url($_SESSION['user']['avatar_url'],'avatar'); ?>" type="hidden" />
		<input class="post-id" value="<?php echo $post_id; ?>" type="hidden" />
		<textarea rows="15" cols="80" name="message" required></textarea>
		<img class="loading-img" style="display:none" src="<?php echo LOADING_IMG_URL; ?>" alt="loading img" />
		<button name="post-comment-button" type="submit">Post Comment</button>
	</form>
	
</div>

<?php
	$q = "SELECT c.comment_id, c.user_id, c.content, c.comment_replied_id, u.display_name, u.avatar_url";
	$q .= " FROM comments AS c";
	$q .= " INNER JOIN users AS u";
	$q .= " USING(user_id)";
	$q .= " WHERE post_id=$post_id";
	$q .= " AND comment_replied_id IS NULL";
	$q .= " ORDER BY comment_id DESC";
	$r = confirm_query( $dbc, $q );
	
	if( mysqli_num_rows($r) > 0 ) :
		while( $row = mysqli_fetch_array($r, MYSQLI_ASSOC) ) :
?>

<div id="div-comment-<?php echo $row['comment_id']; ?>" class="comments-depth-1-group radius_shadow">
	
	<div class="comment-content">
		<h3><?php echo $row['display_name']; ?> - ID <?php echo $row['comment_id']; ?></h3>
		<img width="100" height="100" src="<?php echo (!is_null($row['avatar_url'])) ? $row['avatar_url'] : DEFAULT_USER_AVATAR_URL; ?>" alt="<?php echo $row['display_name']; ?>" />
		<p><?php echo $row['content']; ?></p>
	<?php if(is_logged_in(2)): ?>
		<a data-id="<?php echo $row['comment_id']; ?>" data-depth="1" class="delete-comment" href="#">Delete This Comment</a>
	<?php endif; ?>
	</div><!--end .comment-content-->
	
	<?php
		$q1 = "SELECT c.comment_id, c.user_id, c.content, u.display_name, u.avatar_url";
		$q1 .= " FROM comments AS c";
		$q1 .= " INNER JOIN users AS u";
		$q1 .= " USING(user_id)";
		$q1 .= " WHERE comment_replied_id=". $row['comment_id'];
		$q1 .= " ORDER BY comment_id DESC";
		
		$r1 = confirm_query($dbc, $q1);
		
		if( mysqli_num_rows($r1) > 0 ) :
			while( $row1 = mysqli_fetch_array($r1, MYSQLI_ASSOC) ) :
	?>
	
	<div id="div-comment-<?php echo $row1['comment_id']; ?>" class="comments-depth-2-group">
		<div class="comment-content">
			<h3><?php echo $row1['display_name']; ?> - ID <?php echo $row1['comment_id']; ?></h3>
			<img width="100" height="100" src="<?php echo (!is_null($row1['avatar_url'])) ? $row1['avatar_url'] : DEFAULT_USER_AVATAR_URL; ?>" alt="<?php echo $row1['display_name']; ?>" />
			<p><?php echo $row1['content']; ?></p>
		<?php if(is_logged_in(2)): ?>
			<a data-id="<?php echo $row1['comment_id']; ?>" data-depth="2" class="delete-comment" href="#">Delete This Comment</a>
		<?php endif; ?>
		</div>
		
	</div><!--end .content-->
	
	<?php endwhile; endif; ?>
	
	<button class="show-reply-form">Reply</button>
	<form class="reply-form" method="post" style="display:none;">
		<input class="author_user_id" value="<?php echo $row['user_id']; ?>" type="hidden" />
		<input class="user_id" value="<?php echo $_SESSION['user']['user_id']; ?>" type="hidden" />
		<input class="display_name" value="<?php echo $_SESSION['user']['display_name']; ?>" type="hidden" />
		<input class="avatar_url" value="<?php echo get_img_url($_SESSION['user']['avatar_url'],'avatar'); ?>" type="hidden" />
		<input class="post_id" value="<?php echo $post_id; ?>" type="hidden" />
		<input class="comment_replied_id" value="<?php echo $row['comment_id']; ?>" type="hidden" />
		<textarea rows="15" cols="80" name="message" required></textarea>
		<img style="display:none;" class="loading-img" src="<?php echo LOADING_IMG_URL; ?>" alt="loading img" />
		<button name="reply-button" type="submit" >Reply ID <?php echo $row['comment_id']; ?></button>
	</form>
	
</div>
	
<?php endwhile; endif; ?>