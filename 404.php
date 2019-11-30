<?php
include('incs/mysqli-connect.php');
include('incs/functions.php');

#Set Some Vars To Call In Header
	$title = "Page Not Found";
	$css_scripts = '<link rel="stylesheet" type="text/css" href="css/archive-content-style.css" />';

#Call Header
	include('incs/header.php');
?>

	<div class="big_post_item radius_shadow">
		<h4>Sorry. Page Not Found.</h4>
	</div><!--end .big_post_item-->

<?php 
include('incs/footer.php');