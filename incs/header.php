<?php
function get_list_categories(){
	global $dbc;
	$q = "SELECT term_id, name, slug FROM terms
		  WHERE taxonomy='category' AND parent=0
		  ORDER BY position ASC";
	$r = confirm_query($dbc, $q);
	$output = '';
	if( mysqli_affected_rows($dbc) > 0 ){
		while( $row = mysqli_fetch_array($r, MYSQLI_NUM) ){
			list($id, $name, $slug) = $row;
			$output .= '<li><a href="term.php?term_id='.$id.'" class="uppercase bold">'.$name.'</a>';

			$q = "SELECT term_id, name, slug FROM terms
				  WHERE taxonomy='category' AND parent=$id";
			$r1 = confirm_query($dbc, $q);
			if(mysqli_affected_rows($dbc)>0){
				$output .= '<ul>';

				while($row1 = mysqli_fetch_array($r1, MYSQLI_NUM)){
					list($id1, $name1, $slug1) = $row1;
					$output .= '<li><a href="term.php?term_id='.$id1.'" class="uppercase bold">'.$name1.'</a>';
				}

				$output .= '</ul>';
			}
			$output .= '</li>';
		}
	}
	return $output;
}

function get_list_pages(){
	global $dbc;
	$q = "SELECT slug, title AS title FROM pages ORDER BY position ASC";
	$r = confirm_query($dbc,$q);
	$output = '';
	if(mysqli_affected_rows($dbc)>0){
		while($row = mysqli_fetch_array($r,MYSQLI_ASSOC)){
			$output .= '<li><a href="'.get_page_link($row['slug']).'">'.$row['title'].'</a></li>';
		}
	}
	return $output;
}

function get_top_menu_links(){
	$output = '';
	if( is_logged_in() ){
		$output .= '<li><a href="'.get_contact_url().'">Contact</a></li>';
		if( is_logged_in(1) ) $output .= '<li><a href="'.get_admin_home_url().'">Dashboard</a></li>';
		$output .= '<li><a href="'.get_home_url().'/logout">Logout</a></li>';
	} else {
		$output .= '<li><a href="'.get_login_url('register').'">Register</a></li>';
		$output .= '<li><a href="'.get_login_url().'">Login</a></li>';
	}
	
	#$output .= '<li><a href="'.get_home_url().'/test">Test</a></li>';
	return $output;
}

function pages_menu_list(){
	$output = '';
		$output .= '<li><a href="'.get_home_url().'">Home</a></li>';
		$output .= get_list_pages();
		$output .= get_top_menu_links();
	echo $output;
}

function categories_menu_list(){
	$output = '';
	$output .= '<li><a href="'.get_home_url().'" class="uppercase bold">Home</a></li>';
	$output .= get_list_categories();
	echo $output;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<base href="<?php echo get_home_url(); ?>/" />
	<title><?php echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" href="images/favicon-png.png" />
	<link rel="stylesheet" type="text/css" href="css/general-style.css" />
	<?php
		if( isset($css_scripts) ) echo $css_scripts;
		$jquery_scripts = '';
	?>
</head>

<body>
	<div id="header_wrap">
		<div id="header">
				
			<div id="top_nav">

				<ul id="ul-page-menu">
					<?php pages_menu_list(); ?>
				</ul>
				
				<form action="search.php" method="get" id="search_form">
					<p><input name="query" type="text" placeholder="Searching here ..." /></p>
				</form>
			
			</div><!--end #top_nav-->
			
			<a href="<?php echo get_home_url(); ?>"><img src="images/logo.png" alt="logo" /></a>
			
			<ul id="ul-category-menu">
				<?php categories_menu_list(); ?>
			</ul>
			
			<div class="div-store-in-menu">
				<a href="#">Izwebz store<span>2</span></a>
				
				<div>
					<ul class="ul-list-items-store">
						<li>
							<ul>
								<li><a href="#">+ Cảm nhận của bạn về DVD PSD2HTML ...</a></li>
								<li><a href="#">+ Đặt hàng mới DVD PHP và MySQL ...</a></li>
								<li><a href="#">+ Vâng ! Chúng tôi đangkinh doanh</a></li>
								<li><a href="#">+ DVD mới : PHP và MySQL + izCMS ...</a></li>
								<li><a href="#">+ Cảm nhận của bạn về DVD DVD PHP và MySQL</a></li>
							</ul>
						</li>
						
						<li>
							<h2><a href="#">PSD2HTML + WORDPRESS</a></h2>
							<p class="money bold">Giá : 90.000 đ</p>
							<p class="intro">
								Với 60 Videos và gần 2Gb dữ liệu với những kiến thức cần thiết để bạn trở thành một web Developer thật sự, thì chỉ với 90k VND bạn có thể có tất cả những kiến thức đó...
							</p>
						</li>
						
						<li>
							<h2><a href="#">PHP and MySQL + izCMS</a></h2>
							<p class="money bold">Giá : 230.000 đ</p>
							<p class="intro">
								Đây là một bộ DVD hoàn chỉnh dành cho những ai muốn trở thành một lập trình viên PHP. Bộ đĩa này bao gồm 2 DVD, với 145 video tập trung vào những kiến thức căn bản và nâng cao...
							</p>
						</li>
					</ul>
				</div>
			</div><!--end .div-store-in-menu-->
			
			<div id="newpost_feed">
				<?php include('incs/hot-new-post.php'); ?>
				
				<div id="feed_burner">
					<ul id="feed">
						<li id="facebook">
							<h5 id="facebook" class="uppercase bold"><a href="#">Facebook fans</a></h5>
							<p>fans</p>
						</li>
						
						<li id="rss">
							<h5 id="rss" class="uppercase bold"><a href="#">RSS Subscribers</a></h5>
							<p>1036 reader</p>
						</li>
						
						<li id="twitter">
							<h5 id="twitter" class="uppercase bold"><a href="#">Twitter followers</a></h5>
							<p>followers</p>
						</li>
					</ul>
					
					<form method="post" id="burner_form" action="">
						<p><input type="text" placeholder="Enter your email to get our newsletter ..." /></p>
					</form>
				</div><!--end #feed_burner-->
			</div><!--end #newpost_feed-->

		</div><!--end #header-->
	</div><!--end #header_wrap-->

	<div id="wrapper">

		<div id="primary">
		
			<div id="content">
			