<?php

$dbc = mysqli_connect('localhost', 'root', '', 'test');

if(!$dbc){
	echo "Could not connect to Database.";
} else {
	mysqli_set_charset($dbc, 'utf8');
}