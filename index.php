<?php
	// This should be set to the full path
	require ('/home/digest/conf/settings.php');

	require_once ($install.'/lib/php/simplepie.inc');
	require_once ($install.'/lib/php/sparkline/Sparkline_Line.php');
	include ($install.'/lib/php/functions.php');

	if (isset($_GET['type']))
	{ $newsType	= $_GET['type']; }
	else { $newsType = null; }
	include ($install.'/lib/php/feeds.php');
	$memuse	= number_format(memory_get_usage());
?>
<!doctype html>
<html>
	<head>
		<title><?php echo $plug; ?> &lt; Feed Digest | neomelonas.com</title>
		<link rel="stylesheet" type="text/css" href="<?php echo $uriPath; ?>lib/css/newstyle.css" />
		<!--[if IE]>
			<link rel="stylesheet" type="text/css" href="<?php echo $uriPath; ?>lib/css/iestyle.css" />
		<![endif]-->
		<link rel="shortcut icon" href="<?php echo $uriPath; ?>lib/img/favicon.ico" type="image/x-icon" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta http-equiv="content-language" content="en" />
		<meta name="description" content="A digest of popular newsfeeds.." />
		<meta name="google-site-verification" content="uZPoUBJX2p8Ll-FXaXPhWgd7jw9wOp26HLbTONRYBWA" /><!-- Specific to THIS site. /-->
	</head>
	<body>
		<div id="container">
			<a id="top"></a>
			<div id="header">
				<h1 class="title"><?php echo $plug; ?> Feed Digest</h1>
				<nav>
				<div class="nav">
				<ul>
					<li><a href="<?php echo $uriPath; ?>">Main</a></li>
					<li><a href="<?php echo $uriPath; ?>business/">Business</a></li>
					<li><a href="<?php echo $uriPath; ?>politics/">Politics</a></li>
					<li><a href="<?php echo $uriPath; ?>tech/">Technology</a></li>
					<li><a href="<?php echo $uriPath; ?>sports/">Sports</a></li>
					<li><a href="<?php echo $uriPath; ?>entertainment">Entertainment</a></li>
				</ul>
				</div>
				</nav>
				<div id="charts">
					<p class="lies">This feature is currently unavailable.</p>
					<ul>
						<li><?php sparkLineStock($stock1, $sname1); ?> &nbsp; <span class="charts"><?php echo$sname1; ?></span></li>
						<li><?php sparkLineStock($stock2, $sname2); ?> &nbsp; <span class="charts"><?php echo $sname2; ?></span></li>
						<li><?php sparkLineStock($stock3, $sname3); ?> &nbsp; <span class="charts"><?php echo $sname3; ?></span></li>
					</ul>
				</div>
				<hr />
			</div>
			<div id="body">
				<section class="news">
					<?php
					foreach ($feed->get_items() as $item)									
					{
						$feeds = $item->get_feed();
						echo '<article><a href="'. $item->get_permalink() .'">'. $item->get_title() .'</a>&nbsp;<a href="'.$feeds->get_permalink().'"><img src="'. $feeds->get_favicon() .'" alt="'.$feeds->get_title().'" title="'.$feeds->get_title().'" border="0" width="16" height="16" /></a>';
						echo '<p>'. $item->get_description() .'</p>';
						echo '<p>'. $item->get_date().' | Source: <a href="'. $feeds->get_permalink() .'">'. $feeds->get_title() .'</a></p></article>';
						if ($counter == 10)
						{
							echo '<hr />';
							echo "<aside class='ad'>";
							$counter = 0;
							include ($install.'/lib/js/ads.js');
							echo "<details>ADVERTISEMENT</details>";
							echo "</aside>";
						}
						else
						{ $counter = $counter + 1; }
						echo '<hr />';
					}
					?>
				</section>
			</div>
			<div id="footer">
			<footer>
				<p>Powered by <a href="http://simplepie.org/">SimplePie</a>.  Historic stock data from <a href="http://finance.yahoo.com/">Yahoo! Finance</a>.  Design by <a href="http://neomelonas.com/">Neo Melonas</a> &copy;2009.</p>
				<p><?php echo_memory_usage($memdebugz); ?> </p>
			</footer>
			</div>
		</div>
		<div id="footbar">
			<nav><!--[if IE]><div class="nav"><![endif]-->
				<ul>
					<li><a href="<?php echo $uriPath; ?>">Main</a></li>
					<li><a href="<?php echo $uriPath; ?>business/">Business</a></li>
					<li><a href="<?php echo $uriPath; ?>politics/">Politics</a></li>
					<li><a href="<?php echo $uriPath; ?>tech/">Technology</a></li>
					<li><a href="<?php echo $uriPath; ?>sports/">Sports</a></li>
					<li><a href="<?php echo $uriPath; ?>entertainment">Entertainment</a></li>
					<li><a href="#top" class="backup">&uarr; Top</a></li>
				</ul>
			<!--[if IE]></div><![endif]--></nav>
		</div>
		<?php include_once 'lib/js/ga.js'; ?>
	</body>
</html>
