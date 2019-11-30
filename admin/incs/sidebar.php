    <!--sidebar start-->
	
	<?php
		$script_file_name = basename( $_SERVER['SCRIPT_NAME'] );
		
		switch( $script_file_name ){

			/* 
			 *	Home : index.php
			*/
			case 'index.php':
				$index = true; 
				$page_title = 'Dashboard';
				$li_breadcrumb_output = '<li>Dashboard</li>';
				break;
				
			/*
			 *			manage_pages.php
			 * Pages :  edit_page.php
			 *			add_new_page.php
			*/
				case 'manage_pages.php': 
					$manage_pages = true; 
					$page_title = 'Manage Pages';
					$li_breadcrumb_output = '<li>Pages</li>';
					$li_breadcrumb_output .= '<li>'.$page_title.'</li>';
					break;
				case 'edit_page.php': 
					$edit_page = true; 
					$page_title = $page['title']. ' - Update Page';
					$li_breadcrumb_output = '<li>Pages</li>';
					$li_breadcrumb_output .= '<li>Update Page</li>';
					break;
				case 'add_new_page.php': 
					$add_new_page = true; 
					$page_title = 'Add New Page'; 
					$li_breadcrumb_output = '<li>Pages</li>';
					$li_breadcrumb_output .= '<li>'.$page_title.'</li>';
					break;
			/*
			 *			manage_posts.php
			 * Posts :  edit_post.php
			 *			add_new_post.php
			*/
						case 'manage_posts.php': 
							$manage_posts = true; 
							$page_title = 'Manage Posts';
							$li_breadcrumb_output = '<li>Posts</li>';
							$li_breadcrumb_output .= '<li>'.$page_title.'</li>';
							break;
						case 'edit_post.php': 
							$edit_post = true; 
							$page_title = $post['title']. ' - Update Post';
							$li_breadcrumb_output = '<li>Posts</li>';
							$li_breadcrumb_output .= '<li>Update Post</li>';
							break;
						case 'add_new_post.php': 
							$add_new_post = true; 
							$page_title = 'Add New Post'; 
							$li_breadcrumb_output = '<li>Posts</li>';
							$li_breadcrumb_output .= '<li>'.$page_title.'</li>';
							break;
			
			/*
			 *					manage_categories.php
			 * Categories :  	add_new_category.php
			 *					edit_category.php
			*/

			case 'manage_categories.php': 
				$manage_categories = true; 
				$page_title = 'Manage Categories'; 
				$li_breadcrumb_output = '<li>Categories</li>';
				$li_breadcrumb_output .= '<li>'.$page_title.'</li>';
				break;
			case 'edit_category.php': 
				$edit_category = true; 
				$page_title = $name. ' - Update Category';
				$li_breadcrumb_output = '<li>Categories</li>';
				$li_breadcrumb_output .= '<li>Update Category</li>';
				break;
			case 'add_new_category.php': 
				$add_new_category = true; 
				$page_title = 'Add New Category';
				$li_breadcrumb_output = '<li>Categories</li>';
				$li_breadcrumb_output .= '<li>'.$page_title.'</li>';
				break;

			/*
			 *			manage_profile.php
			 * Users :  manage_users.php
			 *			edit_user.php
			 *			add_new_user.php
			*/
						case 'manage_profile.php': 
							$manage_profile = true; 
							$page_title = 'Manage Profile';
							$li_breadcrumb_output = '<li>Users</li>';
							$li_breadcrumb_output .= '<li>'.$page_title.'</li>';
							break;
						case 'manage_users.php': 
							$manage_users = true; 
							$page_title = 'Manage Users';
							$li_breadcrumb_output = '<li>Users</li>';
							$li_breadcrumb_output .= '<li>'.$page_title.'</li>';
							break;
						case 'edit_user.php': 
							$edit_user = true; 
							$page_title = $user['display_name']. ' - User Info';
							$li_breadcrumb_output = '<li>Users</li>';
							$li_breadcrumb_output .= '<li>User Info</li>';
							break;
						case 'add_new_user.php': 
							$add_new_user = true; 
							$page_title = 'Add New User';
							$li_breadcrumb_output = '<li>Users</li>';
							$li_breadcrumb_output .= '<li>'.$page_title.'</li>';
							break;

			case 'manage_widgets.php': 
				$manage_widgets = true; 
				$page_title = 'Manage Widgets';
				$li_breadcrumb_output = '<li>Footer Widgets</li>';
				$li_breadcrumb_output .= '<li>'.$page_title.'</li>';
				break;
			case 'add_new_widget.php': 
				$add_new_widget = true; 
				$page_title = 'Add New Widget';
				$li_breadcrumb_output = '<li>Footer Widgets</li>';
				$li_breadcrumb_output .= '<li>'.$page_title.'</li>';
				break;
				
			case 'contact.php': 
				$contact = true; 
				$page_title = 'Contact Us';
				$li_breadcrumb_output = '<li>Contact</li>';
				break;
				
						case 'settings.php': 
							$settings = true; 
							$page_title = 'Settings';
							$li_breadcrumb_output = '<li>Settings</li>';
							break;
			
			default: 
				$index = true; 
				$page_title = 'Dashboard';
				$li_breadcrumb_output = '<li>Dashboard</li>';
				break;
		}
		
		$class = ' active';
		$style = ' style="font-weight: bold; background-color: #1a2732;"';
	?>
	
	<aside>
		<div id="sidebar" class="nav-collapse ">
			<!-- sidebar menu start-->
			<ul class="sidebar-menu">			
				<li <?php if( isset($index) ) echo 'class="'. $class .'"'; ?>>
					<a href="<?php echo get_admin_home_url(); ?>">
						<i class="icon_desktop"></i><span>Dashboard</span>
					</a>
				</li>
				
				<?php if( is_logged_in(2) && !is_logged_in(1) ) : ?>
				<li <?php if( isset($add_new_post) ) echo 'class="'. $class .'"'; ?>>
					<a href="add_new_post.php">
						<i class="icon_documents_alt"></i>
						<span>Add New Post</span>
					</a>
				</li>
				<?php endif; ?>

				<?php if( is_logged_in(1) ) : ?>
				<li class="sub-menu <?php if( isset($manage_pages) || isset($edit_page) || isset($add_new_page) ) echo $class; ?>">
					<a href="javascript:;">
						<i class="icon_documents_alt"></i>
						<span>Pages</span>
						<span class="menu-arrow arrow_carrot-right"></span>
					</a>
					<ul class="sub">
						<?php if( is_logged_in(1) ) : ?>
						<li><a <?php if( isset($manage_pages) ) echo $style; ?> href="manage_pages.php">Manage Pages</a></li>
						<?php endif; ?>
						<?php if( isset($edit_page) && is_logged_in(1) ) : ?>
						<li><a <?php echo $style; ?> href="edit_page.php?page_id=<?php echo $page_id; ?>">Update Page</a></li>
						<?php endif; ?>
						<li><a <?php if( isset($add_new_page) ) echo $style; ?> href="add_new_page.php">Add New Page</a></li>
					</ul>
				</li>
				<?php endif; ?>
				
				<?php if( is_logged_in(1) ) : ?>
				<li class="sub-menu <?php if( isset($manage_posts) || isset($edit_post) || isset($add_new_post) ) echo $class; ?>">
					<a href="javascript:;">
						<i class="icon_documents_alt"></i>
						<span>Posts</span>
						<span class="menu-arrow arrow_carrot-right"></span>
					</a>
					<ul class="sub">
						<?php if( is_logged_in(1) ) : ?>
						<li><a <?php if( isset($manage_posts) ) echo $style; ?> href="manage_posts.php">Manage Posts</a></li>
						<?php endif; ?>
						<?php if( isset($edit_post) && is_logged_in(1) ) : ?>
						<li><a <?php echo $style; ?> href="edit_post.php?post_id=<?php echo $post_id; ?>">Update Post</a></li>
						<?php endif; ?>
						<li><a <?php if( isset($add_new_post) ) echo $style; ?> href="add_new_post.php">Add New Post</a></li>
					</ul>
				</li>
				<?php endif; ?>
				
				<?php if( is_logged_in(1) ) : ?>
				<li class="sub-menu <?php if( isset($manage_categories) || isset($add_new_category) || isset($edit_category) ) echo $class; ?>">
					<a href="javascript:;">
						<i class="icon_ul"></i>
						<span>Categories</span>
						<span class="menu-arrow arrow_carrot-right"></span>
					</a>
					<ul class="sub">
						<li><a <?php if( isset($manage_categories) ) echo $style; ?> href="manage_categories.php">Manage Categories</a></li>
						<?php if( isset($edit_category) ) : ?>
						<li><a <?php echo $style; ?> href="edit_category.php?category_id=<?php echo $category_id; ?>">Update Category</a></li>
						<?php endif; ?>
						<li><a <?php if( isset($add_new_category) ) echo $style; ?> href="add_new_category.php">Add New Category</a></li>
					</ul>
				</li>
				<?php endif; ?>
				
				<?php if( is_logged_in(2) && !is_logged_in(1) ) : ?>
				<li <?php if( isset($manage_profile) ) echo 'class="'. $class .'"'; ?>>
					<a href="manage_profile.php">
						<i class="icon_profile"></i>
						<span>My Profile</span>
					</a>
				</li>
				<?php endif; ?>
				
				<?php if( is_logged_in(1) ) : ?>
				<li class="sub-menu <?php if( isset($manage_profile) || isset($manage_users) || isset($edit_user) || isset($add_new_user) ) echo $class; ?>">
					<a href="javascript:;">
						<i class="icon_group"></i>
						<span>Users</span>
						<span class="menu-arrow arrow_carrot-right"></span>
					</a>
					
					<ul class="sub">
						<li><a <?php if( isset($manage_profile) ) echo $style; ?> href="<?php echo get_home_url(); ?>/my-profile">My Profile</a></li>
						<?php if( is_logged_in(1) ) : ?>
						<li><a <?php if( isset($manage_users) ) echo $style; ?> href="manage_users.php">Manage Users</a></li>
						<?php endif; ?>
						<?php if( isset($edit_user) && is_logged_in(1) ) : ?>
						<li><a <?php echo $style; ?> href="edit_user.php?user_id=<?php echo $user_id; ?>">Edit User</a></li>
						<?php endif; ?>
						<?php if( is_logged_in(1) ) : ?>
						<li><a <?php if( isset($add_new_user) ) echo $style; ?> href="add_new_user.php">Add New User</a></li>
						<?php endif; ?>
					</ul>
				</li>
				<?php endif; ?>
				
				<?php if( is_logged_in(1) ) : ?>
				<li class="sub-menu <?php if( isset($manage_widgets) || isset($add_new_widget) ) echo $class; ?>">
					<a href="javascript:;">
						<i class="icon_genius"></i>
						<span>Footer Widgets</span>
						<span class="menu-arrow arrow_carrot-right"></span>
					</a>
					
					<ul class="sub">
						<li><a <?php if( isset($manage_widgets) ) echo $style; ?> href="manage_widgets.php">Manage Widgets</a></li>
						<li><a <?php if( isset($add_new_widget) ) echo $style; ?> href="add_new_widget.php">Add New Widget</a></li>
					</ul>
				</li>
				<?php endif; ?>
				
				<li <?php if( isset($contact) ) echo 'class="'. $class .'"'; ?>>
					<a href="<?php echo get_contact_url(); ?>">
						<i class="icon_contacts"></i>
						<span>Contact</span>
					</a>
				</li>
				
				<?php if( is_logged_in(1) ) : ?>
				<li <?php if( isset($settings) ) echo 'class="'. $class .'"'; ?>>
					<a href="settings.php">
						<i class="icon_contacts"></i>
						<span>Settings</span>
					</a>
				</li>
				<?php endif; ?>
				
			</ul>
			<!-- sidebar menu end-->
		</div>
    </aside>
    <!--sidebar end-->