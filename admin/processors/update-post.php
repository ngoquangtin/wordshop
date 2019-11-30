<?php 
include('../../incs/mysqli-connect.php');
include('../../incs/functions.php');

$fields = $_POST['fields'];

$q = "update posts (".create_fields_list_sql($fields).")";
echo $q;