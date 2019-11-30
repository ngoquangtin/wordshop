<?php
include('../incs/mysqli-connect.php');
include('../incs/functions.php');
check_user(3, get_login_url());

//Export The Number Count Of Pages, Posts, Categories, Users
$items = array('page','post','category','user');
$count = array();

foreach($items as $i){
	
	if($i == 'category'){
		$q = "SELECT count(term_id) as category FROM terms WHERE taxonomy='category'";
	} else {
		$table = "{$i}s"; $id_field = "{$i}_id";
		$q = "SELECT count($id_field) AS $i FROM $table";
	}

	list($count[$i]) = mysqli_fetch_array(confirm_query($dbc,$q),MYSQLI_NUM);
}

$title = 'Dashboard';
include('incs/header.php');
?>

	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			<div class="info-box blue-bg">
				<i class="fa fa-cloud-download"></i>
				<div class="count"><?php echo $count['page']; ?></div>
				<div class="title">Pages</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			<div class="info-box brown-bg">
				<i class="fa fa-shopping-cart"></i>
				<div class="count"><?php echo $count['post']; ?></div>
				<div class="title">Posts</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			<div class="info-box dark-bg">
				<i class="fa fa-thumbs-o-up"></i>
				<div class="count"><?php echo $count['category']; ?></div>
				<div class="title">Categories</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			<div class="info-box green-bg">
				<i class="fa fa-cubes"></i>
				<div class="count"><?php echo $count['user']; ?></div>
				<div class="title">Users</div>
			</div>
		</div>

	</div>

<?php
include('incs/footer.php');