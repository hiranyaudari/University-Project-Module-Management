<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('url')->nullable();
            $table->integer('supervisorId')->unsigned()->nullable();
            $table->integer('studentId')->unsigned()->nullable();;
            $table->string('status');
            $table->timestamps();

            $table->foreign('supervisorId')
                ->references('id')
                ->on('panelmembers');

            $table->foreign('studentID')
                ->references('id')
                ->on('students');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projects');
	}

}
