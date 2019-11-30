<?php include('incs/functions.php'); ?>
<?php check_user(3, get_login_url()); ?>
<?php if(!isset($_SESSION['redirect_back_url'])) header("Location: ".get_admin_home_url()); ?>

<html>
<head>
	<title>Redirect</title>
	<style>
	
	body{margin: 0;
    padding: 0;
    background-color: #e2e2e2;}
	
	.wrap{background: #fff;
    width: 400px;
    margin: 20px auto;
    box-shadow: 1px 2px 16px #c5c5c5;
    font-size: 25px;}
	
	a{    display: block;
    font-family: sans-serif;
    text-decoration: none;
    padding: 20px 20px 10px;
}}
	
	</style>
</head>

<body>
	<div class="wrap">
		<a href="<?php echo get_admin_home_url(); ?>">Go To Admin Site</a>
		<a href="<?php echo $_SESSION['redirect_back_url']; ?>">Go Back To Previous Page.</a>
	</div>
</body>
</html>