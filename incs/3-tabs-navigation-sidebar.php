	<div class="tabbed_nav div-widget-sidebar-group radius_shadow">
		<ul class="ul-tab-buttons">
			<li><a href="#" data-tab="random"></a></li>
			<li><a href="#" data-tab="archives"></a></li>
			<li><a href="#" data-tab="popular"></a></li>
		</ul>
		
		<div class="div-lists-group">
			<ul>
			<?php foreach( $randomPosts as $r ) : ?>
				<li>
					<a href="<?php echo get_permalink($r['slug']); ?>"><?php echo $r['title']; ?></a>
					<span class="span-tooltips-group"><?php echo get_excerpt($r['excerpt'], 600). ' [...]'; ?></span>
				</li>
			<?php endforeach; ?>
				<li id="li-view-more-posts"><a href="#">Click me to view other posts</a></li>
			</ul>
		</div>

		<div class="div-lists-group">
			<ul>
			<?php
			$q = "select date_format(posted_time, '%b %Y') as archives from posts order by post_id desc";
			$r_time = confirm_query($dbc, $q);
			
			if(mysqli_num_rows($r_time) > 0) : 
				$archive = '';
				while( $row = mysqli_fetch_array($r_time, MYSQLI_ASSOC) ) :
					if( $row['archives'] != $archive ) : $archive = $row['archives'];
			?>
				<li><a href="archive.php?archive=<?php echo $archive; ?>"><?php echo $archive; ?></a></li>
			<?php endif; endwhile; endif; ?>
			</ul>
		</div>
		
		<div class="div-lists-group">
			<ul>
				<li><a href="#">HTML co ban</a></li>
				<li><a href="#">Tao trang web dau tien</a></li>
				<li><a href="#">PSD - HTML</a></li>
				<li><a href="#">Su dung div</a></li>
				<li><a href="#">CSS selector</a></li>
				<li><a href="#">Wordpress template</a></li>
				<li><a href="#">Tao login form</a></li>
				<li><a href="#">jQuery tabbed navgation</a></li>
				<li><a href="#">Photoshop can ban</a></li>
				<li><a href="#">Loi thuong gap voi IE6</a></li>
			</ul>
		</div>
	</div><!--end .tabbed_nav-->
	