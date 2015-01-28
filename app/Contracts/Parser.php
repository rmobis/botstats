<?php namespace BotStats\Contracts;

use BotStats\Stats;

interface Parser {

	/**
	 * Parses the input and returns an BotStats\Stats object with the parsed data.
	 * 
	 * @param  string
	 * 
	 * @return BotStats\Stats
	 */
	public function parse($input);
	
}