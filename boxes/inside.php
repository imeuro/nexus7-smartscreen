<?php
$filepath = "../logs/home_readings.json";
$jsonString = file_get_contents($filepath);
$data = json_decode($jsonString, true);
$temperature = round($data['aqara_inside']['temperature'],1);
$temperature2 = round($data['aqara_giorgia']['temperature'],1)-0.5;
$temperature = str_replace('.', '</span><span class="tdecimal">.', $temperature);
$temperature2 = str_replace('.', '</span><span class="tdecimal">.', $temperature2);
$humidity = round($data['aqara_inside']['humidity'],1);
$humidity2 = round($data['aqara_giorgia']['humidity'],1);
$tempa2lert= ($temperature2 < $temperature-2 || $temperature2 > $temperature+2) ? " warning" : " ok";
$humialert= ($humidity < 30 || $humidity > 60) ? " warning" : " ok";
?>


<div class="room1-container">
	<div class="gauge-container temp-gauge">
		<i class="wi wi-thermometer"></i>
		<canvas width="270" height="250" id="in_TEMPERATURE" class="gauge"></canvas>
		<span id="in_temp_val" data-type="Main Room Temperature" data-scale="°C"><span class="tval"><?php echo $temperature; ?></span></span>
	</div>
</div>

<!--
<div class="room2-container">
	<h2 class="humi">GIORGIA</h2>
	<p class="humi">
		<?php //echo $temperature2; ?> <i class="wi wi-thermometer<?php //echo $tempa2lert ?>"></i>
	</p>
</div>
-->

<div class="humi-container">
	<h2 class="humi">Humidity</h2>
	<p class="humi" data-humi="<?php echo $humidity; ?>">
		<?php echo $humidity; ?> <i class="wi wi-humidity<?php echo $humialert ?>"></i>
	</p>
</div>