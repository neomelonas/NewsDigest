<?php
	require_once ('conf/settings.php');
	require_once ('lib/php/simplepie.inc');
	if (isset($_GET['type']))
	{ $newsType	= $_GET['type']; }
	else { $newsType = null; }
	include ($install.'/lib/php/feeds.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $plug; ?> Mini Feed Digest | NeoMelonas.com</title>
	<link rel="stylesheet" type="text/css" href="lib/css/ministyle.css" />
	<link rel="shortcut icon" href="lib/img/favicon.ico" type="image/x-icon" /><!-- Favicon /-->
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>
	<body>
	        	<div id="footbar">
                        <nav><div class="nav">
                                <ul>
                                        <li><a href="<?php echo $uriPath; ?>mini/">Main</a></li>
                                        <li><a href="<?php echo $uriPath; ?>mini/business/">Business</a></li>
                                        <li><a href="<?php echo $uriPath; ?>mini/politics/">Politics</a></li>
                                        <li><a href="<?php echo $uriPath; ?>mini/tech/">Technology</a></li>
                                        <li><a href="<?php echo $uriPath; ?>mini/sports/">Sports</a></li>
                                        <li><a href="<?php echo $uriPath; ?>mini/entertainment">Entertainment</a></li>
                                        <li><a href="#top" class="backup">&uarr; Top</a></li>
                                </ul>
                        </div></nav>
                </div>
		<div id="container">
			<div id="header">
					<h1><?php echo $plug; ?> Mini Feed Digest</h1>
				<hr />
			</div>
			<div id="body">
				<ul id="news">
					<?php foreach ($feed->get_items() as $item)
					{
						$feeds = $item->get_feed();
						echo "<li>";
						echo '<a href="'.$feeds->get_permalink().'"><img src="'. $feeds->get_favicon() .'" alt="'.$feeds->get_title().'" title="'.$feeds->get_title().'" border="0" width="16" height="16" /></a><a href="'. $item->get_permalink() .'">'. $item->get_title() .'</a>';
						echo "</li>";
					} ?>
				</ul>
			</div>
			<div id="footer">
				<p>This page is powered by <a href="http://simplepie.org/">SimplePie</a>.  Designed by <a href="http://neomelonas.com/">Neo Melonas</a> &copy;2009.</p>
			</div>
		</div>
	</body>
</html>