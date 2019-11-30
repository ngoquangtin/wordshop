<?php include('../incs/mysqli-connect.php'); ?>
<?php include('../incs/functions.php'); ?>
<?php check_user(); ?>
<?php
	if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
		$display = ' style="display: block;" ';
		$send = true;
		if($send){
			$output = '<div id="sendmessage" '.$display.'>Your message has been sent. Thank you!</div>';
			$_POST = array();
		} else {
			$output = '<div id="errormessage"'.$display.'>Sorry! Your message could not be send due to a system error. We are trying to fix it, please come back later.</div>';
		}
	}
?>
<?php $title = 'Contact'; ?>
<?php include('incs/header.php'); ?>
<div class="row">
	<div class="col-lg-6">
		<div class="recent">
			<h3>Send us a message</h3>
		</div>
		
		<?php if( isset($output) ) echo $output; ?>
		<!--<div id="sendmessage" style="display: block;">Your message has been sent. Thank you!</div>
		<div id="errormessage" style="display: block;">Please fill in all the fields.</div>-->
		
		<form method="post" id="form-contact">
			<div class="form-group ">
				<input required type="text" name="name" class="form-control" placeholder="Your Name" />
			</div>
			
			<div class="form-group">
				<input required type="email" class="form-control" name="email" placeholder="Your Email" />
			</div>
			
			<div class="form-group">
				<input required type="text" class="form-control" name="subject" placeholder="Subject" />
			</div>
			
			<div class="form-group">
				<textarea required class="form-control" name="message" rows="5" placeholder="Message"></textarea>
			</div>

			<div class="text-center"><button name="send-button" type="submit" class="btn btn-primary btn-lg">Send Message</button></div>
		</form>
	</div>

	<div class="col-lg-6">
		<div class="recent">
			<h3>Get in touch with us</h3>
		</div>
		
		<div class="">
			<p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum.</p>
			<p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum.</p>

			<h4>Address:</h4>Little Lonsdale St, New York<br>
			<h4>Telephone:</h4>345 578 59 45 416</br>
			<h4>Fax:</h4>123 456 789
		</div>
	</div>
</div><!-- .row-->

<?php include('incs/footer.php'); ?>
