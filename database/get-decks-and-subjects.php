<?php

	$database_host = "dbhost.cs.man.ac.uk";
	$database_user = "mbax2ip4";
	$database_pass = "vanillacupcake";

	$con = new mysqli($database_host , $database_user, $database_pass, "2013_comp10120_w2");

	$subjects = mysqli_query($con, "SELECT name from `Subject` ORDER BY name LIMIT 5");

	while ($row = (mysqli_fetch_row($subjects))) {
		print_R($row[0]);
		echo "<br/>";
	}

	echo "<br/>";

	$decks = mysqli_query($con, "SELECT name from `Deck` ORDER BY rating, name LIMIT 5");

	while ($row = (mysqli_fetch_row($decks))) {
		print_R($row[0]);
		echo "<br/>";
	}

?>
