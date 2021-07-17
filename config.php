<?php
	// mysql parms
	$dbhost = 'localhost';
	$db = 'bookwarrior';
	$dbtable = 'updated';
	$dbtable_edited = 'updated_edited';
    $descrtable = 'description';
    $descrtable_edited = 'description_edited';
    $topictable = 'topics';

	$dbuser = 'root';
	$dbpass = '1337Pwn3d';

	$dbuser_get = 'root';
	$dbpass_get = '1337Pwn3d';


	// problem resolution URL to mention in error messages
	$errurl = '';

	//$repository = 'repository';
	$maxlines = 50;

	//для RSS
	$maxnewslines = 30;
	$pagesperpage = 25;
	$servername = 'libgen.jbdynamics.net';
	//$servername = trim(str_replace('http://', '', $_SERVER["HTTP_REFERER"]), '/');
    
        // separator symbol
        $filesep = '/';

//'785000-824000'   => 'K:\\!genesis\\!repository4',

        // distributed repository
 	 $repository = array(
		       '0-390000' => '/Volumes/TimeMachine/libgen',
		  '391000-698000' => '/Volumes/TimeMachine/libgen',
		  '699000-786000' => '/Volumes/TimeMachine/libgen',
		  '787000-888000' => '/Volumes/TimeMachine/libgen',
		 '889000-1096000' => '/Volumes/TimeMachine/libgen',
		'1097000-1387000' => '/Volumes/TimeMachine/libgen',
		'1388000-1999000' => '/Volumes/TimeMachine/libgen'

);
	$covers_repository = '/covers/';
?>