<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresentationpanelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('presentationpanels', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('projectId')->unsigned();
            $table->integer('memberOneId')->unsigned();
            $table->integer('memberTwoId')->unsigned();
            $table->string('venue');
            $table->string('date');
            $table->string('time_start');
            $table->string('time_end');
			$table->timestamps();

            $table->foreign('projectId')
                ->references('id')
                ->on('projects');

            $table->foreign('memberOneId')
                ->references('id')
                ->on('panelmembers');

            $table->foreign('memberTwoId')
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
		Schema::drop('presentationpanels');
	}

}
