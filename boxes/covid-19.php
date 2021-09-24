
<?php
$file = file_get_contents("./boxes/COVID-19/dati-json/dpc-covid19-ita-andamento-nazionale.json");
// $file = file_get_contents("./COVID-19/dati-json/dpc-covid19-ita-regioni.json");
$csv = json_decode($file, true);
// var_dump($csv);

$day = $totpos = $newpos = [];
foreach ($csv as $key => $posday) {
	// if ($posday['denominazione_regione'] == "Lombardia") {
		$curday = explode(" ", $posday['data'], 2);
		$day[] = date("d M", strtotime($curday[0]));
		$totpos[] = $posday['totale_positivi'];
		$newpos[] = $posday['variazione_totale_positivi'];
	// }
}
$day = array_slice($day, -29);
$totpos = array_slice($totpos, -29);
$newpos = array_slice($newpos, -29);
// print_r($day);
// print_r($newpos);

$curtotpos = end($totpos);
$curnewpos = end($newpos);


// trend vs yesterday:
$prevtotpos = $totpos[count($totpos)-2];
$prevnewpos = $newpos[count($newpos)-2];
function calcDelta($today, $yday)  {
	// // Delta = New Number - Original Number
	// $delta = $today - $yday;
	// // % Delta = Delta ÷ Original Number × 100
	// $percdelta = round(($delta/$yday) * 100);
	

	$percdelta = round((1 - $yday / $today) * 100, 1);

	if ($today<0 && $yday<0) $percdelta = $percdelta*-1;
	if ($percdelta > 0) $percdelta = '+'.$percdelta;

	return $percdelta;
}
?>

<div class="today">
	<h2>COVID-19 Italia <br><?php echo date("d M Y", strtotime($curday[0])); ?></h2>
	<p class="total">TOT CASES: <?php echo $curtotpos; ?> (<?php echo calcDelta($curtotpos,$prevtotpos) ?>%)</p>
	<p class="new">NEW CASES: <?php echo $curnewpos; ?> (<?php echo calcDelta($curnewpos,$prevnewpos) ?>%)</p>
</div>
<canvas id="COVID-19-chart" width="534" height="190"></canvas>
<script>
var node = window.document.createElement("script");
var src = node.setAttribute("src","https://www.chartjs.org/dist/2.9.3/Chart.min.js");
document.body.appendChild(node);

if (typeof ctx === "undefined" || typeof conf === "undefined") {

	var covidChartData = {
		labels: [<?php foreach ($day as $sday) { echo '"'.$sday.'", '; } ?>],
		datasets: [{
			//label: 'My First dataset',
			backgroundColor: 'rgba(153, 102, 255, .5)',
			borderColor: 'rgb(153, 102, 255)',
			fill: false,
			data: [<?php foreach ($newpos as $snewpos) { echo '"'.$snewpos.'", '; } ?>],
			yAxisID: 'y-axis-1',
		}, {
			//label: 'My Second dataset',
			backgroundColor: 'rgba(255, 99, 132, .5)',
			borderColor: 'rgb(255, 99, 132)',
			fill: false,
			data: [<?php foreach ($totpos as $stotpos) { echo '"'.$stotpos.'", '; } ?>],
			yAxisID: 'y-axis-2'
		}]
	};

	window.onload = function() {
	setTimeout(function() {
		var ctx = document.getElementById('COVID-19-chart');
		window.myLine = Chart.Line(ctx, {
			data: covidChartData,
			options: {
				// responsive: true,
				hoverMode: 'index',
				stacked: false,
				legend: { display: false },
				title: { display: false },
				tooltips: { enabled: false },
				animation: {
					duration: 0 // general animation time
				},
				hover: {
					animationDuration: 0 // duration of animations when hovering an item
				},
				responsiveAnimationDuration: 0, // animation duration after a resize
				scales: {
					yAxes: [{
						type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
						display: true,
						position: 'left',
						id: 'y-axis-1',
					}, {
						type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
						display: true,
						position: 'right',
						id: 'y-axis-2',

						// grid line settings
						gridLines: {
							drawOnChartArea: false, // only want the grid lines for one axis to show up
						},
					}],
				},
			}
		});
	},3000);
	};

}

 

</script>
