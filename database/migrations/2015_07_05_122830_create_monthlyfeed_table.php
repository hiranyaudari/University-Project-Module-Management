<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyfeedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('monthlyfeed', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('student_id');
            $table->string('Project_id');
            $table->string('date');
            $table->string('feedback');
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
		Schema::drop('monthlyfeed');
	}

}
