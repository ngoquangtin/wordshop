<?php

	if($id_field=='user_id'){
	//Minor 1 the Count Because We Ignore The Current User
		$q = "SELECT (COUNT($id_field)-1) AS count FROM $table";
	} elseif($id_field == 'category_id'){
		$q = "SELECT COUNT(term_id) AS count FROM terms WHERE taxonomy='category'";
	} else {
		$q = "SELECT COUNT($id_field) AS count FROM $table";
	}
	$r = confirm_query( $dbc, $q );
	
	if( mysqli_num_rows( $r ) > 0 ){
		while( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ) ){
			$total_post = $row['count'];
		}
		
		$surplus = $total_post%$limit;
		if( $surplus > 0 ){
			$total_page = (($total_post-$surplus)/$limit) + 1;
		} else {
			$total_page = $total_post/$limit;
		}
	}
?>

<?php //if( $total_page > 1 ) : ?>
<div class="row">
	<div class="col-lg-6"></div>
	
	<div class="col-lg-6">
		<section class="panel">
			<div class="panel-body">
				<div class="text-center">
				
		
		<?php	

		$style = '';
		$style .= 'position: relative;';
		$style .= 'float: left;';
		$style .= 'padding: 6px 12px;';
		$style .= 'line-height: 1.428571429;';
		$style .= 'background-color: #1a2732;';
		$style .= 'color: white;';
		$style .= 'border: 1px solid #ddd;';
		$style .= 'margin-left: -1px;';

		$ajax = false;
		
		if($ajax):
			$next_text='»'; 
			$prev_text='«';
			
			$ul_attr = array(
				'class' => array('pagination')
			);
			
			$current_li_attr = array(
				'class' => 'current-page',
				'style' => $style
			);
		
			
			the_pagination( $limit, $current_page, $total_page, $next_text, $prev_text, $ul_attr, $current_li_attr);
		else : 
		?>


<input class="limit" value="<?php echo $limit; ?>" type="hidden" />		
<input class="total-page" value="<?php echo $total_page; ?>" type="hidden" />		
<input class="current-page-style" value="<?php echo $style; ?>" type="hidden" />	
<input class="id_field" value="<?php echo $id_field; ?>" type="hidden" />		
<input class="table" value="<?php echo $table; ?>" type="hidden" />		
<?php
//USE AJAX TO CREATE PAGINATION MENU
$jfiles[] = 'pagination-admin-ajax.js';
endif; 
?>

				</div>
			</div>
		</section>
	</div><!--end .col-lg-6-->
</div><!--end .row-->
<?php // endif; ?>

<!--
<div class="row">
	<div class="col-lg-4"></div>
	
	<div class="col-lg-4">
		<section class="panel">
			<div class="panel-body">
				<div class="text-center">
					<ul class="pagination">
						<li><a href="#">«</a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#">»</a></li>
					</ul>
				</div>
			</div>
		</section>
	</div><!--end .col-lg-4
	
	<div class="col-lg-4"></div>
</div><!--end .row-->