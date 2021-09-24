<!DOCTYPE html>
<html>
  <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Pizero Display Panel</title>
		<link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c:300,700|Fira+Sans+Extra+Condensed:200,400,700" rel="stylesheet">
		<link href="css/weather-icons.min.css" rel="stylesheet" type="text/css">
		<link href="css/v3.css" rel="stylesheet" type="text/css">
	</head>
  <body>
		<div id="pagecontent">
			<div id="sidebar">
				<div id="timecontainer"></div>
				<div id="insidetempcontainer"></div>
			</div>

			<div id="main">
				<div id="calcontainer"></div>

				<div id="covidcontainer">
					<?php include('./boxes/covid-19-light.php'); ?>
					<div id="menucontainer"></div>
				</div>

				<!-- <div id="covidcontainer"><?php // include('./boxes/covid-19.php'); ?></div> -->
				<div id="forecast12hcontainer"></div>
			</div>

			<div id="tabs">
				<div id="reload" class="rotate">
					<img src="img/refresh.svg" />
				</div>
				<div id="forecast4dcontainer"></div>
				<div id="outsidetempcontainer"></div>
			</div>


		</div>

		<script type="text/javascript" src="logs/home_readings.json"></script>
		<script type="text/javascript" src="js/gauge.min.js"></script>
		<script async defer src="https://apis.google.com/js/api.js"></script>
		<script type="text/javascript" src="js/v3.js"></script>
	</body>
</html>
