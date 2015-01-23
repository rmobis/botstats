<?php namespace App\Contracts;

use App\Stats;

interface Parser {

	/**
	 * Parses the input and returns an App\Stats object with the parsed data.
	 * 
	 * @param  string
	 * 
	 * @return App\Stats
	 */
	public function parse($input);
	
}