<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Bot extends Model {

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Sets up a one-to-many relationship between Bot and Stats.
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function stats() {
		return $this->hasMany('App\Stats');
	}

}
