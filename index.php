<?php
  include_once("lib/simplepie/SimplePieAutoloader.php");

    $newsfeed = new SimplePie();

    $newsfeed->set_feed_url(array(
	'http://feeds.reuters.com/reuters/technologyNews',
	'http://feeds.reuters.com/reuters/politicsNews',
	'http://www.fool.com/feeds/index.aspx?id=foolwatch&format=rss2',
	'http://online.wsj.com/xml/rss/3_7455.xml',
        'http://cacm.acm.org/blogs/blog-cacm.rss',
    ));
    //enable caching
    $newsfeed->enable_cache(true);
    //complete path for caching system
    $newsfeed->set_cache_location('./cache');
    //set the amount of seconds you want to cache the feed
    $newsfeed->set_cache_duration(1500);
    $newsfeed->set_item_limit(15);
    //init the process
    $newsfeed->init();
    //let simplepie handle the content type (atom, RSS...)
    $newsfeed->handle_content_type();
    $newsfeed->strip_htmltags(array_merge($newsfeed->strip_htmltags, array('div','img','a')));
?><!doctype html>
<html>
    <head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="UTF-8"/>
	<title>the news</title>
	<link rel="stylesheet" href="css/reset.css" type="text/css" />
	<link rel="stylesheet" href="digest.css" type="text/css" />
        <script src="js/moment.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    </head>
    <body>
        <script> document.write(moment().format('dddd, MMMM Do YYYY, h:mm:ss a')); </script>
	<section id="theNews">
	<?php $i=1; foreach($newsfeed->get_items() as $item){ $feed = $item->get_feed(); ?>
	    <article class="article-<?php echo $i; ?>">
		<header>
		    <h1><a href="<?php echo $item->get_permalink(); ?>" title="<?php echo $item->get_description(); ?>"><?php echo $item->get_title(); ?></a></h1>
		</header>
		<footer>
                    <p>
                        Posted <span class="when" title="<?php echo $item->get_date('Y-m-d h:i a'); ?>"><script>document.write(moment("<?php echo $item->get_date('Y-m-d H:i:s'); ?>","YYYY-MM-DD HH:mm:ss").fromNow());</script></span> to <a href="<?php  echo $feed->get_permalink(); ?>"><?php echo $feed->get_title(); ?></a>
                    </p>
                </footer>
		<p class="contents" id="content-<?php echo $i; ?>"><?php echo $item->get_content(); ?></p>
	    </article>
	    <?php $i++; } ?>
	</section>
    <!--<script>
        $("header a").click(function(e) {e.preventDefault();$("p .content").toggle();});
    </script>
    /-->
    </body>
</html>
