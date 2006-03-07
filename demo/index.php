<?php
// Start counting time for loading...
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];

include('../simplepie.inc');

// Parse it
$feed = new SimplePie();
if (!empty($_GET['feed'])) {
	$feed->feed_url($_GET['feed']);
	if (isset($_GET['xmldump'])) {
		$feed->enable_xmldump($_GET['xmldump']);
	}
	$feed->init();
	if (!headers_sent() && $feed->get_encoding()) {
		header('Content-type: text/html; charset=' . $feed->get_encoding());
	}
}
else if (!empty($_GET['i'])) {
	$feed->display_image($_GET['i']);
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>SimplePie: Demo</title>

<link rel="stylesheet" href="./for_the_demo/simplepie.css" media="screen, projector" />
<script type="text/javascript" src="./for_the_demo/sifr.js"></script>
<script type="text/javascript" src="./for_the_demo/sleight.js"></script>

<meta http-equiv="Content-Type" content="text/html;charset=<?php echo $feed->get_encoding(); ?>" />

</head>

<body id="bodydemo">

<div id="site">

	<ul id="menu">
		<!-- Must all be on the same line due to spacing bugs. -->
		<li id="demo"><a href="index.php">Demo</a>|</li><li><a href="http://support.simplepie.org/categories.php">Bug Reports &amp; Feature Requests</a>|</li><li><a href="http://www.simplepie.org/docs/reference/">Function Reference</a>|</li><li><a href="http://www.simplepie.org/blog/">Weblog</a></li>
	</ul>


	<h1 id="logo"><a href="http://www.simplepie.org"><img src="./for_the_demo/logo_simplepie_small.png" alt="SimplePie" title="SimplePie" border="0" /></a></h1>

	<div id="content">

		<div id="" class="chunk">
			<h2 class="image"><img src="./for_the_demo/copy_get_your_demos_here.gif" alt="Demos!  Get your demos here!  Well, actually there's only one.  But you can do it over and over again." title="Demos!  Get your demos here!  Well, actually there's only one.  But you can do it over and over again." /></h2>
			<form action="" method="get" name="sp_form" id="sp_form">
				<div id="sp_input">
					<p><strong>Feed URL:</strong>&nbsp;<input type="text" name="feed" value="<?php if ($feed->subscribe_url()) echo $feed->subscribe_url(); ?>" class="text" id="feed_input" />&nbsp;<input type="submit" value="Read" class="button" /></p>
				</div>
			</form>
			<p><strong>Or try one of the following:</strong> <a href="?feed=http://rss.alexa.com/top_500.ar.xml#feed" title="Alexa Top 25 Arabic Sites">Alexa: Arabic</a>, <a href="?feed=http://rss.alexa.com/top_500.el.xml#feed" title="Alexa Top 25 Greek Sites">Alexa: Greek</a>, <a href="?feed=http://rss.alexa.com/top_500.iw.xml#feed" title="Alexa Top 25 Hebrew Sites">Alexa: Hebrew</a>, <a href="?feed=http://www.andybudd.com/index.rdf#feed" title="Andy Budd::Blogography">Andy Budd</a>, <a href="?feed=http://feeds.feedburner.com/AskANinja#feed" title="Ask A Ninja - Video Podcast">Ask A Ninja</a>, <a href="?feed=http://japan.cnet.com/rss/index.rdf#feed" title="CNet Japan (Japanese)">CNet Japan</a>, <a href="?feed=http://del.icio.us/rss/#feed" title="Most Recent De.icio.us Entries">Del.icio.us</a>, <a href="?feed=http://digg.com/rss/index.xml#feed" title="Recently Digged">Digg</a>, <a href="?feed=http://www.erased.info/rss2.php#feed" title="Russian Language Site">Erased.info</a>, <a href="?feed=http://www.flickr.com/services/feeds/photos_public.gne?format=rss2#feed" title="Awesome, Free Photo Management">Flickr</a>, <a href="?feed=http://ubb.frostyplace.com.tw/rdf.php#feed" title="Traditional Chinese Language Site">Frostyplace Taiwan</a>, <a href="?feed=http://gvod.blogspot.com/atom.xml#feed" title="Google Video of the Day">GVOD</a>, <a href="?feed=http://photocast.mac.com/jmissig/iPhoto/favorites/index.rss#feed" title="Sample Photocast from iPhoto 6">iPhoto Photocast</a>, <a href="?feed=http://blog.japan.cnet.com/lessig/index.rdf#feed" title="Another Japanese Language Site">Lessig Blog</a>, <a href="?feed=http://macnn.com/podcasts/macnn.rss#feed" title="MacNN Podcast">MacNN</a>, <a href="?feed=http://korfball.hu/rss_news.xml#feed" title="Hungarian Language Site">Magyar Korfball Sz&#246;vets&#233;g</a>, <a href="?feed=http://www.pariurisportive.com/blog/xmlsrv/rss2.php?blog=2#feed" title="Romanian Language Site">Pariuri Sportive</a>, <a href="?feed=http://www.technorati.com/watchlists/rss.html?wid=29290#feed" title="Who's talking about SimplePie?">SimplePie @ Technorati</a>, <a href="?feed=http://www.tuaw.com/rss.xml#feed" title="The Unofficial Apple Weblog">TUAW</a>, <a href="?feed=http://www.tvgasm.com/atom.xml#feed" title="What happened last night on TV's best shows?">TVgasm</a>, <a href="?feed=http://whitecollarruckus.libsyn.com/rss#feed" title="One of my favorite podcasts">White Collar Ruckus</a></p>
			<a name="feed"></a>
		</div>

		<div id="sp_results">
			<?php if ($feed->data): ?>
				<div class="chunk focus" align="center">
					<h3 class="header"><?php if ($feed->get_feed_link()) echo '<a href="' . $feed->get_feed_link() . '">'; echo $feed->get_feed_title(); if ($feed->get_feed_link()) echo '</a>'; ?></h3>
					<?php echo $feed->get_feed_description(); ?>
				</div>
				<p class="subscribe"><strong>Subscribe:</strong> <a href="<?php echo $feed->subscribe_aol(); ?>">My AOL</a>, <a href="<?php echo $feed->subscribe_bloglines(); ?>">Bloglines</a>, <a href="<?php echo $feed->subscribe_google(); ?>">Google Reader</a>, <a href="<?php echo $feed->subscribe_msn(); ?>">My MSN</a>, <a href="<?php echo $feed->subscribe_newsburst(); ?>">Newsburst</a>,<br /><a href="<?php echo $feed->subscribe_newsgator(); ?>">Newsgator</a>, <a href="<?php echo $feed->subscribe_odeo(); ?>">Odeo</a>, <a href="<?php echo $feed->subscribe_pluck(); ?>">Pluck</a>, <a href="<?php echo $feed->subscribe_podnova(); ?>">Podnova</a>, <a href="<?php echo $feed->subscribe_rojo(); ?>">Rojo</a>, <a href="<?php echo $feed->subscribe_yahoo(); ?>">My Yahoo!</a>, <a href="<?php echo $feed->subscribe_feed(); ?>">Desktop Reader</a></p>
				<?php for ($x = 0; $x < $feed->get_item_quantity(); $x++): ?>
					<div class="chunk">
						<h4><?php if ($feed->get_item_permalink($x)) echo '<a href="' . $feed->get_item_permalink($x) . '">'; echo $feed->get_item_title($x); if ($feed->get_item_permalink($x)) echo '</a>'; ?>&nbsp;<span class="footnote"><?php echo $feed->get_item_date($x, 'j M Y'); ?></span></h4>
						<?php echo $feed->get_item_description($x); ?>
						<?php
						if ($feed->get_item_enclosure($x))
							echo '<p><a href="' . $feed->get_item_enclosure($x) . '" class="download"><img src="./for_the_demo/mini_podcast.png" alt="Podcast" title="Download the Podcast" border="0" /></a></p>';
						?>
						<p class="footnote">&rarr; <a href="<?php echo $feed->add_to_delicious($x); ?>" title="Add post to del.icio.us">Del.icio.us</a> | <a href="<?php echo $feed->add_to_digg($x); ?>" title="Digg this!">Digg</a> | <a href="<?php echo $feed->add_to_furl($x); ?>" title="Add post to Furl">Furl</a> | <a href="<?php echo $feed->add_to_myweb20($x); ?>" title="Add post to My Web 2.0">My Web 2.0</a> | <a href="<?php echo $feed->add_to_newsvine($x); ?>" title="Add post to Newsvine">Newsvine</a> | <a href="<?php echo $feed->add_to_reddit($x); ?>" title="Add post to Reddit">Reddit</a> | <a href="<?php echo $feed->add_to_spurl($x); ?>" title="Add post to Spurl">Spurl</a> | <a href="<?php echo $feed->search_technorati($x); ?>" title="Who's linking to this post?">Search Technorati</a></p>
					</div>
				<?php endfor; ?>
				</div>
			<?php endif; ?>
		</div>

		<div>
			<p class="footnote">Page processed in <?php $mtime = explode(' ', microtime()); echo round($mtime[0] + $mtime[1] - $starttime, 3); ?> seconds.</p>
			<p class="footnote">SimplePie is &copy; 2004&ndash;<?php echo date('Y'); ?>, <a href="http://www.skyzyx.com">Skyzyx Technologies</a>, and licensed under the Creative Commons <a href="http://www.creativecommons.org/licenses/by-sa/2.0/">Attribution Share-Alike License 2.0</a>.</p>
			<p class="footnote">Hosted by <a href="http://www.dreamhost.com/r.cgi?skyzyx">Dreamhost</a> and powered by <a href="http://www.wordpress.org">Wordpress</a>, because they're nifty-cool, and we like them.  Syndication support handled by <?php echo $feed->linkback; ?>.</p>
		</div>

	</div>

</div>

<script type="text/javascript">
//<![CDATA[

// Rewrite image URLs to bypass hotlinking protection.
(function(){ var img = document.getElementsByTagName('img'); var imgLength = img.length; for (var x=0; x<imgLength; x++) { if (img[x].src.substring(0,4) == 'http') { if (img[x].src.indexOf('http://imageads.googleadservices.com') == -1) img[x].src = '?i=' + img[x].src; }}})();

// Load the sIFR font.
if(typeof sIFR == "function"){
	sIFR.replaceElement(named({sSelector:"h3.header", sFlashSrc:"./for_the_demo/yanone-kaffeesatz-bold.swf", sColor:"#000000", sHoverColor:"#666666", sBgColor:"#EEFFEE", sFlashVars:"textalign=center"}));
};

//]]>
</script>

</body>
</html>