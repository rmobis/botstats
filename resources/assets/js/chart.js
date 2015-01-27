/* global statsData */
(function() {
	'use strict';
	
	var $chartDiv     = $('#chart'),
		$statsAnchors = $('.js-stats a');

	/**
	 * Creates a new chart instance for the given stat.
	 *
	 * @param  string
	 */
	function createChart(stat) {
		// Free any previously drawn chart
		if (statsData.chart !== undefined) {
			statsData.chart.destroy();
		}

		// Prep series
		var preppedSeries = [];
		statsData.botNames.forEach(function (name) {
			preppedSeries.push({
				name: name,
				data: []
			});
		});

		// Pass all the desired options
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
				minRange: 24 * 60 * 60 * 1000
			},

			series: preppedSeries
		});

		statsData.chart = $chartDiv.highcharts();

		// Plot all events
		Object.keys(statsData.events).forEach(function (key) {
			statsData.events[key].data.forEach(addPlotLine, statsData.events[key]);
		});

		loadData(stat);
	}

	/**
	 * Asynchronously loads the data for a given stat into the chart.
	 *
	 * @param  string
	 */
	function loadData(stat) {
		statsData.chart.showLoading();

		$.ajax({
			url: '/api/' + stat,
			dataType: 'json'
		}).done(function (data) {
			// Update data
			statsData.chart.xAxis[0].series.forEach(function (value, index) {
				value.setData(data.day[index].data, false);
			});

			statsData.chart.xAxis[0].setTitle({
				text: data.meta.name
			});

			// Update active anchor
			$statsAnchors.parent()
			             .removeClass('active');

			$statsAnchors.filter('[data-stat=' + stat + ']')
			             .parent()
			             .addClass('active');

			// Update URL
			history.replaceState({
				stat: data.meta.stat
			}, data.meta.stat, '/' + data.meta.stat);


			statsData.chart.hideLoading();
		});
	}

	/**
	 * Adds a plot line. We use those to display events that may have been
	 * significant for the statistics displayed.
	 *
	 * @param string
	 * @param string
	 * @param moment
	 */
	function addPlotLine(e) {
		statsData.chart.xAxis[0].addPlotLine({
			width: 1,
			/*jshint validthis:true */
			color: this.styling.color,
			dashStyle: 'dash',
			value: e.date.valueOf(),
			label: {
				text: e.title,
				style: {
					color: '#FFFFFF'
				}
			}
		});
	}

	$statsAnchors.on('click', function () {
		loadData($(this).data('stat'));
	});

	createChart(statsData.startingStat);
})();