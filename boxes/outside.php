<?php
$city="45.487712,9.156255";
$appid="fa6e88ee0496634a39f0843f3406ffcf";
// https://api.darksky.net/forecast/fa6e88ee0496634a39f0843f3406ffcf/45.487712,9.156255?units=ca&exclude=minutely,hourly,daily,alerts,flags
$url="https://api.darksky.net/forecast/".$appid."/".$city."?units=ca&exclude=minutely,hourly,daily,alerts,flags";
$json=file_get_contents($url);
$data=json_decode($json,true);
// var_dump($data['currently']);
$DSdata=$data['currently'];
$time = getdate();
// echo $time['hours'].'ddd';
if ( $time['hours'] < 7 || $time['hours'] > 20 ) {
	$nightday='night';
} else {
	$nightday='day';
}

$filepath = "../logs/home_readings.json";
$jsonString = file_get_contents($filepath);
$data = json_decode($jsonString, true);
$temperature = round($data['aqara_outside']['temperature'],1);
$temperature = str_replace('.', '</span><span class="tdecimal">.', $temperature);
$battery = $data['aqara_outside']['battery'];
?>
<div class="gauge-container small-gauge temp-gauge">
	<i class="wi wi-forecast-io-<?php echo $DSdata['icon']; ?>"></i>
	<canvas width="140" height="120" id="out_TEMPERATURE" class="gauge"></canvas>
	<span id="out_temp_val" data-type="<?php echo $DSdata['summary']; ?>" data-scale="°C"><span class="tval"><?php echo $temperature; ?></span></span>
	<small class="aqara-batt">batt. <?php echo $battery; ?>%</small>
</div>