<?php
include('../incs/mysqli-connect.php');
include('../incs/functions.php');
check_user(1);

	$limit = 10;
	if( isset($_GET['start']) && is_numeric($_GET['start']) && ($_GET['start']>=0) ){
		$start = $_GET['start'];
		$start = $start - ($start%$limit);
	} else {
		$start = 0;
	}
	
	$current_page = ( $start/$limit ) + 1;
	
	$q = "
		SELECT term_id, name from terms
		where taxonomy='category'
		order by term_id DESC
		limit $start,$limit
	";
	$r = confirm_query( $dbc, $q );

$title = 'Manage Categories';
include('incs/header.php');

	if( mysqli_num_rows( $r ) > 0 ) : 
		$jfiles[] = 'delete-category-ajax.js';
?>

<div class="row">
	<div class="col-lg-12">

<section class="panel">
	<header class="panel-heading">Categories</header>

	<table class="table table-striped table-advance table-hover">
		<tbody>
			<tr>
				<th><i class="icon_profile"></i> Category</th>
				<th><i class="icon_calendar"></i> Total Posts</th>
				<th><i class="icon_cogs"></i> Action</th>
			</tr>
			
			<?php while( $row = mysqli_fetch_array( $r, MYSQLI_NUM ) ) : list($id, $name) = $row; ?>
			<tr>
				<td><?php echo $name; ?></td>
				<td><?php list($count) = mysqli_fetch_array(confirm_query($dbc, "SELECT COUNT(post_id) FROM postmeta WHERE term_id=$id")); echo $count; ?></td>

				<td>
					<div class="btn-group">
						<a class="btn btn-primary" href="edit_category.php?category_id=<?php echo $id; ?>"><i class="icon_plus_alt2"></i></a>
						<a data-id="<?php echo $id; ?>" class="btn btn-danger a-delete-item" href="#"><i class="icon_close_alt2"></i></a>
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

<?php
$id_field = 'category_id'; $table = 'categories';
include('incs/pagination.php');
endif;
include('incs/footer.php');