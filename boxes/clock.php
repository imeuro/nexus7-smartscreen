<?php
// time&date
date_default_timezone_set('Europe/Rome');
$time = getdate();
if ( $time['hours'] < 10 )
	$time['hours'] = '0'.$time['hours'];
if ( $time['minutes'] < 10 )
	$time['minutes'] = '0'.$time['minutes'];
echo "<h2 class=\"time\"><span>".$time['hours']."</span>:".$time['minutes']."</h2>";
echo '<p class="date">'.$time['weekday'].', '.$time['mday'].' '.$time['month'].' '.$time['year'].'</p>';
?>
