<?php
include( '../../incs/mysqli-connect.php' );
include( '../../incs/functions.php' );

$file = $_FILES['upload-featured-image'];

$fakepath = $file['tmp_name'];

$a = explode('.',$file['name']);
$ext = $a[count($a)-1];
$newname = uniqid(rand(),true).'.'.$ext;
$destination = '../../uploads/images/avatars/'.$newname;
$abs_url = get_home_url().'/uploads/images/avatars/'.$newname;
echo (move_uploaded_file($fakepath,$destination)) ? $abs_url : 'No';