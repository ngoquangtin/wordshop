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

	$q = "SELECT p.post_id, p.title, DATE_FORMAT(p.posted_time, '%d-%m-%Y') AS posted_time, u.display_name
		  FROM posts AS p INNER JOIN users AS u USING(user_id)
		  ORDER BY post_id DESC
		  LIMIT $start,$limit";

	$r = confirm_query( $dbc, $q );

$title = 'Manage Posts';
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
						<th>Author</th>
						<th>Categories</th>
						<th>Tags</th>
						<th>Posted Time</th>
						<th><i class="icon_cogs"></i> Action</th>
					</tr>
					
				<?php while( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ) ) : ?>
					<tr>
						<td><?php echo $row['title']; ?></td>
						<td><?php echo $row['display_name']; ?></td>
						<td><?php echo get_edit_post_categories_list($row['post_id']); ?></td>
						<td>asd</td>
						<td><?php echo $row['posted_time']; ?></td>
						
						<td>
							<div class="btn-group">
								<a class="btn btn-primary" href="edit_post.php?post_id=<?php echo $row['post_id']; ?>"><i class="icon_plus_alt2"></i></a>
								<a data-table="posts" data-type="post" data-id="<?php echo $row['post_id']; ?>" class="btn btn-danger a-delete-item" href="#"><i class="icon_close_alt2"></i></a>
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
$id_field = 'post_id'; $table = 'posts';
include('incs/pagination.php');
endif;
include('incs/footer.php');

function get_edit_post_categories_list($post_id){
	global $dbc;
	$q = "SELECT pm.term_id, t.name
		  FROM postmeta AS pm INNER JOIN terms AS t USING(term_id)
		  WHERE pm.post_id=$post_id AND t.taxonomy='category'
		  ORDER BY term_id ASC";
	$r = confirm_query($dbc,$q);

	$output = '';
	if( mysqli_affected_rows($dbc) > 0 ){
		$i = 1;
		while($term = mysqli_fetch_array($r,MYSQLI_NUM)){
			list($term_id, $name) = $term;

			if($i>1) $output .= ', ';
			$output .= '<a href="'.get_edit_term_link($term_id).'">'.$name.'</a>';

			$i++;
		}
	}

	return $output;
}

function get_edit_term_link($term_id){
	return get_admin_home_url(). "/edit_term.php?term_id=$term_id";
}