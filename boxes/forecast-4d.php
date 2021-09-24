<?php
include('../credentials.php');

$url="https://api.darksky.net/forecast/".$appid."/".$city."?units=ca&exclude=minutely,hourly,alerts,flags";
$json=file_get_contents($url);
$data=json_decode($json,true);
//var_dump($data['daily']);
$data_daily=$data['daily']['data'];
$time = getdate();
// echo $time['hours'].'ddd';
if ( $time['hours'] < 7 || $time['hours'] > 20 ) {
	$nightday='night';
} else {
	$nightday='day';
}
?>

<div class="forecast-4day">
	<?php
	//print_r($data_daily);
	foreach ($data_daily as $key => $day) {
	if ($key>1 && $key<=5): ?>
		<ul class="forecast-singleday">
			<?php
			// hour calc
			$epoch = $day['time'];
			$dt = new DateTime("@$epoch");
			$curday = $dt->format('D, j M');
			// weather desc
			$weather_desc = $day['summary'];
			// rain % calc
			$pop = $day['precipProbability']*100;
			// icon
			$icon = 'wi-forecast-io-'.$day['icon'];
			?>
			<li class="fday-date"><?php echo $curday; ?></li>
			<li class="fday-icon"><span><?php echo floor($day["temperatureHigh"]) ?>&deg; | <?php echo floor($day["temperatureMin"]) ?>&deg;</span><i class="wi <?php echo $icon ?>"></i><small><?php echo $pop; ?>%</small></li>
			<li class="fday-desc"><?php echo $weather_desc ?></li>
			<li class="fday-pop"></li>
			
		</ul>
	<?php
	endif;
	}
	?>
</div>