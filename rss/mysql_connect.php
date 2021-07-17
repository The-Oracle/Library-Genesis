<?php
	include 'config.php';
	DEFINE ('DB_USER', $dbuser);
	DEFINE ('DB_PASSWORD', $dbpass);
	DEFINE ('DB_HOST', $dbhost);
	DEFINE ('DB_NAME', $db);

	// Make the connnection and then select the database.
	$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD) OR die ('Could not connect to MySQL: ' . mysqli_error() );

	mysqli_query($dbc, "SET session character_set_server = 'UTF8'");
	mysqli_query($dbc, "SET session character_set_connection = 'UTF8'");
	mysqli_query($dbc, "SET session character_set_client = 'UTF8'");
	mysqli_query($dbc, "SET session character_set_results = 'UTF8'");
	mysqli_select_db($dbc, DB_NAME) OR die ('Could not select the database: ' . mysqli_error() );
?>
