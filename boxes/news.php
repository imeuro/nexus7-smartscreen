<h2>news</h2>
<?php
$myXMLData = file_get_contents('http://www.repubblica.it/rss/homepage/rss2.0.xml');
// $myXMLData = file_get_contents('http://feeds.ilpost.it/ilpost?format=xml');

$xml=simplexml_load_string($myXMLData) or die("Error: Cannot create object");
$news_item = $xml->channel->item;
// print_r($news_item);
echo "<ul>";
$i = 1;
foreach ($news_item as $news) {
	if ($i <= 4) :
		echo '<li><span>'.$news->title.'</span></li>';
		$i++;
	endif;
}
echo "</ul>";
?>
