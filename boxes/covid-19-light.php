
<?php
$file = file_get_contents("./boxes/COVID-19/dati-json/dpc-covid19-ita-andamento-nazionale.json");
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

	if ($today<0 && $yday>0 || $today>0 && $yday<0) $percdelta = 'N/A';
	if ($today<0 && $yday<0) $percdelta = $percdelta*-1;
	if ($percdelta > 0) $percdelta = '+'.$percdelta;

	return $percdelta;
}
?>

<div class="today">
	<h2>COVID-19 Italia <br><?php echo date("d M Y", strtotime($curday[0])); ?></h2>
	<?php 
	$Dtotpos = calcDelta($curtotpos,$prevtotpos);
	$Dnewpos = calcDelta($curnewpos,$prevnewpos);
	$Dtotvar = $Dnewvar = 'arr-top';
	if ($Dtotpos < 0) : 
		$Dtotvar = 'arr-bottom'; 
	endif;
	if ($Dnewpos < 0) : 
		$Dnewvar = 'arr-bottom';
	endif;

	?>
	<p class="total <?php echo $Dtotvar; ?>">TOT CASES: <?php echo $curtotpos; ?> (<?php echo $Dtotpos ?>%)</p>
	<p class="new <?php echo $Dnewvar; ?>">NEW CASES: <?php echo $curnewpos; ?> (<?php echo $Dnewpos ?>%)</p>
</div>
