<?php
function get_single_post_content($content){
	$c = "<p>$content";
	$c = str_replace( array("\r\n","\n",'<img','/>'), array('<p>','</p>','<div class="post_media"><img','/></div>'), $c );
	return $c;
}