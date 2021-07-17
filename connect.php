<?php
	include 'config.php';
	include 'html.php';
	function mysqli_result($res, $row, $field=0) { 
	    $res->data_seek($row); 
	    $datarow = $res->fetch_array(); 
	    return $datarow[$field]; 
	}
if(isset($_GET)) {
	$con = mysqli_connect($dbhost,$dbuser,$dbpass);
	if (!$con)
		die($htmlhead."<font color='#A00000'><h1>Error</h1></font>Could not connect to the database: ".mysqli_error()."<br>Cannot proceed.<p><a href='http://genofond.org/viewtopic.php?f=3&t=3925'>Please, report on the error</a>.".$htmlfoot);

}
	mysqli_query($con, "SET session character_set_server = 'UTF8'");
	mysqli_query($con, "SET session character_set_connection = 'UTF8'");
	mysqli_query($con, "SET session character_set_client = 'UTF8'");
	mysqli_query($con, "SET session character_set_results = 'UTF8'");

	mysqli_select_db($con, $db);
?>
