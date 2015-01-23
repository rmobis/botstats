<?php namespace App\Console\Commands;

use App\Bot;
use App\Stats;

use Carbon\Carbon;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Message\ResponseInterface;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class StatsFetch extends Command {

	/**
	 * The console command name.
	 *
	 * @var string	
	 */
	protected $name = 'stats:fetch';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Fetches statistics for each bot included in the database';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$bots = Bot::all();
		$client = new Client();

		// Create requests
		$requests = [];
		foreach ($bots as $bot) {
			$requests[] = $client->createRequest('GET', $bot->url, [
				'query' => [
					'bot' => $bot->id
				]
			]);
		}

		// Send all requests in a batch
		$results = Pool::batch($client, $requests);

		// Check results
		$errors = [];
		foreach ($requests as $key => $request) {
			$bot      = $bots[$key];
			$response = $results->getResult($request);

			// Save errors for later
			if ($response instanceof \Exception) {
				$errors[] = $bot;
				continue;
			}

			$this->parseResponse($bot, $response);
		}

		$this->displayErrors($errors);

	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['pretend', 'p', InputOption::VALUE_NONE, 'Do not insert fetched data in database'],
		];
	}

	/**
	 * Parses a response using the appropriate parser for the bot.
	 * 
	 * @param  Bot
	 * @param  ResponseInterface
	 */
	private function parseResponse(Bot $bot, ResponseInterface $response)
	{
		// Load the specific parser for the bot
		$parser = \App::make('parser.'.$bot->parser);

		// Parse the result
		$stats = $parser->parse($response->getBody()->getContents());

		// Set the correct, rounded creation time
		$stats->created_at = Carbon::now()->second(0);

		// Display statistics fetched
		$this->displayStats($bot, $stats);

		// Optionally save to database
		if (!$this->option('pretend')) {
			$bot->stats()->save($stats);
		}
	}

	/**
	 * Displays the fechted stats.
	 * 
	 * @param  Bot
	 * @param  Stats
	 */
	private function displayStats(Bot $bot, Stats $stats)
	{
		$this->info(sprintf('Successfully fetched data for %s', $bot->name));
		$this->info(sprintf("Online:  %' 6d | Members: %' 6d | Guests: %' 6d", $stats->total_online, $stats->members_online, $stats->guests_online));
		$this->info(sprintf("Total:   %' 6d | Active:  %' 6d", $stats->total_members, $stats->active_members));
		$this->info(sprintf("Threads: %' 6d | Posts:   %' 6d", $stats->total_threads, $stats->total_posts));

		$this->line('');
	}

	/**
	 * Displays the errors.
	 * 
	 * @param  array
	 */
	private function displayErrors(array $errors)
	{
		if (count($errors) > 0) {
			$this->error('Unable to fetch data for the following bot(s):');

			foreach ($errors as $bot) {
				$this->error(sprintf("%-12s %s", $bot->name.':', $bot->url));
			}

			$this->line('');
		}
	}

}
