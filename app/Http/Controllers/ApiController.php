<?php namespace App\Http\Controllers;


use App\Bot;
use App\Stats;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Contracts\Routing\ResponseFactory as Response;

class ApiController extends Controller {

	/**
	 * The cache repository.
	 * 
	 * @var Illuminate\Contracts\Cache\Repository
	 */
	protected $cache;

	/**
	 * The response factory.
	 * 
	 * @var lluminate\Contracts\Routing\ResponseFactory
	 */
	protected $response;

	/**
	 * Default constructor.
	 * 
	 * @param Illuminate\Contracts\Cache\Repository
	 */
	public function __construct(Cache $cache, Response $response)
	{
		$this->cache    = $cache;
		$this->response = $response;
	}

	/**
	 * Fetches and returns all relevant data for a given stat.
	 * 
	 * @Get("/api/{statName}", as="api.stat", where={"statName": "(active|guests|members|total)\-(members|online|posts|threads)"})
	 * 
	 * @param  string
	 * 
	 * @return Illuminate\Http\Response
	 */
	public function getStat($statName)
	{
		// Check for cached results on server
		$cacheKey = 'stat.'.$statName;
		if ($this->cache->has($cacheKey)) {
			return $this->cache->get($cacheKey);
		}

		// Prep data
		$data = [
			'meta' => [
				'title' => \Str::title(str_replace('-', ' ', $statName)),
				'stat'  => $statName,
			],
			'day'  => [],
			'hour' => [],
		];

		// Normalize stat name
		$DBStatName = str_replace('-', '_', $statName);

		// Gather data
		foreach (Bot::all() as $bot) {
			list($data['day'][], $data['hour'][]) = Stats::getApiData($bot, $DBStatName);
		}

		// Build response
		$expiresAt = Carbon::now()->second(0)->minute(0)->addHour(1);
		$response = $this->response->json($data)
		                           ->header('Expires', $expiresAt->toRfc1123String());

		// Setup caching
		$this->cache->put($cacheKey, $response, $expiresAt->diffInMinutes(Carbon::now()));

		return $response;
	}

}
