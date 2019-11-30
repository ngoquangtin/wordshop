<?php
include( '../../incs/mysqli-connect.php' );
include( '../../incs/functions.php' );

$file = $_FILES['upload-featured-image'];

//Reset A new Name
$a = explode('.',$file['name']);
$ext = $a[count($a)-1];
$new_name = uniqid(rand(),true).'.'.$ext;

$fakepath = $file['tmp_name'];
$destination = '../../uploads/images/'.$new_name;
$abs_url = get_home_url().'/uploads/images/'.$new_name;

echo (move_uploaded_file($fakepath,$destination)) ? $abs_url : 'No';


