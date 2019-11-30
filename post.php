<?php include('incs/mysqli-connect.php'); ?>
<?php include('incs/functions.php'); ?>
<?php

global $dbc;
	$options = array('posts_per_page_index','posts_per_page_archive');
	$q = "select set_value from settings where set_name='posts_per_page_index' limit 1";
	$r = confirm_query($dbc, $q);
	$a = mysqli_fetch_array($r, MYSQLI_NUM);
	
	echo "<pre>";
	print_r($a);
	echo "</pre>";
