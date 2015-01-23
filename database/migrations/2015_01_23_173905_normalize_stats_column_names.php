<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NormalizeStatsColumnNames extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('stats', function(Blueprint $table)
		{
			$table->renameColumn('online_members', 'members_online');
			$table->renameColumn('online_guests',  'guests_online');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('stats', function(Blueprint $table)
		{
			$table->renameColumn('members_online', 'online_members');
			$table->renameColumn('guests_online',  'online_guests');
		});
	}

}
