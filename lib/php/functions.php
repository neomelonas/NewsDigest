<?php
date_default_timezone_set('America/New_York');

function sparkLineStock($stock,$sname)
{
	/*
	 * Sparkline PHP Graphing Library
	 * Copyright 2004 James Byers <jbyers@users.sf.net>
	 * http://sparkline.org
	 *
	 * Sparkline is distributed under a BSD License.  See LICENSE for details.
	 *
	 * $Id: stock_chart2.php,v 1.2 2004/11/19 07:16:03 jbyers Exp $
	 *
	 * stock_chart2 adds min/max price bounds and an endpoint value label to
	 * stock_chart
	 *              
	 * layout inspired by Mariano Belinky's SVG sparklines:
	 * http://www.interactiva.com.ar/mariano/?pname=sparklines
	 *
	 */
	
	//////////////////////////////////////////////////////////////////////////////
	// verify parameters; bad form, but die to text error on failure
	//
	if (!isset($stock))
	{ die('bad ticker ' . $stock); }
	$year = 5;

	//////////////////////////////////////////////////////////////////////////////
	// load and process data from Yahoo! ichart csv source
	//
	$m  = date('n') - 1;
	$d  = date('d');
	$y2 = date('Y');
	$y1 = $y2 - $year;
	
	// data sample:
	//   0        1     2     3     4     5        6
	//   Date,Open,High,Low,Close,Volume,Adj. Close*
	//   5-Nov-04,29.21,29.36,29.03,29.31,95337696,29.31
	//
	// $url = "http://www.google.com/finance/historical?q=" . $stock . "&startdate=$m+$d+$y2&enddate=$m+$d+$y1&output=csv";
	$url = "http://ichart.finance.yahoo.com/table.csv?s=" . $stock . "&a=$m&b=$d&c=$y1&d=$m&e=$d&f=$y2&g=d&ignore=.csv";
	if (!$data = @file($url)) {
	  die('error fetching stock data; verify ticker symbol');
	}
	
	//////////////////////////////////////////////////////////////////////////////
	// build sparkline using standard flow:
	//   construct, set, render, output
	//
	//require_once('../lib/Sparkline_Line.php');
	
	$sparkline = new Sparkline_Line();
	$sparkline->SetDebugLevel(DEBUG_NONE);
	//$sparkline->SetDebugLevel(DEBUG_ERROR | DEBUG_WARNING | DEBUG_STATS | DEBUG_CALLS, '../log.txt');
	
	if (isset($_GET['b'])) {
	  $sparkline->SetColorHtml('background', $_GET['b']);
	  $sparkline->SetColorBackground('background');
	}
	
	$sparkline->SetColorHtml('background','fcfcfc');
	$sparkline->SetColorBackground('background');


	$data = array_reverse($data);
	$i = 0;
	$min  = null;
	$max  = null;
	$last = null;
	while (list(, $v) = each($data)) {
	  $elements = explode(',', $v);
	  $value    = @trim($elements[6]);
	
	  if (ereg('^[0-9\.]+$', $value)) {
	
	    $sparkline->SetData($i, $value);
	
	    if (null == $max ||
	        $value >= $max[1]) {
	      $max = array($i, $value);
	    }
	
	    if (null == $min ||
	        $value <= $min[1]) {
	      $min = array($i, $value);
	    }
	
	    $last = array($i, $value);
	
	    $i++;
	  }
	}
	
	// set y-bound, min and max extent lines
	//
	$sparkline->SetYMin(0);
	$sparkline->SetPadding(2); // setpadding is additive
	$sparkline->SetPadding(imagefontheight(FONT_2), 
	                       imagefontwidth(FONT_2) * strlen(" $last[1]"), 
	                       0, //imagefontheight(FONT_2), 
	                       0);
	$sparkline->SetFeaturePoint($min[0],  $min[1],  'red',   2, $min[1],     TEXT_TOP,    FONT_2);
	$sparkline->SetFeaturePoint($max[0],  $max[1],  'green', 2, $max[1],     TEXT_TOP,    FONT_2);
	$sparkline->SetFeaturePoint($last[0], $last[1], 'blue',  3, " $last[1]", TEXT_RIGHT,  FONT_2);
	
	if (isset($_GET['m']) &&
	    $_GET['m'] == '0') {
	  $sparkline->Render(200, 50);
	} else {
	  $sparkline->SetLineSize(3); // for renderresampled, linesize is on virtual image
	  $sparkline->RenderResampled(200, 40);
	}

	$filename = $sname.".png";

echo '<img src="'.$sparkline->OutputToDataURI().'"/>';
//	$sparkline->Output($filename);
}// END sparkLineStock

function populateFeeds($newsType, $feed)
{
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
}


function echo_memory_usage($memdebugz) 
{
	if ($memdebugz == 1)
	{
		$mem_usage = memory_get_usage(true);
        	if ($mem_usage < 1024)
        	{ echo $mem_usage." B"; }
        	elseif ($mem_usage < 1048576)
        	{ echo round($mem_usage/1024,2)." KB"; }
        	else
        	{ echo round($mem_usage/1048576,2)." MB"; }
	}
}// END memory_get_usage
?>