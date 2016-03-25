/* global statsData, moment */
(function() {
	'use strict';

	statsData.events = statsData.events || {};

	statsData.events.updates = {
		styling: {
			color: '#FFFF00'
		},

		data: [
			{
				title: '10.90 Update',
				date: '2015-08-12'
			},
			{
				title: '10.80 Update',
				date: '2015-07-21'
			},
			{
				title: '10.79 Update',
				date: '2015-06-16'
			},
			{
				title: '10.78 Update',
				date: '2015-05-12'
			},
			{
				title: '10.77 Update',
				date: '2015-04-14'
			},
			{
				title: '10.76 Update',
				date: '2015-03-03'
			},
			{
				title: '10.75 Update',
				date: '2015-02-10'
			},
			{
				title: '10.74 Update',
				date: '2015-01-27'
			},
			{
				title: '10.73 Update',
				date: '2015-01-20'
			},
			{
				title: '10.72 Update',
				date: '2015-01-13'
			},
			{
				title: '10.71 Update',
				date: '2014-12-16'
			},
			{
				title: '10.70 Update',
				date: '2014-12-10'
			},
			{
				title: '10.64 Update',
				date: '2014-12-04'
			},
			{
				title: '10.63 Update',
				date: '2014-11-19'
			},
			{
				title: '10.62 Update',
				date: '2014-11-12'
			},
			{
				title: '10.61 Update',
				date: '2014-10-30'
			},
			{
				title: '10.60 Update',
				date: '2014-10-28'
			},
			{
				title: '10.59 Update',
				date: '2014-10-08'
			},
			{
				title: '10.58 Update',
				date: '2014-10-06'
			},
			{
				title: '10.57 Update',
				date: '2014-09-30'
			},
			{
				title: '10.56 Update',
				date: '2014-09-24'
			},
			{
				title: '10.55 Update',
				date: '2014-09-15'
			},
			{
				title: '10.54 Update',
				date: '2014-09-09'
			},
			{
				title: '10.53 Update',
				date: '2014-08-26'
			},
			{
				title: '10.52 Update',
				date: '2014-08-12'
			},
			{
				title: '10.51 Update',
				date: '2014-07-22'
			},
			{
				title: '10.50 Update',
				date:  '2014-07-07'
			},
			{
				title: '10.41 Update',
				date: '2014-05-27'
			},
			{
				title: '10.40 Update',
				date: '2014-05-20'
			},
			{
				title: '10.39 Update',
				date: '2014-04-28'
			},
			{
				title: '10.38 Update',
				date: '2014-03-31'
			},
		]
	};

	statsData.events.updates.data.forEach(function (update) {
		update.date = moment.tz(update.date + ' 10:00', 'Europe/Berlin');
	});
})();
