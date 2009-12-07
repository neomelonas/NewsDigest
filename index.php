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
		<link rel="stylesheet" type="text/css" href="/lib/css/newstyle.css" />
		<!--[if IE]>
			<link rel="stylesheet" type="text/css" href="/lib/css/iestyle.css" />
		<![endif]-->
		<link rel="shortcut icon" href="/lib/img/favicon.ico" type="image/x-icon" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta http-equiv="content-language" content="en" />
		<meta name="description" content="A digest of popular newsfeeds.." />
	</head>
	<body>
		<div id="container">
			<div id="header">
				<h1 class="title"><?php echo $plug; ?> Feed Digest</h1></li>
				<nav>
				<div id="nav">
				<ul>
					<li><a href="/">News</a></li>
					<li><a href="/business/">Business</a></li>
					<li><a href="/politics/">Politics</a></li>
					<li><a href="/tech/">Technology</a></li>
					<li><a href="/sports/">Sports</a></li>
				</ul>
				</div>
				</nav>
				<div id="charts">
					<p>This feature is currently unavailable.</p>
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
						echo '<p>'. $item->get_date().'</p></article>';
						if ($counter == 10)
						{
							echo "<aside class='ad'>";
							$counter = 0;
							include ($install.'/lib/js/ads.js');
							echo "</details>THIS IS AN ADVERTISEMENT</details>";
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
				<p>Powered by <a href="http://simplepie.org/">SimplePie</a>.  Historic stock data from <a href="http://finance.yahoo.com/">Yahoo! Finance</a>.  Design by <a href="http://neomelonas.com/">Neo Melonas</a> &copy;2009.</p>
				<p><?php echo_memory_usage($memdebugz); ?> </p>
			</div>
		</div>
		<?php include_once 'lib/js/ga.js'; ?>
	</body>
</html>