<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stats', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->unsignedInteger('bot_id');

			$table->unsignedInteger('total_online');
			$table->unsignedInteger('online_members');
			$table->unsignedInteger('online_guests');
			$table->unsignedInteger('total_members');
			$table->unsignedInteger('active_members');
			$table->unsignedInteger('total_threads');
			$table->unsignedInteger('total_posts');

			$table->timestamp('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('stats');
	}

}
