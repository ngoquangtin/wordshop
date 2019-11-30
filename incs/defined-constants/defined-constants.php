<?php 
define( 'BASE_URL', 'http://localhost/wordshop' );
define( 'DEFAULT_POST_THUMBNAIL_URL', get_home_url() . '/images/wordpress-big-icon.png' );
define( 'DEFAULT_USER_AVATAR_URL', get_home_url() . '/images/no-avatar.jfif' );
define( 'LIVE', false );
define( 'FILE_NAME', basename($_SERVER['SCRIPT_NAME']) );
define( 'LOADING_IMG_URL', get_home_url().'/images/loading.gif' );
define( 'LOADING_IMG_TAG', '<img class="loading-img" src="'.LOADING_IMG_URL.'" alt="loading img" style="display: none;" />' );