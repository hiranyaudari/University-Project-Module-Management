<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTimeLinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_time_lines', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('memberID');
            $table->string('eventType');
            $table->string('eventName');
            $table->date('eventDate');
            $table->time('eventTime');
            $table->string('eventDescription');
            $table->string('from');
            $table->integer('validity');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event_time_lines');
	}

}
