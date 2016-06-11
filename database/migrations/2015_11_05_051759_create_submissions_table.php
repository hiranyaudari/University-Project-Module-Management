<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up()
	{
        Schema::create('submissions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('type');
            $table->string('status');
            $table->dateTime('submittedDate');
            $table->string('location');
            $table->integer('studentId')->unsigned()->nullable();

            $table->foreign('studentId')
                ->references('id')
                ->on('students');
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
		Schema::drop('submissions');
	}

}
