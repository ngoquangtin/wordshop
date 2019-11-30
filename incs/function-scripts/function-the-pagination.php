<?php

function the_pagination( $limit, $current_page, $total_page, $next_text='Next', $prev_text='Prev', $ul_attr=array(), $current_li_attr=array(), $id=array() ){

		$output = '';
		$ul_id = '';
		$ul_class = '';
		$ul_attr_in_tag = '';
		
		if( !empty($ul_attr) ){
			
			foreach( $ul_attr as $name=>$value ){
				
				if( $name == 'class' & is_array($value) ){
					$ul_attr_in_tag .= ' class="';
					
					foreach( $value as $v ){
						$ul_attr_in_tag .= $v.' ';
					}
					
					$ul_attr_in_tag .= '" ';
				} else {
					$ul_attr_in_tag .= ' '.$name.'="'.$value.'" ';
				}
				
			}
		} 
		
		$output .= '<ul'. $ul_attr_in_tag .'>';
		
		//$id = 'user_id=3&';
		
		$id_get = ( !empty($id) ) ? $id['type'] .'='. $id['value'] .'&' : '';
		$file = FILE_NAME . '?' . $id_get;
		
		$prev_link = '<li><a href="'. $file .'start='. ( ($current_page-1) -1)*$limit .'">'. $prev_text .'</a></li>';
		$next_link = '<li><a href="'. $file .'start='. ( ($current_page+1) -1)*$limit .'">'. $next_text .'</a></li>';
		
		$first_link = '<li><a href="'. basename( $_SERVER['SCRIPT_NAME'] ) .'">First Page</a></li>';
		$last_link = '<li><a href="'. $file .'start='. ($total_page-1)*$limit .'">Last Page</a></li>';
		
		$current_li_attr_in_tag = '';
		
		if( !empty($current_li_attr) ){
			foreach( $current_li_attr as $name=>$value ){
				if( $name == 'class' ){
					$current_li_attr_in_tag .= ' class="';
					
					if( is_array($value) ){
						foreach( $value as $v ){
							$current_li_attr_in_tag .= $v .' ';
						}
					} else {
						$current_li_attr_in_tag .= $value .' ';
					}
					
					$current_li_attr_in_tag .= '" ';
				} else {
					$current_li_attr_in_tag .= ' '.$name.'="'.$value.'" ';
				}
			}
		}
		
		if( $total_page == 1 ){
			$output .= '<li'. $current_li_attr_in_tag .'>1</li>';
		} elseif( $total_page == 2 ){
			if( $current_page == 1 ){
				$output .= '<li'. $current_li_attr_in_tag .'>1</li>';
				$output .= '<li><a href="'. $file .'start='. (2-1)*$limit .'">2</a></li>';
				$output .= $next_link;
			} else {
				$output .= $prev_link;
				$output .= '<li><a href="'. $file .'start=0">1</a></li>';
				$output .= '<li'. $current_li_attr_in_tag .'>2</li>';
			}
		} elseif( $total_page>=3 && $total_page <= 5 ){
			
			if( $current_page == 1 ){
				$output .= '<li'. $current_li_attr_in_tag .'>1</li>';
				
				for ($i = 2; $i <= $total_page; $i++){
					$output .= '<li><a href="'. $file .'start='. ($i - 1)*$limit .'">'. $i .'</a></li>';
				}
				
				$output .= $next_link;
			} elseif( $current_page == $total_page ){
				$output .= $prev_link;
				
				for ($i = 1; $i <= ($total_page-1); $i++){
					$output .= '<li><a href="'. $file .'start='. ($i - 1)*$limit .'">'. $i .'</a></li>';
				}
				
				$output .= '<li'. $current_li_attr_in_tag .'>'. $total_page .'</li>';
			} else {
				$output .= $prev_link;
				
				for ($i = 1; $i <= $total_page; $i++){
					if( $i == $current_page ){
						$output .= '<li'. $current_li_attr_in_tag .'>'. $i .'</li>';
					} else {
						$output .= '<li><a href="'. $file .'start='. ($i - 1)*$limit .'">'. $i .'</a></li>';
					}
				}
				
				$output .= $next_link;
			}
			
		} else {
			//If $total_page > 5
			
			if( $current_page <= 3 ){
				$output .= ( $current_page > 1 ) ? $prev_link : '';
				
				for ($i = 1; $i <= 5; $i++){
					if( $i == $current_page ){
						$output .= '<li'. $current_li_attr_in_tag .'>'. $current_page .'</li>';
					} else {
						$output .= '<li><a href="'. $file .'start='. ($i - 1)*$limit .'">'. $i .'</a></li>';
					}
				}
				$output .= $next_link;
				$output .= $last_link;
			} elseif( $current_page >= $total_page-2 ){
				$output .= $first_link;
				$output .= $prev_link;
				
				for ($i = ($total_page-4); $i <= ($total_page); $i++){
					if( $i == $current_page ){
						$output .= '<li'. $current_li_attr_in_tag .'>'. $current_page .'</li>';
					} else {
						$output .= '<li><a href="'. $file .'start='. ($i - 1)*$limit .'">'. $i .'</a></li>';
					}
				}
				
				if( $current_page < $total_page ) $output .= $next_link;
			} else {
				$output .= $first_link;
				$output .= $prev_link;
				
				for ($i = ($current_page-2); $i <= ($current_page+2); $i++){
					if( $i == $current_page ){
						$output .= '<li'. $current_li_attr_in_tag .'>'. $current_page .'</li>';
					} else {
						$output .= '<li><a href="'. $file .'start='. ($i - 1)*$limit .'">'. $i .'</a></li>';
					}
				}
				
				$output .= $next_link;
				$output .= $last_link;
			}
			
		}//if( $total_page <= 5 )
		
		$output .= '</ul>';
		echo $output;

}// end the_pagination
