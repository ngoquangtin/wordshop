<?php include('incs/mysqli-connect.php'); ?>
<?php include('incs/functions.php'); ?>
<?php if( is_logged_in() ) header("Location: ".get_admin_home_url()); ?>

<?php
if( isset($_GET['action']) ){
	switch($_GET['action']){
		case 'lostpassword': $action = 'lostpassword'; $title = 'Lost Password'; $form_part_file='lostpassword-form.php'; break;
		case 'register': $action = 'register'; $title = 'Register'; $form_part_file='register-form.php'; break;
		case 'resetpassword': $action = 'resetpassword'; $title = 'Reset Password'; $form_part_file='resetpassword-form.php'; break;
		default: $action = 'login'; $title = 'Login'; break;
	}
} else if(isset($_GET['checkemail'])){
	if($_GET['checkemail']=='confirm') $action = 'checkemail to confirm';
	if($_GET['checkemail']=='registered') $action = 'checkemail to activate';
	$title = 'Login';
} else if(isset($_GET['loggedout']) && $_GET['loggedout']=='true' ){
	$action = 'loggedout';
	$title = 'Login';
} else if(isset($_GET['resetpassword']) && $_GET['resetpassword']=='true' ){
	$action = 'resetpassword';
	$title = 'Login';
} else if(isset($_GET['activation']) && $_GET['activation']=='true' ){
	$action = 'activation';
	$title = 'Login';
} else {
	$action = 'login';
	$title = 'Login';
}

if(!isset($form_part_file)) $form_part_file='login-form.php';
?>

<?php include('incs/login-parts/header.php'); ?>

<div id="login">
<?php include('incs/login-parts/'. $form_part_file); ?>
	<p id="backtoblog"><a href="<?php echo get_home_url(); ?>">&larr; Back to Two Columns Theme</a></p>
</div><!--end #login-->
<?php include('incs/login-parts/footer.php'); ?>
	