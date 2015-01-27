/* global statsData, moment */
(function() {
	'use strict';
	
	statsData.events = statsData.events || {};

	statsData.events.others = {
		styling: {
			color: '#00FFFF'
		},

		data: [
			{
				title: 'iBot+ Beta',
				date: moment.tz('2014-09-09 07:07', 'America/Sao_Paulo')
			},
			{
				title: 'XenoBot Apophis',
				date: moment.tz('2014-06-18 02:43', 'America/Sao_Paulo')
			},
		]
	};
})();