<?php
	// Set the install directory.
	//   NO TRAILING SLASH
	$install = "D:/Server/xampp/htdocs/NewsDigest/";
	// If it is installed at the root of a (sub)domain, just put a "/", otherwise,
	// enter the directory of the URL after the http://example.com/
	// 
	$uriPath = "/NewsDigest/";
	
	/*/
	// A list of stocks for the SparkLines
	// If you add new ones, as of now, you need to  alter index.php to fit.
	// Also, use the symbols provided by Yahoo! as other services (read: Google)
	// have been known to use different ticker symbols.
	/*/	
	$stock1 = '^DJI';
	$sname1	= 'Dow Jones';

	$stock2	= '^IXIC';
	$sname2	= 'NASDAQ'; 

	$stock3	= '^GSPC';
	$sname3	= 'S&amp;P 500';
	
	// When this is set to 1, shows simple memory usage.
	// Default: 0
	$memdebugz = 0;
	
	// To counter PHP 5.3 hating SimplePie...
	error_reporting(0);
?>
