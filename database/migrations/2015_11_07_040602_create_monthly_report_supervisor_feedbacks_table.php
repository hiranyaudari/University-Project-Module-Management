<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyReportSupervisorFeedbacksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('monthly_report_supervisor_feedbacks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('supervisorId')->unsigned();
			$table->integer('reportId')->unsigned();
			$table->integer('currentstatus');
			$table->integer('workdone');
			$table->integer('timelycompletion');
			$table->integer('supervisorcontact');
			$table->integer('overallprogress');
			$table->integer('seriousproblems');
			$table->text('comments');

			$table->foreign('supervisorId')
				->references('id')
				->on('panelmembers');

			$table->foreign('reportId')
				->references('id')
				->on('monthly_reports');

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
		Schema::drop('monthly_report_supervisor_feedbacks');
	}

}
