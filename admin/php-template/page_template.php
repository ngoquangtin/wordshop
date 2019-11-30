<?php include('../incs/mysqli_connect.php'); ?>
<?php include('../incs/functions.php'); ?>
<?php $title = ''; ?>
<?php include('incs/header.php'); ?>
<div class="row">
	
	<?php
		
	?>
	
	<div class="col-lg-12">
		<section class="panel">
			
		</section>
	</div><!--end .col-lg-12-->
</div><!--end .row-->

<?php 
if( !isset($custom_jquery_scripts) ) $custom_jquery_scripts = ''; 
$custom_jquery_scripts .= '<script src="js/custom-scripts/scripts.js"></script>'; 
?>

<?php include('incs/footer.php'); ?>