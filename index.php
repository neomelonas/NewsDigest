<?php
  include_once("lib/simplepie/SimplePieAutoloader.php");

    $newsfeed = new SimplePie();

    $newsfeed->set_feed_url(array(
	'http://feeds.reuters.com/reuters/technologyNews',
	'http://feeds.reuters.com/reuters/politicsNews',
	'http://www.fool.com/feeds/index.aspx?id=foolwatch&format=rss2',
	'http://online.wsj.com/xml/rss/3_7455.xml',
    'http://www.theverge.com/rss/index.xml',
    'http://feeds.arstechnica.com/arstechnica/index',
    ));
    //enable caching
    $newsfeed->enable_cache(true);
    //complete path for caching system
    $newsfeed->set_cache_location('./cache');
    //set the amount of seconds you want to cache the feed
    $newsfeed->set_cache_duration(1500);
    $newsfeed->set_item_limit(50);
    //init the process
    $newsfeed->init();
    //let simplepie handle the content type (atom, RSS...)
    $newsfeed->handle_content_type();
    $newsfeed->strip_htmltags(array_merge($newsfeed->strip_htmltags, array('div','img','a')));
    $j=2;
?><!doctype html>
<html>
    <head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="UTF-8"/>
	<title>the news</title>
	<link rel="stylesheet" href="css/reset.css" type="text/css" />
	<link rel="stylesheet" href="css/digest.css" type="text/css" />
        <script src="js/moment.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    </head>
    <body>
        <div id="rightNow">It is <span class="clock">&nbsp;</span>.</div>
        <section id="theNews">
            <div id="col1" class="cols">
    	<?php $i=1; foreach($newsfeed->get_items() as $item){ $feed = $item->get_feed(); ?>
	        <article class="article-<?php echo $i; ?>">
	        <header>
	            <h1><a href="<?php echo $item->get_permalink(); ?>" title="<?php
        	        $cont = $item->get_title();
                	echo $cont;
            ?>"><?php echo $item->get_title(); ?></a></h1>
    		</header>
	    	<footer>
                <p>
                    Posted <span class="when" title="<?php echo $item->get_date('Y-m-d h:i a'); ?>"><script>document.write(moment("<?php echo $item->get_date('Y-m-d H:i:s'); ?>","YYYY-MM-DD HH:mm:ss").fromNow());</script></span> to <a href="<?php  echo $feed->get_permalink(); ?>"><?php echo $feed->get_title(); ?></a>
                </p>
            </footer>
        </article>
        <?php
            if ($i % 50 == 0) { echo '</div><div id="col'.$j.'" class="cols">'; $j++; }
            $i++; }
        ?>
        </div>
	</section>
        <script>$(document).ready( function() { $('span.clock').replaceWith(moment().format('dddd, MMMM Do YYYY, h:mm:ss a'))});</script>
    </body>
</html>
