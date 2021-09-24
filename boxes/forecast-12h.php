<h2>12 hrs forecast</h2>
<div class="forecast-12hrs">
	
	<?php
	$city="45.487712,9.156255";
	$appid="fa6e88ee0496634a39f0843f3406ffcf";
	// https://api.darksky.net/forecast/fa6e88ee0496634a39f0843f3406ffcf/45.487712,9.156255?units=ca&exclude=minutely,hourly,daily,alerts,flags
	$url="https://api.darksky.net/forecast/".$appid."/".$city."?units=ca&exclude=currently,minutely,alerts,flags";

	$json=file_get_contents($url);
	$data=json_decode($json,true);

	$data_hourly = $data['hourly']['data'];
	$data_daily = $data['daily']['data'];

	//var_dump($data_daily);
	//die();

	$hourcount = 1;
	foreach ($data_hourly as $key => $hour) {
		if ($key % 3 == 0 && ($key > 0 && $key < 13)) {
			// temp calc
			$temp = round($hour['temperature']);
			// hour calc
			$epoch = $hour['time'];
			$dt = new DateTime("@$epoch");
			$curhour = $dt->format('H:i');
			// weather desc
			$weather_desc = $hour['summary'];
			// rain % calc
			$pop = $hour['precipProbability']*100;
			// icon
			$icon = 'wi-forecast-io-'.$hour['icon'];
			?>
			<ul class="forecast-hour">
				<li class="fhour-time"><?php echo $curhour; ?></li>
				<li class="fhour-temp"><?php echo "<i class=\"wi ".$icon."\"></i>"; ?><?php echo $temp; ?></li>
				<li class="fhour-desc"><?php echo $weather_desc; ?></li>
				<li class="fhour-rain"><small> <?php echo $pop; ?>%</small></li>
			</ul>
		<?php
		}
	}

	?>
</div>
