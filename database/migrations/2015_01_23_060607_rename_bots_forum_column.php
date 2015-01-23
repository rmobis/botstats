<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameBotsForumColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bots', function(Blueprint $table)
		{
			$table->renameColumn('forum', 'url');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bots', function(Blueprint $table)
		{
			$table->renameColumn('url', 'forum');
		});
	}

}
