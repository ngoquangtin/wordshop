<?php
function confirm_query( $dbc, $query ){
	$result = mysqli_query( $dbc, $query );
	if( !$result ){

		if(!LIVE){//If In Dev Process
			$output = "<strong>$query</strong>: " . mysqli_error( $dbc )." on ".strtoupper(FILE_NAME);		
		} else {
			$output = 'Some Problems Occur. Sorry for this !';
		}
		
		$error = "
$query: " . mysqli_error( $dbc )." on ".strtoupper(FILE_NAME). " at ". time();
	//Write On debug file if is LIVE
		$o = @fopen('D:/xampp/htdocs/wordshop/debug.txt','a');
		fwrite($o,$error);
		fclose($o);
		
		die($output);
	}
	return $result;
}