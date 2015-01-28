<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="BotStats - Tibia Botting Statistics">
		<meta name="author" content="Raphael Mobis Tacla">

		<link rel="icon" href="/favicon.ico">

		<title>Bot Stats &middot; Chart</title>

		<!-- Page styles -->
		<link href="{{ elixir('css/botstats.css') }}" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>

		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Bottting Statistics</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="javascript:void" class="dropdown-toggle" data-toggle="dropdown">Chart Stat <span class="caret"></span></a>
							<ul class="dropdown-menu js-stats" role="menu">
								@foreach(BotStats\Stats::$stats as $statName)
									<li>
										<a href="javascript:void" data-stat="{{ str_replace('_', '-', $statName) }}">{{ Str::title(str_replace('_', ' ', $statName)) }}</a>
									</li>
								@endforeach
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div id="container">
			<div id="chart"></div>
		</div>

		<script>
			window.statsData = {
				botNames     : {!! json_encode(BotStats\Bot::orderBy('id')->lists('name')) !!},
				startingStat : {!! json_encode($stat) !!}
			};
		</script>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery.js"><\/script>')</script>
		<script src="{{ elixir('js/botstats.js') }}"></script>

		<!-- Google Analytics -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-58947063-1','auto');ga('send','pageview');
        </script>
	</body>
</html>
