		</section>
	</section><!--main content end-->
</section><!-- container section end -->

	<!-- javascripts -->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!-- nice scroll -->
	<script src="js/jquery.scrollTo.min.js"></script>
	<script src="js/jquery.nicescroll.js" type="text/javascript"></script>

	<!-- jquery ui -->
	<script src="js/jquery-ui-1.9.2.custom.min.js"></script>

	<!--custom checkbox & radio-->
	<script type="text/javascript" src="js/ga.js"></script>
	<!--custom switch-->
	<script src="js/bootstrap-switch.js"></script>
	<!--custom tagsinput-->
	<script src="js/jquery.tagsinput.js"></script>

	<!-- colorpicker -->

	<!-- bootstrap-wysiwyg -->
	<script src="js/jquery.hotkeys.js"></script>
	<script src="js/bootstrap-wysiwyg.js"></script>
	<script src="js/bootstrap-wysiwyg-custom.js"></script>
	<script src="js/moment.js"></script>
	<script src="js/bootstrap-colorpicker.js"></script>
	<script src="js/daterangepicker.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<!-- ck editor -->
	<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
	<!-- custom form component script for this page-->
	<script src="js/form-component.js"></script>
	<!-- custome script for all page -->
	<script src="js/scripts.js"></script>

<?php
	$jtags = '';
	foreach($jfiles as $file){
		$jtags .= '<script type="text/javascript" src="';
		$jtags .= (strpos($file, "http")===false) ? 'js/custom-scripts/'.$file : $file;
		$jtags .= '"></script>';
	}
	echo str_replace("</script><script", '</script>
	<script', $jtags);
?>

</body>

</html>