<?php namespace App\Providers;

use App\Parsers\vBulletinParser;

use Illuminate\Support\ServiceProvider;

class ParsersServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Register the application parsers.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['parser.vbulletin'] = $this->app->share(function ()
		{
			return new vBulletinParser();
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
			'parser.vbulletin',
		];
	}
}
