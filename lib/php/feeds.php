<?php
	if ($newsType == 'business')
	{
	// Business
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
		$feed->set_cache_duration(900);
//		$feed->strip_htmltags(array_merge($feed->strip_htmltags, array('center'));
		$feed->strip_attributes(array_merge($feed->strip_attributes, array('border')));
		$feed->enable_order_by_date(true);
		$feed->init();
		$plug = 'Business';
	}
	else if ($newsType == 'tech')
	{
	// Technology
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
		$feed->set_stupidly_fast(true);
		$feed->set_cache_location('./cache');
		$feed->set_cache_duration(900);
//		$feed->strip_htmltags(array_merge($feed->strip_htmltags, array('center'));
		$feed->strip_attributes(array_merge($feed->strip_attributes, array('border')));
		$feed->enable_order_by_date(true);
		$feed->init();
		$plug = 'Technology';
	}
	else if ($newsType == 'politics')
	{
	// Politics
		$feed = new SimplePie();
		$feed->set_feed_url(array(
			'http://feeds.reuters.com/reuters/politicsNews',
			'http://online.wsj.com/xml/rss/3_7087.xml',
			'http://www.nytimes.com/services/xml/rss/nyt/Politics.xml',
			'http://www.politico.com/rss/politicopicks.xml',
			'http://feeds.feedburner.com/talking-points-memo?format=xml'
		));
		$feed->set_stupidly_fast(true);
		$feed->set_cache_location('./cache');
		$feed->set_cache_duration(900);
//		$feed->strip_htmltags(array_merge($feed->strip_htmltags, array('center'));
		$feed->strip_attributes(array_merge($feed->strip_attributes, array('border')));
		$feed->enable_order_by_date(true);
		$feed->init();
		$plug = 'Politics';
	}
	else if ($newsType == 'sports')
	{
	// Sports
		$feed = new SimplePie();
		$feed->set_feed_url(array(
			'http://sports.espn.go.com/espn/rss/news',
			'http://rss.cnn.com/rss/si_topstories.rss',
			'http://news.google.com/news?pz=1&cf=all&ned=us&hl=en&topic=s&output=rss'
		));
		$feed->set_stupidly_fast(true);
		$feed->set_cache_location('./cache');
		$feed->set_cache_duration(900);
//		$feed->strip_htmltags(array_merge($feed->strip_htmltags, array('center'));
		$feed->strip_attributes(array_merge($feed->strip_attributes, array('border')));
		$feed->enable_order_by_date(true);
		$feed->init();
		$plug = 'Sports';	
	}
	else 
	{
	// Regular News
		$feed = new SimplePie();
		$feed->set_feed_url(array(
			'http://feeds.reuters.com/reuters/topNews',
			'http://rss.cnn.com/rss/cnn_topstories.rss',
			'http://online.wsj.com/xml/rss/3_7011.xml',
			'http://www.businessweek.com/rss/bwdaily.rss',
			'http://www.nytimes.com/services/xml/rss/nyt/HomePage.xml',
//			'http://feeds.huffingtonpost.com/huffingtonpost/raw_feed',
			'http://news.google.com/news?pz=1&cf=all&ned=us&hl=en&output=rss'
		));
		$feed->set_stupidly_fast(true);
		$feed->set_cache_location('./cache');
		$feed->set_cache_duration(900);
//		$feed->strip_htmltags(array_merge($feed->strip_htmltags, array('center'));
		$feed->strip_attributes(array_merge($feed->strip_attributes, array('border')));
		$feed->enable_order_by_date(true);
		$feed->init();
		$plug = 'News';
	}
	$feed->handle_content_type();
?>
