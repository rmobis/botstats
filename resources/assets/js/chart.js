/* global botNames, startingStat, startingType */
(function() {
	'use strict';
	
	var $chartDiv     = $('#chart'),
		$statsAnchors = $('.js-stats a');

	function createChart(stat) {
		// Free any previously drawn chart
		if (window.statChart !== undefined) {
			window.statChart.destroy();
		}

		// Prep series
		var preppedSeries = [];
		window.botNames.forEach(function (name) {
			preppedSeries.push({
				name: name,
				data: []
			});
		});

		$chartDiv.highcharts({
			chart: {
				type: 'spline',
				zoomType: 'x',
				panning: true,
				panKey: 'shift'
			},


			title: {
				text: ''
			},


			yAxis: {
				type: 'linear',
				min: 0,

				title: {
					text: ''
				},

				labels: {
					formatter: function () {
						return (this.value / 1000) + 'k';
					}
				}
			},

			xAxis: {
				type: 'datetime',
				minRange: 24 * 60 * 60 * 1000,

				title: {
					text: 'Time'
				}
			},

			series: preppedSeries
		});

		window.statChart = $chartDiv.highcharts();

		loadData(stat);
	}

	function loadData(stat) {
		window.statChart.showLoading();

		$.ajax({
			url: '/api/' + stat,
			dataType: 'json'
		}).done(function (data) {
			window.statChart.xAxis[0].series.forEach(function (value, index) {
				value.setData(data.day[index].data, false);
			});

			window.statChart.xAxis[0].setTitle({
				text: data.meta.name
			});

			$statsAnchors.parent()
			             .removeClass('active');

			$statsAnchors.filter('[data-stat=' + stat + ']')
			             .parent()
			             .addClass('active');

			history.replaceState({
				stat: data.meta.stat
			}, data.meta.stat, '/' + data.meta.stat);

			window.statChart.hideLoading();
		});
	}

	$statsAnchors.on('click', function () {
		loadData($(this).data('stat'));
	});

	createChart(window.startingStat);
})();