<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreeslotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('freeslots', function(Blueprint $table)
		{

			$table->increments('id');
            $table->integer('memberId')->unsigned();
            $table->string('freeDay');
            $table->integer('startingHour');
            $table->integer('startingMin');
            $table->integer('endingHour');
            $table->integer('endingMin');
			$table->timestamps();

            $table->foreign('memberId')
                ->references('id')
                ->on('panelmembers');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('freeslots');
	}

}
