<?php
function get_img_url($src, $type='thumbnail'){
	if(!is_null($src)){
		$return = $src;
	} else {
		if($type=='thumbnail'){
			$return = DEFAULT_POST_THUMBNAIL_URL;
		} elseif($type=='avatar'){
			$return = DEFAULT_USER_AVATAR_URL;
		}
	}
	return $return;
}