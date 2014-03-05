<?php

	$database_host = "dbhost.cs.man.ac.uk";
	$database_user = "mbax2ip4";
	$database_pass = "vanillacupcake";
	$database_name = "mbax2ip4";
	$group_dbnames = array("2013_comp10120_w2",);

	$con = new mysqli($database_host , $database_user, $database_pass, $database_name);

	/* Check connection */
	if (mysqli_connect_errno())
	echo "Failed to connect to MySQL: " . mysqli_connect_error();

?>