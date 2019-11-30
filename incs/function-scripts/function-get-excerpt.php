<?php
function get_excerpt( $content, $chars_num, $readmore = '' ){
	$content = strip_tags($content);
	$content = substr( $content, 0, $chars_num );
	$content = substr( $content, 0, strrpos($content, ' ',0) );
	
	return $content . $readmore;
}