<?php namespace BotStats\Http\Controllers;

use BotStats\Http\Controllers\Controller;

class ChartController extends Controller {

	/**
	 * Displays the chart and does all the magic.
	 * 
	 * @Get("/{stat?}", as="graph.show", where={"stat": "(active|guests|members|total)\-(members|online|posts|threads)"})
	 * 
	 * @param  string
	 * @param  string
	 * @return Illuminate\View\View
	 */
	public function showChart($stat = 'active-members')
	{
		return view('chart', compact('stat'));
	}

}
