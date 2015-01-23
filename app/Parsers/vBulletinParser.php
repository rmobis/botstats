<?php namespace App\Parsers;

use App\Stats;
use App\Contracts\Parser;

use Symfony\Component\DomCrawler\Crawler;

class vBulletinParser implements Parser {

	/**
	 * Parses the input and returns an App\Stats object with the parsed data.
	 * 
	 * @param  string
	 * 
	 * @return App\Stats
	 */
	public function parse($input)
	{
		$stats   = new Stats();
		$crawler = new Crawler($input);

		$this->parseOnline($crawler, $stats);
		$this->parseOthers($crawler, $stats);

		return $stats;
	}

	/**
	 * Parses the total online, members online and guests online statistics.
	 * 
	 * @param  Crawler
	 * @param  Stats
	 */
	private function parseOnline(Crawler &$crawler, Stats &$stats)
	{
		// There are currently %d users online, %d members and %d guests
		$text = $crawler->filter('#wgo_onlineusers p:first-child')
		                ->text();

		// Basically extract all numbers and store in an array
		preg_match('/^.+?(\d+).+?(\d+).+?(\d+).+?/', $text, $data);

		// Remove first, full-match entry
		array_shift($data);

		// Convert to ints
		array_walk($data, function(&$value)
		{
			$value = intval($value);
		});

		// Assign to stats object
		list(
			$stats->total_online,
			$stats->members_online,
			$stats->guests_online
		) = $data;
	}

	/**
	 * Parses the total threads, total posts, total members and active members
	 * statistics.
	 * 
	 * @param  Crawler
	 * @param  Stats
	 */
	private function parseOthers(Crawler &$crawler, Stats &$stats)
	{
		// Threads: %d Posts: %d Members: %d Active Members: %d
		$text = $crawler->filter('#wgo_stats dl')
		                ->text();

		// Normalize spacing and remove commas from numbers
		$text = preg_replace('/[\s,]/', '', $text);

		// Basically extract all numbers, with commas, and store in an array
		preg_match('/^.+?(\d+).+?(\d+).+?(\d+).+?(\d+).*$/', $text, $data);

		// Remove first, full-match entry
		array_shift($data);

		// Convert to ints
		array_walk($data, function(&$value)
		{
			$value = intval($value);
		});

		// Assign to stats object
		list(
			$stats->total_threads,
			$stats->total_posts,
			$stats->total_members,
			$stats->active_members
		) = $data;
	}

}