<?php include('../incs/mysqli-connect.php'); ?>
<?php include('../incs/functions.php'); ?>
<?php check_user(1); ?>

<?php $title = 'Manage Users'; ?>
<?php include('incs/header.php'); ?>

<?php
	$limit = 3;
	if( isset($_GET['start']) && is_numeric($_GET['start']) && ($_GET['start']>=0) ){
		$start = $_GET['start'];
		$start = $start - ($start%$limit);
	} else {
		$start = 0;
	}
	
	$current_page = ( $start/$limit ) + 1;
	
	$q = "SELECT user_id, account, display_name, email, level, date_format(registration_time, '%d-%m-%Y') as registration_time FROM users";
	$q .= " WHERE user_id!=". $_SESSION['user']['user_id'];
	$q .= " ORDER BY user_id DESC";
	$q .= " LIMIT $start, $limit";
	$r = confirm_query( $dbc, $q );

	if( mysqli_num_rows( $r ) > 0 ) : 
		$custom_jquery_scripts .= '<script src="js/custom-scripts/delete-item-ajax.js"></script>';
?>

<div class="row">
	
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">Manage Users</header>

			<table class="table table-striped table-advance table-hover">
				<tbody>
					<tr>
						<th>Account</th>
						<th>Display Name</th>
						<th>Email</th>
						<th>Role</th>
						<th>Registration Date</th>
						<th><i class="icon_cogs"></i> Action</th>
					</tr>
					
					<?php while( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ) ) : ?>

					<tr>
						<td><?php echo $row['account']; ?></td>
						<td><?php echo $row['display_name']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php
							switch($row['level']){
								case 1: $level = 'admin'; break;
								case 2: $level = 'contributor'; break;
								case 3: $level = 'member'; break;
							}
							echo ucfirst($level);
						?></td>
						<td><?php echo $row['registration_time']; ?></td>
						<td>
							<div class="btn-group">
								<a class="btn btn-primary" href="edit_user.php?user_id=<?php echo $row['user_id']; ?>"><i class="icon_plus_alt2"></i></a>
								<!--<a class="btn btn-success" href="#"><i class="icon_check_alt2"></i></a>-->
								<a data-table="users" data-type="user" data-id="<?php echo $row['user_id']; ?>" class="btn btn-danger a-delete-item" href="#"><i class="icon_close_alt2"></i></a>
							</div>
						</td>
					</tr>
					
					<?php endwhile; ?>

				</tbody>
			</table>
		</section>
	</div><!--end .col-lg-12-->
</div><!--end .row-->

<img class="loading-img" src="<?php echo get_home_url().'/images/loading.gif'; ?>" style="margin: 0 auto 20px;display: none;" alt="loading ..." />

<?php $id_field = 'user_id'; $table = 'users' ?>
<?php include('incs/pagination.php'); ?>

<?php endif; ?>

<?php include('incs/footer.php'); ?>
