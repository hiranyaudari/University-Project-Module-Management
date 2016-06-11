<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('monthly_reports', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('projectId')->unsigned();
			$table->integer('month');
			$table->text('currentstatus');
			$table->text('workdone');
			$table->timestamps();

			$table->foreign('projectId')
				->references('id')
				->on('projects');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('monthly_reports');
	}

}
