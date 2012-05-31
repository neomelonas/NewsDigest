<?php
  include_once("lib/simplepie/SimplePieAutoloader.php");

    $newsfeed = new SimplePie();

    $newsfeed->set_feed_url(array(
	'http://news.google.com/news?ned=us&hl=en&output=rss',
	'http://feeds.reuters.com/reuters/technologyNews',
	'http://feeds.reuters.com/reuters/politicsNews',
	'http://www.fool.com/feeds/index.aspx?id=foolwatch&format=rss2',
	'http://online.wsj.com/xml/rss/3_7455.xml'
    ));
    //enable caching
    $newsfeed->enable_cache(true);
    //complete path for caching system
    $newsfeed->set_cache_location('/cache');
    //set the amount of seconds you want to cache the feed
    $newsfeed->set_cache_duration(1500);
    //init the process
    $newsfeed->init();
    //let simplepie handle the content type (atom, RSS...)
    $newsfeed->handle_content_type();
    $newsfeed->strip_htmltags;
?><!doctype html>
<html>
    <head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="UTF-8"/>
	<title>the news</title>
	<link rel="stylesheet" href="<?php autoVer('/css/reset.css'); ?>" type="text/css" />

    </head>
    <body>
	<section id="theNews">
	<?php foreach($newsfeed->get_items() as $item){ $feed = $item->get_feed(); ?>
	    <article>
		<header>
		    <h1><img src="<?php $feed->get_favicon(); ?>" alt="<?php echo $feed->get_title(); ?> favicon"/><a href="<?php echo $feed->get_permalink(); ?>"><?php echo $feed->get_title(); ?></a></h1>
		    <h2>Posted <span class="adate"><?php echo $item->get_date('c'); ?></span></h2>
		</header>
		<p><?php echo $item->get_description(); ?></p>
		<footer><p><?php echo $feed->get_author(); ?></p></footer>
	    </article>
	    <?php } ?>
	</section>
    </body>
</html>
