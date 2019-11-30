<?php
include('../incs/mysqli-connect.php');
include('../incs/functions.php');
check_user(1);

	$limit = 5;
	if( isset($_GET['start']) && is_numeric($_GET['start']) && ($_GET['start']>=0) ){
		$start = $_GET['start'];
		$start = $start - ($start%$limit);
	} else {
		$start = 0;
	}
	
	$current_page = ( $start/$limit ) + 1;

	$q = "SELECT page_id, title, left(content,600) AS excerpt
		  FROM pages
		  ORDER BY page_id DESC
		  LIMIT $start,$limit";

	$r = confirm_query( $dbc, $q );

$title = 'Manage Pages';
include('incs/header.php');

	if( mysqli_num_rows( $r ) > 0 ) : 
		$jfiles[] = 'delete-item-ajax.js';		
?>

<div class="row">
	<div class="col-lg-12">

<section class="panel">
	<header class="panel-heading"><?php echo $title; ?></header>

	<table class="table table-striped table-advance table-hover">
		<tbody>
			<tr>
				<th>Title</th>
				<th>Excerpt</th>
				<th>Action</th>
			</tr>
			
			<?php
				while( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ) ) :
			?>
			<tr>
				<td><?php echo $row['title']; ?></td>
				<td><?php echo get_excerpt( strip_tags( $row['excerpt'] ), 100, ' [...]' ); ?></td>
				
				<td>
					<div class="btn-group">
						<a class="btn btn-primary" href="edit_page.php?page_id=<?php echo $row['page_id']; ?>"><i class="icon_plus_alt2"></i></a>
						<!--<a class="btn btn-success" href="#"><i class="icon_check_alt2"></i></a>-->
						<a class="btn btn-danger a-delete-item" data-table="pages" data-type="page" data-id="<?php echo $row['page_id']; ?>" href="#"><i class="icon_close_alt2"></i></a>
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
$id_field = 'page_id'; $table = 'pages';
include('incs/pagination.php');
endif;
include('incs/footer.php');