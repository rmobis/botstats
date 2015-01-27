var elixir = require('laravel-elixir');
require('laravel-elixir-jshint');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mixx) {
	mixx
		/* SASS/CSS */
		.sass('botstats.scss')
		.copy(
			'vendor/bower_components/bootstrap-sass-official/assets/fonts/bootstrap',
			'public/css/fonts'
		)
		.copy(
			'vendor/bower_components/bootstrap-sass-official/assets/stylesheets',
			'resources/assets/sass/vendor'
		)

		/* JavaScript */
		.jshint([
			'resources/assets/js/**/*.js'
    	])
		.scripts([
			'js/vendor/bootstrap-collapse.js',
			'js/vendor/bootstrap-dropdown.js',
			'js/vendor/highcarts.js',
			'js/vendor/highcarts.dark-unica.js',
			'../resources/assets/js/highcharts.dark-unica.override.js',
			'js/vendor/moment-with-locales.js',
			'js/vendor/moment-timezone-with-data.js',
			'../resources/assets/js/chart.js'
		], null, 'public/js/botstats.js')
		.copy(
			'vendor/bower_components/jquery/dist/jquery.min.js',
			'public/js/vendor/jquery.js'
		)
		.copy(
			'vendor/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/collapse.js',
			'public/js/vendor/bootstrap-collapse.js'
		)
		.copy(
			'vendor/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/dropdown.js',
			'public/js/vendor/bootstrap-dropdown.js'
		)
		.copy(
			'vendor/bower_components/highcharts-release/highcharts.js',
			'public/js/vendor/highcarts.js'
		)
		.copy(
			'vendor/bower_components/highcharts-release/themes/dark-unica.js',
			'public/js/vendor/highcarts.dark-unica.js'
		)
		.copy(
			'vendor/bower_components/moment/min/moment-with-locales.js',
			'public/js/vendor/moment-with-locales.js'
		)
		.copy(
			'vendor/bower_components/moment-timezone/builds/moment-timezone-with-data.js',
			'public/js/vendor/moment-timezone-with-data.js'
		)

		/* Cache Busting */
		.version([
			'public/css/botstats.css',
			'public/js/botstats.js'
		]);
});
