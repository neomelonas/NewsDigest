<?php
	error_reporting(0);
	require_once ('/home/digest/lib/php/simplepie.inc');
	require_once ('/home/digest/lib/php/Sparkline_Line.php');
	include_once ('/home/digest/lib/php/functions.php');

	$newsType	= $_GET['type'];
	$memdebugz 	= $_GET['debug'];

	if ($newsType == 'business')
	{
	// Business
	//	include ('/home/digest/lib/feeds/business') > $feedlist;
		$feed = new SimplePie();
		$feed->set_feed_url(array(
			'http://feeds.reuters.com/reuters/businessNews',
			'http://online.wsj.com/xml/rss/3_7014.xml',
			'http://feeds.nytimes.com/nyt/rss/Business',
			'http://rss.cnn.com/rss/money_latest.rss',
			'http://www.forbes.com/markets/index.xml',
			'http://www.fool.com/feeds/index.aspx?id=foolwatch&format=rss2',
			'http://www.businessweek.com/rss/investor.rss',
			'http://news.google.com/news?pz=1&cf=all&ned=us&hl=en&topic=b&output=rss'
		));
		$feed->set_stupidly_fast(true);
		$feed->set_item_limit(5);
		$feed->set_cache_location('./cache');
		$feed->enable_order_by_date(true);
		$feed->init();
		$plug = 'Business';
	}
	else if ($newsType == 'tech')
	{
	// Technology
	//	include ('/home/digest/lib/feeds/tech') > $feedlist;
		$feed = new SimplePie();
		$feed->set_feed_url(array(
			'http://feeds.reuters.com/reuters/technologyNews',
			'http://online.wsj.com/xml/rss/3_7455.xml',
			'http://feeds.nytimes.com/nyt/rss/Technology',
			'http://news.google.com/news?pz=1&cf=all&ned=us&hl=en&topic=t&output=rss',
			'http://rss.slashdot.org/Slashdot/slashdot',
			'http://news.cnet.com/',
			'http://www.forbes.com/technology/index.xml'
		));
		$feed->set_cache_location('./cache');
		$feed->set_stupidly_fast(true);
		$feed->enable_order_by_date(true);
		$feed->init();
		$plug = 'Technology';
	}
	else if ($newsType == 'politics')
	{
	// Politics
	//	include ('/home/digest/lib/feeds/politics') > $feedlist;
		$feed = new SimplePie();
		$feed->set_feed_url(array(
			'http://feeds.reuters.com/reuters/politicsNews',
			'http://online.wsj.com/xml/rss/3_7087.xml',
			'http://www.nytimes.com/services/xml/rss/nyt/Politics.xml',
			'http://www.politico.com/rss/politicopicks.xml',
			'http://feeds.feedburner.com/talking-points-memo?format=xml'
		));
		$feed->set_cache_location('./cache');
		$feed->set_stupidly_fast(true);
		$feed->enable_order_by_date(true);
		$feed->init();
		$plug = 'Politics';
	}
	else if ($newsType == 'sports')
	{
	// Sports
	//	include ('/home/digest/lib/feeds/sports') > $feedlist;
		$feed = new SimplePie();
		$feed->set_feed_url(array(
			'http://sports.espn.go.com/espn/rss/news',
			'http://rss.cnn.com/rss/si_topstories.rss',
			'http://news.google.com/news?pz=1&cf=all&ned=us&hl=en&topic=s&output=rss'
		));
		$feed->set_cache_location('./cache');
                $feed->set_stupidly_fast(true);
                $feed->enable_order_by_date(true);
                $feed->init();
                $plug = 'Sports';	
	}
	else 
	{
	// Regular News
	//	include ('/home/digest/lib/feeds/news') > $feedlist;
		$feed = new SimplePie();
		$feed->set_feed_url(array(
			'http://feeds.reuters.com/reuters/topNews',
			'http://rss.cnn.com/rss/cnn_topstories.rss',
			'http://online.wsj.com/xml/rss/3_7011.xml',
			'http://www.businessweek.com/rss/bwdaily.rss',
			'http://www.nytimes.com/services/xml/rss/nyt/HomePage.xml',
			'http://feeds.huffingtonpost.com/huffingtonpost/raw_feed',
			'http://news.google.com/news?pz=1&cf=all&ned=us&hl=en&output=rss'
		));
		$feed->set_cache_location('./cache');
		$feed->set_stupidly_fast(true);
		$feed->enable_order_by_date(true);
		$feed->init();
		$plug = 'News';
	}

	$feed->handle_content_type();

	$stock1 = '^DJI';
	$sname1	= 'Dow Jones';
	$stock2	= '^IXIC';
	$sname2	= 'NASDAQ';
	$stock3	= '^GSPC';
	$sname3	= 'S&amp;P 500';

	//sparkLineStock($stock1,$sname);


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
					<ul>
						<li><?php sparkLineStock($stock1, $sname1); ?> &nbsp; <span class="charts"><?php echo $sname1; ?></span></li>
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
						echo '<p>'. $item->get_date().'</p></article>';
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
