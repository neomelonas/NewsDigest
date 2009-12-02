<?php
	require_once ('/home/digest/lib/php/simplepie.inc');
	//require '/home/digest/lib/php/functions.php';
	$feed = new SimplePie();
	$feed->set_feed_url(array(
		'http://feeds.reuters.com/reuters/businessNews',
		'http://online.wsj.com/xml/rss/3_7014.xml',
		'http://feeds.nytimes.com/nyt/rss/Business',
		'http://news.google.com/news?pz=1&cf=all&ned=us&hl=en&topic=b&output=rss',
		'http://feeds.reuters.com/reuters/topNews',
		'http://online.wsj.com/xml/rss/3_7011.xml',
		'http://www.nytimes.com/services/xml/rss/nyt/HomePage.xml',
		'http://news.google.com/news?pz=1&cf=all&ned=us&hl=en&output=rss',
		'http://feeds.reuters.com/reuters/politicsNews',
		'http://online.wsj.com/xml/rss/3_7087.xml',
		'http://www.nytimes.com/services/xml/rss/nyt/Politics.xml',
		'http://feeds.reuters.com/reuters/technologyNews',
		'http://online.wsj.com/xml/rss/3_7455.xml',
		'http://feeds.nytimes.com/nyt/rss/Technology',
		'http://news.google.com/news?pz=1&cf=all&ned=us&hl=en&topic=t&output=rss',
	));
	$feed->set_stupidly_fast(true);
	$feed->set_item_limit(5);
	$feed->set_cache_location('./cache');
	$feed->enable_order_by_date(true);
	$feed->init();

	$feed->handle_content_type();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mini &lt; Feed Digest | NeoMelonas.com</title>
	<link rel="stylesheet" type="text/css" href="/lib/css/newstyle.css" />
	<link rel="shortcut icon" href="/lib/img/favicon.ico" type="image/x-icon" /><!-- Favicon /-->
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>
	<body>
		<div id="container">
			<div id="header">
				<ul>
					<li><h1>Mini Feed Digest</h1></li>
				</ul>
				<hr />
			</div>
			<div id="body">
				<section class="news">
					<?php
					foreach ($feed->get_items() as $item)									
					{
						$feeds = $item->get_feed();
						echo '<article><a href="'. $item->get_permalink() .'">'. $item->get_title() .'</a></article>';
					}
					?>
				</section>
			</div>
			<div id="footer">
				<p>This page is powered by <a href="http://simplepie.org/">SimplePie</a>.  Designed by <a href="http://neomelonas.com/">Neo Melonas</a> &copy;2009.</p>
			</div>
		</div>
	</body>
</html>