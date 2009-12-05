<?php
	// When this is set to 1, shows simple memory usage.
	// Default: 0
	$memdebugz = 0;
	
	// A list of stocks for the SparkLines
	// If you add new ones, as of now, you need to  alter index.php to fit.
	$stock1 = '^DJI';
	$sname1	= 'Dow Jones';
	$stock2	= '^IXIC';
	$sname2	= 'NASDAQ';
	$stock3	= '^GSPC';
	$sname3	= 'S&amp;P 500';
	
	// To counter PHP 5.3 hating SimplePie...
	error_reporting(0);
?>