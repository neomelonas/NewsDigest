<?php
    require __DIR__ . '/vendor/autoload.php';
    $newsfeed = new SimplePie();
    $newsfeed->set_feed_url(array(
	'http://feeds.reuters.com/reuters/technologyNews',
	'http://feeds.reuters.com/reuters/politicsNews',
	'http://www.fool.com/feeds/index.aspx?id=foolwatch&format=rss2',
	'http://online.wsj.com/xml/rss/3_7455.xml',
    'http://www.theverge.com/rss/index.xml',
    'http://www.aljazeera.com/Services/Rss/?PostingId=2007731105943979989',
    'https://news.ycombinator.com/rss',
    'https://www.schneier.com/blog/atom.xml',
    'http://blog.erratasec.com/feeds/posts/default',
    'http://feeds.feedburner.com/WebrootThreatBlog?format=xml',
    'http://feeds.feedburner.com/darknethackers',
    'http://carnal0wnage.attackresearch.com/feeds/posts/default',
    'http://www.social-engineer.org/feed',
    'https://nakedsecurity.sophos.com/feed',
    'http://www.computerweekly.com/blogs/david_lacey/atom.xml',
    'http://www.darkreading.com/rss_simple.asp',
    'http://www.techrepublic.com/rssfeeds/topic/security/',
    'http://www.wired.com/category/threatlevel/feed/',
    'http://arstechnica.com/feed/',
    'http://krebsonsecurity.com/feed/',
    ));
    //enable caching
    $newsfeed->enable_cache(true);
    //complete path for caching system
    $newsfeed->set_cache_location('./.cache');
    //set the amount of seconds you want to cache the feed
    $newsfeed->set_cache_duration(1800);
    $newsfeed->set_item_limit(60);
    //init the process
    $newsfeed->init();
    $newsfeed->handle_content_type();
    $newsfeed->strip_htmltags(array_merge($newsfeed->strip_htmltags, array('div','img','a')));
    $j=2;
    function remove_http($url) {
        $disallowed = array('http://', 'https://');
        foreach($disallowed as $d) {
            if(strpos($url, $d) === 0) {
                return str_replace($d, '', $url); }}
        return $url;
    }
    $urlremoval = array('.','default.html','/');
?><!doctype html>
<html lang="en">
    <head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="UTF-8"/>
    <title>the news</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<!--    <link rel="stylesheet" href="css/reset.min.css" type="text/css" />/-->
    <link rel=stylesheet href=//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css type=text/css />
    <link rel="stylesheet" href="css/news.min.css" type="text/css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment.min.js"></script>
    </head>
    <body>
        <section id="theNews">
            <div>
    	<?php $i=1; foreach($newsfeed->get_items() as $item){ $feed = $item->get_feed(); ?>
    <article id="article-<?php echo $i; ?>" class="article <?php echo str_replace($urlremoval, '', remove_http($item->get_base())); ?>">
                <span class="article-image"></span>
                <header>
                    <a href="<?php echo $item->get_permalink(); ?>" title="<?php echo $item->get_date('Y-m-d H:i:s'); ?>"><?php echo $item->get_title(); ?></a>
        		</header>
                <footer id="article-<?php echo $i; ?>-meta">
                    Posted <span class="when" title="<?php echo $item->get_date('Y-m-d h:i a'); ?>"><script>document.write(moment("<?php echo $item->get_date('Y-m-d H:i:s'); ?>","YYYY-MM-DD HH:mm:ss").fromNow());</script></span> to <a href="<?php  echo $feed->get_permalink(); ?>"><?php echo $feed->get_title(); ?></a>
            </footer>
        </article>
    <?php $i++; } ?>
        </div>
	</section>
    </body>
</html>
