<?php

	$stock = "^DJI";
	
	$year = 5; // Lenth of time in years.

	$m  = date('n') - 1;
	$d  = date('d');
	$y2 = date('Y');
	$y1 = $y2 - $year;

	$url = "http://ichart.finance.yahoo.com/table.csv?s=" . $stock . "&a=$m&b=$d&c=$y1&d=$m&e=$d&f=$y2&g=d&ignore=.csv";

	
	
?>