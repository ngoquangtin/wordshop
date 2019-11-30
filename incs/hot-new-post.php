	<?php
	$q = "SELECT p.post_id, p.title, p.content as excerpt, p.slug, p.thumbnail_url, DATE_FORMAT(p.posted_time, '%d/%m/%Y') as day";
	$q .= " , u.user_id, u.display_name";
	$q .= " from posts as p";
	$q .= " inner join users as u using(user_id)";
	$q .= " ORDER BY RAND()";
	$q .= " LIMIT 0,10";
	$r_random = confirm_query($dbc, $q);
	
	if( mysqli_num_rows($r_random) > 0 ) :
		$randomPosts = array();
		while( $row = mysqli_fetch_array($r_random, MYSQLI_ASSOC) ) :
			$randomPosts[] = $row;
		endwhile;
	endif; 
	?>
	
	<div id="host_new_post">
		<p class="uppercase bold">Hot <span>new</span> post</p>
		
		<div id="post">
			<ul>
				<?php for( $i=0; $i<=2; $i++ ) : 
					$rand = $randomPosts[$i];
					$url = $rand['thumbnail_url'];
					if( is_null($url) ) $url = DEFAULT_POST_THUMBNAIL_URL;
				?>
				<li>
					<img src="<?php echo $url; ?>" alt="<?php echo $rand['title'].'\'s thumbnail'; ?>" />
					<a href="<?php echo get_permalink($rand['slug']); ?>"><?php echo $rand['title']; ?></a>
				</li>
				<?php endfor; ?>
				<!--
				<li>
					<img src="images/php.jpg" alt="new post php" />
					<a href="#">Co ban PHP - Bai 1</a>
				</li>
				<li>
					<img src="images/jquery.jpg" alt="new post jquery" />
					<a href="#">Gioi thieu ve jQuery</a>
				</li>
				
				<li>
					<img src="images/manbics.png" alt="new post manbics" />
					<a href="#">Photoshop tutorial - Manbics layout</a>
				</li>
				-->
			</ul>
		</div><!--end #post-->
	</div><!--end #host_new_post-->