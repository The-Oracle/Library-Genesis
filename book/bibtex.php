<?php
include '../config.php';
include '../html.php';

if(isset($_GET['md5']))
{

	if (!preg_match('|^[A-Fa-f0-9]{32}$|', $_GET['md5']))
	{	
		die($htmlhead."Wrong MD5".$htmlfoot);
	}
	else
	{
		$md5 = $_GET['md5'];
	}		
}
else
{
	die($htmlhead."Missing MD5".$htmlfoot);
}


$con = mysqli_connect($dbhost, $dbuser, $dbpass);
		mysqli_query($con, "SET session character_set_server = 'UTF8'");
		mysqli_query($con, "SET session character_set_connection = 'UTF8'");
		mysqli_query($con, "SET session character_set_client = 'UTF8'");
		mysqli_query($con, "SET session character_set_results = 'UTF8'");
		mysqli_select_db($con, $db);
//$md5  = '8b6071fec36f937aa2d042072f0500b4';


$sqlbibtex = "SELECT * FROM `".$dbtable."` WHERE `MD5`='$md5'";
$resultbibtex = mysqli_query($con, $sqlbibtex);
if (!$resultbibtex || mysqli_num_rows($resultbibtex) == 0)
{
	die($htmlhead."Error " . mysqli_error() . "Cannot proceed or MD5 not found in DB".$htmlfoot);
}

$rowbibtex = mysqli_fetch_assoc($resultbibtex);


$title = $rowbibtex['Title'];
$author = $rowbibtex['Author'];
$publisher = $rowbibtex['Publisher'];
$identifier = $rowbibtex['Identifier'];
$year = $rowbibtex['Year'];
$pages = $rowbibtex['Pages'];
$series = $rowbibtex['Series'];
$volume = $rowbibtex['VolumeInfo'];
$id = $rowbibtex['ID'];
$md5 = $rowbibtex['MD5'];
$edition = $rowbibtex['Edition'];

$data = "<textarea rows='11' name='bibtext' id='bibtext' readonly cols='150'>
@book{book:{$id},
   title =     { $title},
   author =    { $author},
   publisher = { $publisher},
   isbn =      { $identifier},
   year =      { $year},
   series =    { $series},
   edition =   { $edition},
   volume =    { $volume},
   url =       {http://gen.lib.rus.ec/book/index.php?md5=$md5}
}</textarea>";

$data = str_replace('{ ', '{', $data);
echo "\xEF\xBB\xBF";
echo $data;

echo $htmlfoot
?>