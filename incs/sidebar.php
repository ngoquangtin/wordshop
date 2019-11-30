	<div id="sidebar">
	
		<div class="store-newbie div-widget-sidebar-group radius_shadow">
			<!--
			<h3 class="h3-widget-title-sidebar uppercase">Izwebz store</h3>
			<img src="images/store.jpg" class="img-sidebar" alt="widget image" />
			
			<h3 class="h3-widget-sidebar"><a href="#">Các series nên xem trên izwebz cho newbie</a></h3>
			<p class="p-widget-sidebar">
				Khi vào izwebz chắc nhiều bạn cho rằng các bài viết trên izwebz đều không có hệ thống gì cả? Thực chất, các bài biết đều đi theo một series của riêng nó, ví dụ như PHP, HTML & CSS, PSD2HTML, Photoshop, illustrator,… Trong bài viết này, mình sẽ tổng hợp lại các series bài viết cần thiết cho một newbie.
			</p>
			-->
			
			<ul class="ul-post-newbie">
				<div>
			<?php for( $i=0; $i<=9; $i++ ) : 
				$post = $randomPosts[$i];
				$url = $post['thumbnail_url'];
				if( is_null($url) ) $url = DEFAULT_POST_THUMBNAIL_URL;
			?>
				<li>
					<a href="<?php echo get_permalink($post['slug']); ?>"><img src="<?php echo $url; ?>" alt="<?php echo $post['title']; ?>" /></a>
					<h4><a href="<?php echo get_permalink($post['slug']); ?>"><?php echo $post['title']; ?></a></h4>
					<p>Post by <a href="<?php echo get_author_link($post['user_id']); ?>"><?php echo $post['display_name']; ?></a> <?php echo $post['day']; ?></p>
				</li>
			<?php endfor; ?>
				</div>
			</ul>
		</div><!--end #store_newbie-->

		<?php include('incs/3-tabs-navigation-sidebar.php'); ?>

	</div><!--end #sidebar-->