<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Stats extends Model {

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Sets up a one-to-many relationship between Bot and Stats.
	 * @return App\Bot
	 */
	public function bot() {
		return $this->belongsTo('App\Post');
	}

}
