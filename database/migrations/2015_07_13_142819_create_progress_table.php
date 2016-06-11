<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('progress', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('student_id');
            $table->string('Project_id');
            $table->string('date');
            $table->string('month');
            $table->string('current_project_status');
            $table->string('prev_month_work');
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
		Schema::drop('progress');
	}

}
