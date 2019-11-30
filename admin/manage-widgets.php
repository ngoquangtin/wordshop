<?php
#Begin Page
	include('../incs/mysqli-connect.php');
	include('../incs/functions.php');
	check_user(1);

#Set Some Vars To Call In Header
	$title = 'Manage Widgets';
	$cfiles = array('manage-widgets.css');

#Call Header
	include('incs/header.php');
?>
<div class="row">
	<div id="pages-menu-widget" class="col-lg-4">
		<section class="panel">
			<header class="panel-heading">Pages Menu</header>

			<div class="list-group">
				<?php
					$q = "SELECT page_id, title FROM pages ORDER BY position ASC";
					$r_page = confirm_query($dbc,$q);
					$pages = '';
					while($row = mysqli_fetch_array($r_page,MYSQLI_NUM)){
						$pages .= '<a class="list-group-item " data-id="'.$row[0].'" href="#">'.$row[1].'</a>';
					}
					echo $pages;
				?>
			</div>
			
			<div class="panel-body">
				<button data-menu="pages" name="pages-menu-submit" class="btn btn-primary" type="submit">Save Changes</button>
				<?php echo LOADING_IMG_TAG; ?>
			</div>
		</section>
	</div>
	
	<div id="categories-menu-widget" class="col-lg-4">
		<section class="panel">
			<header class="panel-heading">Categories Menu</header>

			<div class="list-group">
				<?php
					$q = "
						SELECT term_id, name FROM terms
						WHERE taxonomy='category' AND parent=0
						ORDER BY position ASC
					";
					$r = confirm_query($dbc,$q);
					$cates = '';
					while($row = mysqli_fetch_array($r,MYSQLI_NUM)){
						$cates .= '<a class="list-group-item" data-id="'.$row[0].'" href="#">'.$row[1].'</a>';
					}
					echo $cates;
				?>
			</div>
			
			<div class="panel-body">
				<button data-menu="categories" name="categories-menu-submit" class="btn btn-primary" type="submit">Save Changes</button>
				<?php echo LOADING_IMG_TAG; ?>
			</div>
		</section>
	</div>
	<div class="col-lg-4">
		<section class="panel">
			<header class="panel-heading">Custom content</header>
			<div class="list-group">
				<a class="list-group-item " href="javascript:;">
					<h4 class="list-group-item-heading">List group item heading</h4>
					<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
				</a>
				<a class="list-group-item active" href="javascript:;">
					<h4 class="list-group-item-heading">List group item heading</h4>
					<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
				</a>
				<a class="list-group-item" href="javascript:;">
					<h4 class="list-group-item-heading">List group item heading</h4>
					<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
				</a>
			</div>
		</section>
	</div>
</div><!-- row-->

<div class="row">
	<div class="col-lg-4">
		<section class="panel">
			<header class="panel-heading">Basic items</header>
			<ul class="list-group">
				<li class="list-group-item">Lorem ipsum dolor sit amet</li>
				<li class="list-group-item">Praesent tempus eleifend risus</li>
				<li class="list-group-item">Praesent tempus eleifend risus</li>
				<li class="list-group-item">Porta ac consectetur ac</li>
				<li class="list-group-item">Vestibulum at eros</li>
				<li class="list-group-item">Vestibulum at eros</li>
			</ul>
		</section>
	</div>
	<div class="col-lg-4"></div>
	<div class="col-lg-4"></div>
</div><!-- row-->

<?php
$jfiles[] = 'manage-widgets.js';
include('incs/footer.php');