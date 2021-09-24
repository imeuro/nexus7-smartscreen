<h2>outside</h2>
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

// Temp/Baro: source data from aqara sensor (if it works... otherwise from the www)
// $filepath = "/home/pi/www_root/pizero-weather/logs/home_readings.json";
$filepath = "../logs/home_readings.json";
$jsonString = file_get_contents($filepath);
$data = json_decode($jsonString, true);
$TS_out = $data['aqara_out']['time'];
$temp_out = $data['aqara_out']['temperature'];
$humi_out = $data['aqara_out']['humidity'];

$TS_now = date("d-m-Y H:i");
$dateTimestamp1 = strtotime($TS_out);
$dateTimestamp2 = strtotime($TS_now);

// print_r($TS_out);
// print_r($TS_now);

$source = "Batt: ".$data['aqara_out']['battery']."%";
if (($dateTimestamp2-(3 * 3600000)) > $dateTimestamp1) { // it's rotto since 3 ore. switch to www
	$source = 'www';
	$temp_out = $DSdata['temperature'];
	$humi_out = $DSdata['humidity']*100;
}
// print_r($source);
echo "<span class='source'>".$source."</span>";
echo "<div id='out' data-temp='$temp_out'>".number_format($temp_out, 1, '.', '')."&deg; <i class=\"wi wi-forecast-io-".$DSdata['icon']."\"></i>";
echo "<small>".$DSdata['summary']."</small>";
echo "</div>";
echo "<ul>";
//echo "<li><strong>Pressure: </strong><span>".round($DSdata['pressure'])."mbar</span></li>";
echo "<li><strong>Press: </strong><span>".$DSdata['pressure']."mbar</span></li>";
echo "<li><strong>Humi: </strong><span>".round($humi_out)."%</span></li>";
echo "<li><strong>Visib: </strong><span>".round($DSdata['visibility'])."km</span></li>";
echo "<li><strong>Clouds: </strong><span>".($DSdata['cloudCover']*100)."%</span></li>";
echo "<li><strong>Wind: </strong><span>".$DSdata['windSpeed']."km/h</span></li>";
echo "</ul>";
?>
