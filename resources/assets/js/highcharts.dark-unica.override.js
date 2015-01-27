/* global Highcharts */
(function() {
	'use strict';
	
	/* Makes chart color match bots color */
	Highcharts.theme.colors = [
		"#90EE7E", "#2B908F", "#7798BF", "#F45B5B",
		"#AAEEEE", "#FF0066", "#EEAAEE", "#55BF3B",
		"#DF5353", "#7798BF", "#AAEEEE"
	];

	Highcharts.setOptions(Highcharts.theme);
})();