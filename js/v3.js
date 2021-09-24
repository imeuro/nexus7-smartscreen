
// individually refreshes the blocks on the main page
// where, what, when
let loadblock = function(target,blockname,interval) {

	fetch('boxes/'+blockname).then((response) => {
	    return response.text();
	}).then((URLcontent) => {
	    document.querySelector(target).innerHTML = URLcontent;
	}).catch((error) => {
	    console.debug('Error:', error);
	});

	setInterval(function(){
		
		fetch('boxes/'+blockname).then((response) => {
		    return response.text();
		}).then((URLcontent) => {
		    document.querySelector(target).innerHTML = URLcontent;

			if (blockname == 'inside.php') {
				initGauge('in_TEMPERATURE','in_temp_val',10,33);
			}
			if (blockname == 'outside.php') {
				initGauge('out_TEMPERATURE','out_temp_val',0,35);
			}

		}).catch((error) => {
		    console.debug('Error:', error);
		});
		console.debug('block '+blockname+' loaded.');

		// dim screen at night [dismissed]
		// let currenthour = document.querySelector('#timecontainer h2 span').innerText;
		// if (currenthour < 7 || currenthour > 23) {
		// 	document.body.classList.add('dimmed')
		// } else {
		// 	document.body.classList.remove('dimmed')
		// }

	}, interval*60000);

}


// temperature gauges, Google Nest inspired
let initGauge = (target,val,min,max) => {
	setTimeout(function(){
		const Gtarget = document.getElementById(target);
		const Gval = document.getElementById(val).innerText;


		//console.log(Gval);
		const Gopts = {
		  angle: -0.2, // The span of the gauge arc
		  lineWidth: 0.03, // The line thickness
		  radiusScale: 1, // Relative radius
		  pointer: {
		    length: 0, // // Relative to gauge radius
		    strokeWidth: 0, // The thickness
		    color: '#000000' // Fill color
		  },
			percentColors: [
				[0.0, "#4c75b7" ],
				[0.3, "#4c75b7" ],
				[0.5, "#a9d70b"],
				[0.7, "#a9d70b"],
				[1.0, "#EF5350"]
			],
		  limitMax: 'false',
		  strokeColor: '#444',
		  generateGradient: true,
		  highDpiSupport: true,
		};

	
		let gauge = new Gauge(Gtarget).setOptions(Gopts); // create  gauge!

		const tmin = min;
		const tmax = max;
		gauge.maxValue = tmax; // set max gauge value
		gauge.setMinValue(tmin);  // Prefer setter over gauge.minValue = 0
		gauge.animationSpeed = 20; // set animation speed (32 is default value)
		gauge.set(Gval); // set actual value
	},1000);

}


document.addEventListener("DOMContentLoaded", function() {

	loadblock('#timecontainer','clock.php',1);
	loadblock('#insidetempcontainer','inside.php',5);
	loadblock('#outsidetempcontainer','outside.php',5);
	// loadblock('#covidcontainer','covid-19.php',30);
	loadblock('#calcontainer','calendar.php',120);
	loadblock('#forecast12hcontainer','forecast-12h.php',60);
	loadblock('#forecast4dcontainer','forecast-4d.php',60);

	reloadBtn.addEventListener('click', function(){
		reloadBtn.classList.add("rotate");
		window.location.reload();
	});

});


window.addEventListener('load', function() {

	initGauge('in_TEMPERATURE','in_temp_val',10,33);
	initGauge('out_TEMPERATURE','out_temp_val',0,35);

});

