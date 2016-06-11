<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntreportTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('intreport', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('filename');
            $table->string('mime');
            $table->string('original_filename');
            $table->string('Student_no');
            $table->string('Project_id');
            $table->string('Supervisor_id');
            $table->string('date');
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
		Schema::drop('intreport');
	}

}
