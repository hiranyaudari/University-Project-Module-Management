<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewSupervisorRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
     *
     *
	 * @return void
	 */
	public function up()
	{
		Schema::create('new_supervisor_requests', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('projectID');
            $table->string('newSupervisorID');
            $table->string('description');
            $table->string('status');
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
		Schema::drop('new_supervisor_requests');
	}

}
